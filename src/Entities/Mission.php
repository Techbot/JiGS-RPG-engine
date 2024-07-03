<?php

namespace Drupal\jigs\Entities;

class Mission
{


  function __construct($userMG, $userId, $player)
  {
    $this->MapGrid = \Drupal::entityTypeManager()->getStorage('node')->load($userMG);
    //$this->userId = $userId;
    $this->$userMG = $userMG;
    $this->player = $player;
    //$this->playerSwitchesStates = $this->player->getAllFlickedSwitches();
    $this->AllMissionSwitches = $this->getAllMissionSwitches($userMG);
    $this->AllMissionDialogue = $this->getAllMissionDialogs($userMG);
    $this->AllMissionBosses = $this->getAllMissionBosses($userMG);
  }





  function getAllMissionSwitches($userMG)
  {
    $database = \Drupal::database();
    $user = \Drupal::currentUser()->id();
    $query = $database->query("SELECT paragraph__field_switch.entity_id,
    paragraph__field_x.field_x_value,
    paragraph__field_y.field_y_value,
    node__field_image.field_image_target_id ,
    file_managed.filename as field_file_value,
    node__field_frame_height.field_frame_height_value,
    node__field_frame_width.field_frame_width_value,
    node__field_number_of_frames.field_number_of_frames_value,
    node__field_switch_type.field_switch_type_value,
    node__field_repeatable.field_repeatable_value,
    node__field_starting_frame.field_starting_frame_value,
    node__field_end_frame.field_end_frame_value
    FROM profile__field_missions

    LEFT JOIN paragraph__field_mission
    ON profile__field_missions.field_missions_target_id = paragraph__field_mission.entity_id

    LEFT JOIN node__field_switches
    ON node__field_switches.entity_id = paragraph__field_mission.field_mission_target_id

    LEFT JOIN paragraph__field_switch
    ON paragraph__field_switch.entity_id = node__field_switches.field_switches_target_id

    LEFT JOIN paragraph__field_map_grid
    ON paragraph__field_map_grid.entity_id = paragraph__field_switch.entity_id

    LEFT JOIN paragraph__field_x
    ON paragraph__field_x.entity_id = paragraph__field_switch.entity_id

    LEFT JOIN paragraph__field_y
    ON paragraph__field_y.entity_id = paragraph__field_switch.entity_id

    LEFT JOIN node__field_image
    ON node__field_image.entity_id = paragraph__field_switch.field_switch_target_id

    LEFT JOIN file_managed
    ON node__field_image.field_image_target_id = file_managed.fid

    LEFT JOIN node__field_frame_height
    ON node__field_frame_height.entity_id = node__field_image.entity_id

    LEFT JOIN node__field_frame_width
    ON node__field_frame_width.entity_id = node__field_image.entity_id

    LEFT JOIN node__field_number_of_frames
    ON node__field_number_of_frames.entity_id = node__field_image.entity_id

    LEFT JOIN node__field_switch_type
    ON node__field_switch_type.entity_id = node__field_image.entity_id

   LEFT JOIN node__field_repeatable
   ON node__field_repeatable.entity_id = node__field_image.entity_id

   LEFT JOIN node__field_starting_frame
   ON node__field_starting_frame.entity_id = node__field_image.entity_id

   LEFT JOIN node__field_end_frame
   ON node__field_end_frame.entity_id = node__field_image.entity_id

   WHERE profile__field_missions.entity_id = " . $user . " AND paragraph__field_map_grid.field_map_grid_target_id = " . $userMG);

    ////////////////////////////////////////////////////////////////////////
    // Now get the switches state and add it to the array item.
    $switchesArray = $query->fetchAll();

    foreach ($switchesArray as $switch) {

      if ($this->playerSwitchesStates) {
        $switch->switchState = in_array($switch->entity_id, $this->playerSwitchesStates);
      }
    }

    return $switchesArray;
  }







  function getAllMissionBosses($userMG)
  {
    $database = \Drupal::database();
    $user = \Drupal::currentUser()->id();
    $query = $database->query("SELECT profile__field_missions.entity_id as name,
paragraph__field_mission.entity_id as pt,
node__field_level_boss.field_level_boss_target_id,
paragraph__field_boss.field_boss_target_id,
paragraph__field_x.field_x_value,
paragraph__field_y.field_y_value,
node__field_image.field_image_target_id as image,
file_managed.filename

FROM profile__field_missions

LEFT JOIN paragraph__field_mission
ON paragraph__field_mission.entity_id= profile__field_missions.field_missions_target_id

LEFT JOIN node__field_level_boss
ON node__field_level_boss.entity_id = paragraph__field_mission.field_mission_target_id

LEFT JOIN paragraph__field_boss
ON paragraph__field_boss.entity_id = node__field_level_boss.field_level_boss_target_id

LEFT JOIN paragraph__field_map_grid
ON paragraph__field_map_grid.entity_id = paragraph__field_boss.entity_id

LEFT JOIN paragraph__field_x
ON paragraph__field_x.entity_id = paragraph__field_boss.entity_id

LEFT JOIN paragraph__field_y
ON paragraph__field_y.entity_id = paragraph__field_boss.entity_id

LEFT JOIN node__field_image
ON node__field_image.entity_id = paragraph__field_boss.field_boss_target_id

LEFT JOIN file_managed
ON file_managed.fid = node__field_image.field_image_target_id

WHERE profile__field_missions.entity_id = 1 AND paragraph__field_map_grid.field_map_grid_target_id =4");

    ////////////////////////////////////////////////////////////////////////
    // Now get the switches state and add it to the array item.
    $switchesArray = $query->fetchAll();

    foreach ($switchesArray as $switch) {

      if ($this->playerSwitchesStates) {
        $switch->switchState = in_array($switch->entity_id, $this->playerSwitchesStates);
      }
    }

    return $switchesArray;
  }





}
