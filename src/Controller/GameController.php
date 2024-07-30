<?php

namespace Drupal\jigs\Controller;

use Drupal\node\Entity\Node;
use Drupal\Core\Controller\ControllerBase;
use Drupal\jigs\Entities\Player;
use Drupal\jigs\Entities\MapGrid;
use Drupal\jigs\Entities\Game;
use Drupal\jigs\Entities\City;
use Drupal\jigs\Entities\Mission;
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

  public $mapGridNode;

  public function __construct()
  {
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

  public function myState(Request $request)
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response                   = new AjaxResponse();
    $gameConfig                 = new Game();
    $responseData['gameConfig'] = $gameConfig->create();
    //$mapGrid                    = new MapGrid($responseData['player']['userMG']);
    $mapGridNode = $request->query->get('mapGrid');
    $mapGrid = new MapGrid($mapGridNode);
    $this->mapGridNode = $mapGridNode;

    $responseData['MapGrid']    = $mapGrid->create();
    $city                       = new City($responseData['MapGrid']['userCity']);
    $responseData['City']       = $city->create();

/////////////////////////////Missions Payload //////////////////////////////////

    $mission = new Mission();
    $responseData['missionSwitches'] = $mission->getAllMissionSwitches($this->mapGridNode);
    //$responseData['missionBosses']   = $mission->getAllMissionBosses($this->mapGrid);
    //$responseData['missionPortals]'] = $mission->getAllMissionPortals($this->mapGrid);

    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

  /////////////////////////////////////////////////////////////////////////////

  public function myPlayerState(Request $request)
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response = new AjaxResponse();
    $player                   = new Player();
    //$player = new DiscordPlayer($discordName = $request->query->get('discordName'));

    $responseData['player'] = $player->create();
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

  public function myMissions()
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response           = new AjaxResponse();
    $player = new Player(\Drupal\user\Entity\User::load(\Drupal::currentUser()->id()));
    $responseData = $player->myMissions();
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

  public function myMission(Request $request)
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response           = new AjaxResponse();
    $player = new Player(\Drupal\user\Entity\User::load(\Drupal::currentUser()->id()));
    $responseData = $player->myMission($request->query->get('npc'));
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

  public function addMission(Request $request)
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response           = new AjaxResponse();
    $player = new Player(\Drupal\user\Entity\User::load(\Drupal::currentUser()->id()));
    $responseData = $player->addMission($request->query->get('id'));
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

  public function myInventory()
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response           = new AjaxResponse();
    $player = new Player(\Drupal\user\Entity\User::load(\Drupal::currentUser()->id()));
    $responseData = $player->myInventory();
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

  public function toBackpack(Request $request)
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response           = new AjaxResponse();
    $player = new Player(\Drupal\user\Entity\User::load(\Drupal::currentUser()->id()));
    $responseData = $player->toBackpack($request->query->get('id'));
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

  public function toStorage(Request $request)
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response           = new AjaxResponse();
    $player = new Player(\Drupal\user\Entity\User::load(\Drupal::currentUser()->id()));
    $responseData = $player->toStorage($request->query->get('id'));
    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

  public function flickSwitch(Request $request)
  {
    /** @var \Drupal\Core\Ajax\AjaxResponse $response */
    $response           = new AjaxResponse();
    $player = new Player(\Drupal\user\Entity\User::load(\Drupal::currentUser()->id()));
    $responseData = $player->flickSwitch($request->query->get('id'));

    $response->addCommand(new \Drupal\Core\Ajax\DataCommand('#app', 'myKey', $responseData));
    return $response;
  }

   public function mySwitches( Request $request) {

      $build = [
      '#markup' => $this->t("

      <fieldset>
      <legend>Dublin</legend>
       <div>
       <input type='checkbox' id='001' name='001' /> <label for='001'>001</label>
       <input type='checkbox' id='002' name='002' /> <label for='002'>002</label>
       <input type='checkbox' id='003' name='003' /> <label for='003'>003</label>
       <input type='checkbox' id='004' name='004' /> <label for='004'>004</label>
       <input type='checkbox' id='005' name='005' /> <label for='005'>005</label>
       <input type='checkbox' id='006' name='006' /> <label for='006'>006</label>
       <input type='checkbox' id='007' name='007' /> <label for='007'>007</label>
       <input type='checkbox' id='008' name='008' /> <label for='008'>008</label>
       <input type='checkbox' id='009' name='009' /> <label for='009'>009</label>
       <input type='checkbox' id='010' name='010' /> <label for='010'>010</label>
        </div>
       </fieldset>
 <fieldset>
      <legend>Dublin</legend>
       <div>
       <input type='checkbox' id='001' name='001' /> <label for='001'>001</label>
       <input type='checkbox' id='002' name='002' /> <label for='002'>002</label>
       <input type='checkbox' id='003' name='003' /> <label for='003'>003</label>
       <input type='checkbox' id='004' name='004' /> <label for='004'>004</label>
       <input type='checkbox' id='005' name='005' /> <label for='005'>005</label>
       <input type='checkbox' id='006' name='006' /> <label for='006'>006</label>
       <input type='checkbox' id='007' name='007' /> <label for='007'>007</label>
       <input type='checkbox' id='008' name='008' /> <label for='008'>008</label>
       <input type='checkbox' id='009' name='009' /> <label for='009'>009</label>
       <input type='checkbox' id='010' name='010' /> <label for='010'>010</label>
        </div>
       </fieldset>
"),
    ];
    return $build;
  }

}
