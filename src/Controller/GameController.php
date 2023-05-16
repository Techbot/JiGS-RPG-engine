<?php

namespace Drupal\jigs\Controller;

use Drupal\node\Entity\Node;
use Drupal\Core\Controller\ControllerBase;
use Drupal\jigs\game\Loop;
use Drupal\jigs\game\Dice;
use Drupal\jigs\game\Npc;
use Drupal\jigs\game\Player;
use Drupal\jigs\game\Faction;
use Drupal\jigs\game\Round;
use Drupal\jigs\game\Weapon;
use Drupal\jigs\game\FactionDecorator;
use Drupal\jigs\game\WeaponDecorator;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides route responses for the JiGS module.
 */
class GameController extends ControllerBase
{
  public $round;
  public $dice1;
  public $dice2;
  public $dice3;
  public $dice4;
  public $simplePlayer;
  public $npc;
  public $user;
  public $player;
  public $text;
  public $faction;
  public $weapon;

  public function __construct()
  {
    /*    $this->dice1   = new Dice();
      $this->dice2   = new Dice();
      $this->dice3   = new Dice();
      $this->dice4   = new Dice(); */

    $this->user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());

    /**
     *   Setup the Player
     */
    $this->simplePlayer  = new Player(
      $this->user->field_level->value,
      $this->user->field_health->value,
      $this->user->field_strength->value,
      $this->user->field_stamina->value,
      1, //  $this->dice1->getDiceValue() + $this->user->field_strength->value, // attack
      1, //  $this->dice2->getDiceValue() + $this->user->field_stamina->value,  // defense
      1, //  $this->dice1->getDiceValue(),
      1, //  $this->dice2->getDiceValue(),

      $this->user->field_losses->value,
      $this->user->field_wins->value,
      199,

    );

    $this->faction = new Faction(7);
    $this->weapon = new Weapon(6);

    $this->player = new WeaponDecorator(new FactionDecorator($this->simplePlayer, $this->faction), $this->weapon);
    $this->npc     = new Npc(
      1,
      100,
      10,
      10,
      0,
      0,
      1, //  $this->dice3->getDiceValue(),
      1, //  $this->dice4->getDiceValue()
    );

