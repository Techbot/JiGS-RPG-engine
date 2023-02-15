<?php
namespace Drupal\jigs\Controller;

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
class GameController extends ControllerBase {

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
      $this->dice1   = new Dice();
      $this->dice2   = new Dice();
      $this->dice3   = new Dice();
      $this->dice4   = new Dice();

      $this->user = \Drupal\user\Entity\User::load( \Drupal::currentUser()->id());

      /**
     *   Setup the Player
     */

      $this->simplePlayer  = new Player(
        $this->user->field_level->value,
        $this->user->field_health->value,
        $this->user->field_strength->value,
        $this->user->field_stamina->value,
        $this->dice1->getDiceValue() + $this->user->field_strength->value, // attack
        $this->dice2->getDiceValue() + $this->user->field_stamina->value,  // defense
        $this->dice1->getDiceValue(),
        $this->dice2->getDiceValue(),

        $this->user->field_losses->value,
        $this->user->field_wins->value,
        199,

      );

      $this->faction = new Faction(7);
      $this->weapon = new Weapon(6);

      $this->player = new WeaponDecorator(new FactionDecorator($this->simplePlayer, $this->faction) , $this->weapon);
      $this->npc     = new Npc(
        1,
        100,
        10,
        10,
        0,
        0,
        $this->dice3->getDiceValue(),
        $this->dice4->getDiceValue()
      );

      $this->round   = new Round($this->player, $this->npc, $this->text );

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
public function myData() {

  /** @var \Drupal\Core\Ajax\AjaxResponse $response */
  $response = new AjaxResponse();

  $loop = new Loop( $this->round );
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
    $response = new AjaxResponse();

    $responseData[] = $this->user->field_player_game_state->value;
    $responseData[] = $this->user->field_map->value;
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));

    return $response;
  }









}
