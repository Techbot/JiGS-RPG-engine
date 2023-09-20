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
      $this->user->field_endurance->value,
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
    //$responseData = $loop->loop();

    $responseData = [];
    // $this->user->field_health = (int)$this->player->getHealth();
    $this->user->field_losses = (int)$this->player->getLosses();
    $this->user->field_wins   = (int)$this->player->getWins();
    $this->user->credits      = (int)$this->player->getCredits();
    $this->user->save();

    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

  public function myState()
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response       = new AjaxResponse();
    $playerName     = $this->user->get("name")->value;
    $playerId       = \Drupal::currentUser()->id();


    //Cached stuff
    $userGamesState         = $this->user->field_game_state->value;
    $player['level']        = $this->user->field_level->value;
    $player['intelligence'] = $this->user->field_intelligence->value;
    $player['strength']     = $this->user->field_strength->value;
    $player['dexterity']    = $this->user->field_dexterity->value;
    $player['endurance']    = $this->user->field_endurance->value;
    $player['charisma']     = $this->user->field_charisma->value;
    $player['psi']          = $this->user->field_psi->value;
    $player['losses']       = $this->user->field_losses->value;
    $player['wins']         = $this->user->field_wins->value;
    $player['xp']           = $this->user->field_experience->value;
    $player['sprite_sheet'] = $this->user->field_sprite_sheet->value;

    //$player['credits']  = $this->user->field_credits->value;
    //$player['health']       = $this->user->field_health->value;
    // $userMG = (int)$this->user->field_map_grid->getValue()[0]['target_id'];
    $database       = \Drupal::database();

    //Non Cached Stuff

    $query             = $database->query("SELECT field_map_grid_target_id FROM user__field_map_grid WHERE entity_id= " . $playerId);
    $userMG            = $query->fetchAll();

    $query             = $database->query("SELECT field_credits_value FROM user__field_credits WHERE entity_id= " . $playerId);
    $player['credits'] = $query->fetchAll()[0]->field_credits_value;

    $query             = $database->query("SELECT field_health_value FROM user__field_health WHERE entity_id= " . $playerId);
    $player['health']  = $query->fetchAll()[0]->field_health_value;

    $query             = $database->query("SELECT field_energy_value FROM user__field_energy WHERE entity_id= " . $playerId);
    $player['energy']  = $query->fetchAll()[0]->field_energy_value;

    $MapGrid           =  \Drupal::entityTypeManager()->getStorage('node')->load($userMG[0]->field_map_grid_target_id);
    $query             = $database->query("SELECT field_inventory_target_id FROM user__field_inventory WHERE entity_id= " . $playerId);

    $player['inventory']  = $query->fetchAll();

    foreach ($player['inventory'] as $invItem) {
      $inventoryItemNumber = $invItem->field_inventory_target_id;


      $query = $database->query("SELECT field_potions_target_id FROM paragraph__field_potions  WHERE entity_id= " . $inventoryItemNumber);
      foreach ($query as $record){
//echo ($record);
/*         $potion  = $query->fetchAll()[0]->field_potions_target_id;
        $query             = $database->query("SELECT field_amount_value FROM paragraph__field_amount  WHERE entity_id= " . $potion);
        $amount = $query->fetchAll()[0]->field_amount_value;
        $query             = $database->query("SELECT title FROM node_field_data  WHERE nid= " . $potion);
        $name              = $query->fetchAll()[0]->title;
        $player['items'][] = [$potion, $amount, $name]; */
        continue;
      }

      $query = $database->query("SELECT field_items_target_id FROM paragraph__field_items  WHERE entity_id= " . $inventoryItemNumber);
      foreach ($query as $record) {

        //$item  = $query->fetchAll()[0]->field_items_target_id;

/*         $query             = $database->query("SELECT field_amount_value FROM paragraph__field_amount  WHERE entity_id= " . $item);
        $amount            = $query->fetchAll()[0]->field_amount_value;
        $query             = $database->query("SELECT title FROM node_field_data  WHERE nid= " . $item);
        $name              = $query->fetchAll()[0]->title; */
      //  $player['items'][] = [$item, $amount, $name];
        continue;
      }

      $query = $database->query("SELECT field_ingredients_target_id FROM paragraph__field_ingredients  WHERE entity_id= " . $inventoryItemNumber);

      foreach ($query as $record) {
/*       $ingredient  = $query->fetchAll()[0]->field_ingredients_target_id;

        $query             = $database->query("SELECT field_amount_value FROM paragraph__field_amount  WHERE entity_id= " . $ingredient);
        $amount            = $query->fetchAll()[0]->field_amount_value;
        $query             = $database->query("SELECT title FROM node_field_data  WHERE nid= " . $ingredient);
        $name              = $query->fetchAll()[0]->title;
        $player['items'][] = [$ingredient, $amount, $name]; */
        continue;
      }

      $query             = $database->query("SELECT field_elements_target_id FROM paragraph__field_elements  WHERE entity_id= " . $inventoryItemNumber);

      foreach ($query as $record) {
       // $element = $query->fetchAll()[0]->field_elements_target_id;
/*         $query             = $database->query("SELECT field_amount_value FROM paragraph__field_amount  WHERE entity_id= " . $element);
        $amount            = $query->fetchAll()[0]->field_amount_value;
        $query             = $database->query("SELECT title FROM node_field_data  WHERE nid= " . $element);
        $name              = $query->fetchAll()[0]->title;
        $player['items'][] = [$element, $amount, $name]; */
        continue;
      }

/*       $query             = $database->query("SELECT field_weapons_target_id FROM paragraph__field_weapons  WHERE entity_id= " . $inventoryItemNumber);
      $element = $query->fetchAll()[0]->field_elements_target_id;
      if ($element) {
        $query             = $database->query("SELECT field_amount_value FROM paragraph__field_amount  WHERE entity_id= " . $element);
        $amount            = $query->fetchAll()[0]->field_amount_value;
        $query             = $database->query("SELECT title FROM node_field_data  WHERE nid= " . $element);
        $name              = $query->fetchAll()[0]->title;
        $player['items'][] = [$element, $amount, $name];
        continue;
      } */

  //    $query             = $database->query("SELECT field_ammo_target_id FROM paragraph__field_ammo  WHERE entity_id= " . $inventoryItemNumber);
  //    $element = $query->fetchAll()[0]->field_elements_target_id;
  //    foreach ($query as $record) {
/*         $query             = $database->query("SELECT field_amount_value FROM paragraph__field_amount  WHERE entity_id= " . $element);
        $amount            = $query->fetchAll()[0]->field_amount_value;
        $query             = $database->query("SELECT title FROM node_field_data  WHERE nid= " . $element);
        $name              = $query->fetchAll()[0]->title;
        $player['items'][] = [$element, $amount, $name]; */
   //    continue;
  //    }
    }

    $tiled          = $MapGrid->field_tiled->getValue()[0]['value'];
    $portalsArray   = $MapGrid->field_portals->referencedEntities();
    $rewardsArray   = $MapGrid->field_rewards->referencedEntities();
    $npcArray       = $MapGrid->field_npc->referencedEntities();
    $mobArray       = $MapGrid->field_mobs->referencedEntities();
    $userCity       = (int)$MapGrid->field_city->getValue()[0]['target_id'];
    $City           =  \Drupal::entityTypeManager()->getStorage('node')->load($userCity);
    $cityName       =  $City->getTitle();
    $portals = [];
    //////////////////////////  PORTALS  ///////////////////////////////////////////
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
    //////////////////////////  REWARDS  ///////////////////////////////////////////
    foreach ($rewardsArray as $reward) {
      $rewards[] = [
        'ref' => $reward->field_ref->getValue()[0]['value'],
        'x' => (int)$reward->field_x->getValue()[0]['value'],
        'y' => (int)$reward->field_y->getValue()[0]['value']
      ];
    }
    ////////////////////////////////// LAYERS //////////////////////////////////////
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

    //////////////////////////////////// NPC  //////////////////////////////////////
    foreach ($npcArray as $Npc) {
      $NpcObject =  \Drupal::entityTypeManager()->getStorage('node')->load($Npc->field_name->getValue()[0]['target_id']);
      $NpcArray[] =
        [
          $NpcObject->getTitle(),
          $Npc->field_x->value,
          $Npc->field_y->value,
          $NpcObject->field_sprite_sheet->getValue()[0]['value'],
          $NpcObject->field_bark->value,
        ];
    }
    //////////////////////////////////// MOB  //////////////////////////////////////
    foreach ($mobArray as $Mob) {

      $MobObject =  \Drupal::entityTypeManager()->getStorage('node')->load($Mob->field_mobs->getValue()[0]['target_id']);
      $MobArray[] =
        [
          $Mob->field_mob_name->value,
          $Mob->field_x->value,
          $Mob->field_y->value,
          $MobObject->field_mob_sprite_sheet->getValue()[0]['value'],
          $MobObject->getTitle()
        ];
    }
    ////////////////////////////////////////////////////////////////////////////////
    $responseData['playerId']             = $playerId;
    $responseData['playerStats']          = $player;
    $responseData['playerName']           = $playerName;
    $responseData['userMapGrid']          = $userMG;
    $responseData['City']                 = $cityName;
    $responseData['Name']                 = $MapGrid->get('title')->value;
    $responseData['userGamesState']       = $userGamesState;
    $responseData['portalsArray']         = $portals;
    $responseData['content']              = "Welcome to The Eclectic Meme Conspiracy,
    where everything you've read on the net is true.\n
     Travel the globe as an international player in a game of magic, mystery and zombies.\n
     Gather crystals and other resources and \n
     create your own underground empire.";

    if (isset($NpcArray)) {
      $responseData['NpcArray']            = $NpcArray;
    }
    if (isset($MobArray)) {
      $responseData['MobArray']           = $MobArray;
    }
    if (isset($rewards)) {
      $responseData['rewardsArray']       = $rewards;
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