    $this->round   = new Round($this->player, $this->npc, $this->text);
  }

  /**
   * Ajax callback event.
   *
   * @param array $form
   *  The triggering form render array.
   * @param Drupal\Core\Form\FormStateInterface $form_state
   *  Form state of current form.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *  The request object, holding current path and request uri.
   * @return mixed
   *  Must return AjaxResponse object or render array.
   *  Never return NULL or invalid render arrays. This
   *  could/will break your forms.
   */
  public function myData()
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response                 = new AjaxResponse();
    $loop                     = new Loop($this->round);
    $this->round->update();
    $responseData = $loop->loop();
    $this->user->field_health = (int)$this->player->getHealth();
    $this->user->field_losses = (int)$this->player->getLosses();
    $this->user->field_wins   = (int)$this->player->getWins();
    $this->user->credits      = (int)$this->player->getCredits();
    $this->user->save();

    /*   return [
    '#markup' => $responseText['text'],
  ]; */

    // Add some commands to the response object.
    //$response->addCommand(new InvokeCommand(NULL, 'myAjaxCallback', ['This is the new text!']));
    // Make sure to ALWAYS return a response object or valid render array.
    // in the DOM: replace the form with the text 'form submitted'
    //$response->addCommand(new \Drupal\Core\Ajax\HtmlCommand('#MYFORM', 'form submitted'));
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));

    return $response;
  }

  public function myState()
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response       = new AjaxResponse();
    $playerName     = $this->user->get("name")->value;
    $playerId       = \Drupal::currentUser()->id();
    $userGamesState = $this->user->field_player_game_state->value;
    // $userMG = (int)$this->user->field_map_grid->getValue()[0]['target_id'];
    $database       = \Drupal::database();
    $query          = $database->query("SELECT field_map_grid_target_id FROM user__field_map_grid WHERE entity_id=  1");
    $userMG         = $query->fetchAll();
    $MapGrid        =  \Drupal::entityTypeManager()->getStorage('node')->load($userMG[0]->field_map_grid_target_id);

    ////////////////////////////////////////////////////////////////////////////////

    $tiled        = $MapGrid->field_tiled->getValue()[0]['value'];
    $portalsArray = $MapGrid->field_portals->referencedEntities();
    $rewardsArray  = $MapGrid->field_rewards->referencedEntities();
    $userCity     = (int)$MapGrid->field_city->getValue()[0]['target_id'];
    $City         =  \Drupal::entityTypeManager()->getStorage('node')->load($userCity);
    $cityName     =  $City->getTitle();
    $portals = [];

    foreach ($portalsArray as $portal) {
      $portals[] = [
        'destination'   => (int)$portal->field_destination->getValue()[0]['target_id'],
        'destination_x' => (int)$portal->field_destination_x->getValue()[0]['value'],
        'destination_y' => (int)$portal->field_destination_y->getValue()[0]['value'],
        'tiled' => (int)$portal->field_tiled->getValue()[0]['value'],
        'x' => (int)$portal->field_x->getValue()[0]['value'],
        'y' => (int)$portal->field_y->getValue()[0]['value']
      ];
    }

    foreach ($rewardsArray as $reward) {
      $rewards[] = [
        'ref' => $reward->field_ref->getValue()[0]['value'],
        'x' => (int)$reward->field_x->getValue()[0]['value'],
        'y' => (int)$reward->field_y->getValue()[0]['value']
      ];
    }
    //////////////////////////////////////////////////////////////////////////////////

    foreach ($MapGrid->field_layer_1->referencedEntities() as $tileset) {
      $tilesetArray_1[] = $tileset->name->value;
    }

    foreach ($MapGrid->field_layer_2->referencedEntities() as $tileset) {
      $tilesetArray_2[] = $tileset->name->value;
    }

    foreach ($MapGrid->field_layer_3->referencedEntities() as $tileset) {
      $tilesetArray_3[] = $tileset->name->value;
    }

    foreach ($MapGrid->field_layer_4->referencedEntities() as $tileset) {
      $tilesetArray_4[] = $tileset->name->value;
    }

    foreach ($MapGrid->field_layer_5->referencedEntities() as $tileset) {
      $tilesetArray_5[] = $tileset->name->value;
    }

    ////////////////////////////////////////////////////////////////////////////////

    foreach ($MapGrid->field_npc->referencedEntities() as $NPC) {
      $NPCObject =  \Drupal::entityTypeManager()->getStorage('node')->load($NPC->field_name->getValue()[0]['target_id']);
      $NPCArray[] =
        [
          $NPCObject->getTitle(),
          $NPC->field_x->value,
          $NPC->field_y->value,
          $NPCObject->field_sprite_sheet->getValue()[0]['value']
        ];
    }

    $responseData['playerId']             = $playerId;
    $responseData['playerName']           = $playerName;
    $responseData['userMapGrid']          = $userMG;
    $responseData['City']                 = $cityName;
    $responseData['Name']                 = $MapGrid->get('title')->value;
    $responseData['userGamesState']       = $userGamesState;
    $responseData['portalsArray']         = $portals;

    if (isset($NPCArray)) {
      $responseData['NpcArray']             = $NPCArray;
    }

    if (isset($rewards)) {
      $responseData['rewardsArray']         = $rewards;
    }
    $responseData['Tiled']                = $tiled;
    $responseData['tilesetArray_1']       = $tilesetArray_1;
    $responseData['tilesetArray_2']       = $tilesetArray_2;
    $responseData['tilesetArray_3']       = $tilesetArray_3;

    if (isset($tilesetArray_4)) {
      $responseData['tilesetArray_4'] = $tilesetArray_4;
    }

    if (isset($tilesetArray_5)) {
      $responseData['tilesetArray_5'] = $tilesetArray_5;
    }

    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));

    return $response;
  }
}
