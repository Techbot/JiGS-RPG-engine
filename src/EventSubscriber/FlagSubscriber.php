<?php

/**
 * @file
 * Contains \Drupal\jigs\EventSubscriber\FlagSubscriber.
 */

namespace Drupal\jigs\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\flag\Event\FlagEvents;
use Drupal\flag\Event\FlaggingEvent;
use Drupal\flag\Event\UnflaggingEvent;
use Drupal\jigs\Entities\Player;

class FlagSubscriber implements EventSubscriberInterface
{

  public $user;
  public $player;
  public $database;

  function __construct()
  {
    $this->user           = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    $this->database       = \Drupal::database();
    $this->player         = new Player();
  }

  public function onFlag(FlaggingEvent $event)
  {
    $flagging           = $event->getFlagging();
    $entity_nid         = $flagging->getFlaggable()->id();

    $query             = $this->database->query("SELECT flagging.flag_id
    FROM flagging WHERE flagging.entity_id = " .  $entity_nid);
    $result = $query->fetchAll()[0]->flag_id;

    ///////////////////////////Switch ////////////////////////////////////////
    if ($result == 'switch') {
      $parentMission      = $this->getParentMission($entity_nid);
      $AllMissionSwitches = $this->getAllMissionSwitches($parentMission);
      $FlickedSwitches    = $this->player->getFlickedSwitches('switch');
      $loopcheck          = $this->getLoopCheck($AllMissionSwitches, $FlickedSwitches);
      if ($loopcheck) {
        $this->completeMission($parentMission);
      }
 ///////////////////////////Mission Completed ///////////////////////////


    }
  }

  public function getLoopCheck($AllMissionSwitches, $FlickedSwitches)
  {
    foreach ($AllMissionSwitches as $missionSwitch) {
      if (!in_array($missionSwitch, $FlickedSwitches)) {
        return false;
      }
    }
    return true;
  }

  public function onUnflag(UnflaggingEvent $event)
  {
    $flagging = $event->getFlaggings();
    $flagging = reset($flagging);
    $entity_nid = $flagging->getFlaggable()->id();
  }

  public static function getSubscribedEvents()
  {
    $events = [];
    $events[FlagEvents::ENTITY_FLAGGED][] = ['onFlag'];
    $events[FlagEvents::ENTITY_UNFLAGGED][] = ['onUnflag'];
    return $events;
  }

  // Find the mission that has this flagging in node_field_switches.entity id where field_switches_target_id =$flagging
  public function getParentMission($flagging)
  {
    $query             = $this->database->query("SELECT node__field_switches.entity_id
    FROM node__field_switches WHERE field_switches_target_id =" .  $flagging);
    return $query->fetchAll()[0]->entity_id;
  }

  // Find the mission that has this flagging in node_field_switches.entity id where field_switches_target_id =$flagging
  public function getAllMissionSwitches($parent)
  {
    $query             = $this->database->query("SELECT node__field_switches.field_switches_target_id
    FROM node__field_switches WHERE node__field_switches.entity_id = " .  $parent);
    return $query->fetchAll();
  }

  public function completeMission($id)
  {
    $missionEntity = \Drupal::entityTypeManager()->getStorage('paragraph')->load($id);
    $flag_service = \Drupal::service('flag');
    $flag = $flag_service->getFlagById('mission_complete'); // replace by flag machine name
    // check if already flagged
    $flagging = $flag_service->getFlagging($flag, $missionEntity, $this->user);
    if (!$flagging) {
      $flag_service->flag($flag, $missionEntity, $this->user);
      return true;
    } else {
      //   $flag_service->unflag($flag, $id, $this->user);
      return false;
    }
    return false;
  }
}
