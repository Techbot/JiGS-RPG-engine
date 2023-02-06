<?php

/**
 * @file
 * Contains \Drupal\jigs\Form\RegistrationForm.
 */
namespace Drupal\jigs\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\jigs\game\Loop;
use Drupal\jigs\game\Dice;
use Drupal\jigs\game\Npc;
use Drupal\jigs\game\Player;
use Drupal\jigs\game\Round;
use Drupal\jigs\game\Faction;
use Drupal\jigs\game\Weapon;
use Drupal\jigs\game\FactionDecorator;
use Drupal\jigs\game\WeaponDecorator;

class RForm extends FormBase {

  public  $round;
  private $dice1;
  private $dice2;
  private $dice3;
  private $dice4;
  public  $player;
  private $npc;
  private $user;
  public  $newPlayer;
  public  $text;
  public  $faction;
  public  $weapon;

  public function getFormId() {
    return 'simple_game';
}

public function buildForm(array $form, FormStateInterface $form_state) {
   $form['name'] = array(
    '#type' => 'hidden',
    '#title' => t('Enter Name:'),

    '#required' => TRUE,
      '#prefix' => '<div class="module-name-game"></div><div id="my_game_item"></div>', // Add markup before form ite
    );


   $form['actions']['#type'] = 'actions';

  $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Fight2222'),
      '#button_type' => 'primary',
    );
  $form['actions']['submit']['#ajax'] = array(
      'callback' => '::myPage',
      'event' => 'click',

    );

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  /*   if(strlen($form_state->getValue('name')) < 10) {
      $form_state->setErrorByName('name', $this->t('Please enter a valid name'));
    } */
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

/*     \Drupal::messenger()->addMessage(t("Student Registration Done!! Registered Values are:"));
	foreach ($form_state->getValues() as $key => $value) {
	  \Drupal::messenger()->addMessage($key . ': ' . $value);
    } */

  }

  public function myPage()
  {

    $this->dice1  = new Dice();
    $this->dice2  = new Dice();
    $this->dice3  = new Dice();
    $this->dice4  = new Dice();

    $this->user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    $this->player  = new Player(
      $this->user->field_level->value,
      $this->user->field_health->value,
      $this->user->field_strength->value,
      $this->user->field_stamina->value,
      0,
      0,
      $this->dice1->getDiceValue(),
      $this->dice2->getDiceValue(),
      $this->user->field_losses->value,
      $this->user->field_wins->value,
      $this->user->field_credits->value,
    );
    $this->faction = new Faction($this->user->field_faction->value);
    $this->weapon  = new Weapon(7,6);

    $this->newPlayer = new WeaponDecorator(new FactionDecorator($this->player, $this->faction), $this->weapon);

    $this->npc     = new Npc(1,100,10,10,0,0,$this->dice3->getDiceValue(), $this->dice4->getDiceValue());

    $this->round   = new Round($this->newPlayer, $this->npc, $this->text);

    $loop = new Loop($this->round);
    $this->round->update();
    $responseData = $loop->loop();

    $this->user->field_losses = (int)$this->player->getLosses();
    $this->user->field_wins   = (int)$this->player->getWins();
    $this->user->save();

    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response = new AjaxResponse();

    //$response->addCommand(new \Drupal\Core\Ajax\HtmlCommand('#my_game_item', $responseText));
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

}
