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

  function __construct($userMG)
  {
    $this->MapGrid =  \Drupal::entityTypeManager()->getStorage('node')->load($userMG);
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

    $mapGrid['npcArray']      = $this->getNpcs();
    $mapGrid['mobArray']      = $this->getMobs();
    $mapGrid['portalsArray']  = $this->getPortals();
    $mapGrid['rewardsArray']  = $this->getRewards();
    $mapGrid['tileset']       = $this->getLayers();
    $mapGrid['name']          = $this->MapGrid->get('title')->value;
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
    foreach ($this->MapGrid->field_npc->referencedEntities() as $Npc) {
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
    return $NpcArray;
  }

  function getMobs()
  {
    foreach ($this->MapGrid->field_mobs->referencedEntities() as $Mob) {

      $MobObject =  \Drupal::entityTypeManager()->getStorage('node')->load($Mob->field_mobs->getValue()[0]['target_id']);

      $mArray[] =
        [
          $Mob->field_mobs->getValue()[0]['target_id'],
          $Mob->field_mob_name->value,
          $Mob->field_x->value,
          $Mob->field_y->value,
          $MobObject->field_mob_sprite_sheet->getValue()[0]['value'],
          $MobObject->getTitle()
        ];
    }
    return $mArray;
  }
}
