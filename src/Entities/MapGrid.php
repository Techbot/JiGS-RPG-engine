<?php

namespace Drupal\jigs\Entities;

class MapGrid
{
  public $MapGrid;
  public $tiled;
  public $name;
  public $mapWidth;
  public $mapHeight;
  public $portalsArray;
  public $rewardsArray;
  public $npcArray;
  public $mobArray;
  public $userCity;
  public $portals;
  public $tileset;
  public $userId;
  public $player;
  public $playerSwitchesStates;
  public $empty;

  function __construct($userMG, $userId, $player)
  {
    $this->MapGrid =  \Drupal::entityTypeManager()->getStorage('node')->load($userMG);
    $this->userId = $userId;
    $this->player = $player;
    $this->playerSwitchesStates = $this->player->getAllFlickedSwitches();
  }

  function create()
  {
    if ($this->MapGrid->field_tiled->getValue()) {
      $mapGrid['tiled']         = $this->MapGrid->field_tiled->getValue()[0]['value'];
    }
    if ($this->MapGrid->field_map_width->getValue()) {
      $mapGrid['mapWidth']      = $this->MapGrid->field_map_width->getValue()[0]['value'];
    }
    if ($this->MapGrid->field_map_height->getValue()) {
      $mapGrid['mapHeight']     = $this->MapGrid->field_map_height->getValue()[0]['value'];
    }
    if ($this->MapGrid->field_city->getValue()) {
      $mapGrid['userCity']      = (int)$this->MapGrid->field_city->getValue()[0]['target_id'];
    }
    $mapGrid['npcArray']          = $this->getNpcs();
    $mapGrid['mobArray']          = $this->getMobs();
    $mapGrid['portalsArray']      = $this->getPortals();
    $mapGrid['switchesArray']     = $this->getSwitches('switches');
    $mapGrid['fireArray']         = $this->getSwitches('fire');
    $mapGrid['fireBarrelsArray']  = $this->getSwitches('fireBarrel');
    $mapGrid['leverArray']        = $this->getSwitches('lever');
    $mapGrid['machineArray']      = $this->getSwitches('machine');
    $mapGrid['crystalArray']      = $this->getSwitches('crystal');
    $mapGrid['foliosArray']       = $this->getFolios();
    $mapGrid['wallsArray']        = $this->getWalls();
    $mapGrid['rewardsArray']      = $this->getRewards();
    $mapGrid['tileset']           = $this->getLayers();
    $mapGrid['name']              = $this->MapGrid->get('title')->value;
    return $mapGrid;
  }

  function getPortals()
  {
    $portals = [];
    foreach ($this->MapGrid->field_portals->referencedEntities() as $portal) {
      $portals[] = [
        'destination'   => (int)$portal->field_destination->getValue()[0]['target_id'],
        'destination_x' => (int)$portal->field_destination_x->getValue()[0]['value'],
        'destination_y' => (int)$portal->field_destination_y->getValue()[0]['value'],
        'tiled' => (int)$portal->field_tiled->getValue()[0]['value'],
        'x' => (int)$portal->field_x->getValue()[0]['value'],
        'y' => (int)$portal->field_y->getValue()[0]['value']
      ];
    }
    return $portals;
  }

  function getSwitches($type)
  {
    switch ($type) {
      case 'fire':
        $this->empty = $this->MapGrid->field_fire;
        break;
      case 'fireBarrel':
        $this->empty = $this->MapGrid->field_fire_barrel;
        break;
      case 'lever':
        $this->empty = $this->MapGrid->field_lever;
        break;
      case 'machine':
        $this->empty = $this->MapGrid->field_machine;
        break;
      case 'switches':
        $this->empty = $this->MapGrid->field_switches;
        break;
    }

    $switches = [];
    foreach ($this->empty->referencedEntities() as $switch) {

      $switches[] = [
        'id' => $switch->id->getValue()[0]['value'],
        // 'id' => $switch->field_switch_id->getValue()[0]['value'],
        'x' => (int)$switch->field_x->getValue()[0]['value'],
        'y' => (int)$switch->field_y->getValue()[0]['value'],
        'file' =>  $switch->field_file->getValue()[0]['value'],
        'frameHeight' => (int)$switch->field_frameheight->getValue()[0]['value'],
        'frameWidth' => (int)$switch->field_framewidth->getValue()[0]['value'],
        'numberOfFrames' => (int)$switch->field_number_of_frames->getValue()[0]['value'],
        'type' => (int)$switch->field_switch_type->getValue()[0]['value'],
        'repeat' => (int)$switch->field_repeatable->getValue()[0]['value'],
        'startFrame' => (int)$switch->field_starting_frame->getValue()[0]['value'],
        'endFrame' => (int)$switch->field_end_frame->getValue()[0]['value'],
        'switchState' => in_array($switch->id->getValue()[0]['value'], $this->playerSwitchesStates)
      ];
    }
    return $switches;
  }

  function getFolios()
  {
    $folios = [];
    foreach ($this->MapGrid->field_folio->referencedEntities() as $folio) {
      $FolioObject =  \Drupal::entityTypeManager()->getStorage('node')->load($folio->field_page->getValue()[0]['target_id']);
      $folios[] = [
        'id' => $folio->id->getValue()[0]['value'],
        'node'=>$folio->field_page->getValue()[0]['target_id'],
        'nodeBody'=>$FolioObject->get('body')->value,
        'x' => (int)$folio->field_x->getValue()[0]['value'],
        'y' => (int)$folio->field_y->getValue()[0]['value']
      ];
    }
    return $folios;
  }

  function getRewards()
  {
    $rewards = [];
    if ($this->MapGrid->field_rewards->referencedEntities) {
      foreach ($this->MapGrid->field_rewards->referencedEntities as $reward) {
        $rewards[] = [
          'ref' => $reward->field_ref->getValue()[0]['value'],
          'x' => (int)$reward->field_x->getValue()[0]['value'],
          'y' => (int)$reward->field_y->getValue()[0]['value']
        ];
      }
    }
    return $rewards;
  }

  function getLayers()
  {
    $responseData = [];
    foreach ($this->MapGrid->field_layer_1->referencedEntities() as $tileset) {
      $responseData['tilesetArray_1'][] = $tileset->name->value;
    }
    foreach ($this->MapGrid->field_layer_2->referencedEntities() as $tileset) {
      $responseData['tilesetArray_2'][] = $tileset->name->value;
    }
    foreach ($this->MapGrid->field_layer_3->referencedEntities() as $tileset) {
      $responseData['tilesetArray_3'][] = $tileset->name->value;
    }
    foreach ($this->MapGrid->field_layer_4->referencedEntities() as $tileset) {
      $responseData['tilesetArray_4'][] = $tileset->name->value;
    }
    foreach ($this->MapGrid->field_layer_5->referencedEntities() as $tileset) {
      $responseData['tilesetArray_5'][] = $tileset->name->value;
    }
    return $responseData;
  }

  function getNpcs()
  {
    $NpcArray = [];

    if (is_array($this->MapGrid->field_npc->referencedEntities())) {
      foreach ($this->MapGrid->field_npc->referencedEntities() as $Npc) {
        $NpcObject =  \Drupal::entityTypeManager()->getStorage('node')->load($Npc->field_name->getValue()[0]['target_id']);
        $NpcArray[] =
          [
            $NpcObject->getTitle(),
            $Npc->field_x->value,
            $Npc->field_y->value,
            $NpcObject->field_sprite_sheet->getValue()[0]['value'],
            $NpcObject->field_bark->value,
            $NpcObject->field_is_handler->getValue()[0]['value'],
            $Npc->field_name->getValue()[0]['target_id']
          ];
      }
    }
    return $NpcArray;
  }

  function getMobs()
  {
    $mArray = [];
    foreach ($this->MapGrid->field_mobs->referencedEntities() as $Mob) {
      $MobObject =  \Drupal::entityTypeManager()->getStorage('node')->load($Mob->field_mobs->getValue()[0]['target_id']);
      $mArray[] =
        [
          $Mob->field_mobs->getValue()[0]['target_id'],
         // $Mob->field_mob_name->getValue()[0]['value'],
          $Mob->field_mob_name->value,
          $Mob->field_x->value,
          $Mob->field_y->value,
          $MobObject->field_mob_sprite_sheet->getValue()[0]['value'],
          $MobObject->getTitle()
        ];
    }
    return $mArray;
  }

  function getWalls()
  {
    $wallsArray = [];
    foreach ($this->MapGrid->field_walls->referencedEntities() as $Wall) {
      $wallsArray[] =
        [
          'x'=>$Wall->field_x->value,
          'y'=>$Wall->field_y->value,
          'width'=>$Wall->field_width->value,
          'height'=>$Wall->field_height->value,
        ];
    }
    return $wallsArray;
  }
}
