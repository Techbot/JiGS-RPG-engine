<?php

namespace Drupal\jigs\Entities;

class Player
{
    public $user;
    public $playerName;
    public $id;
    public $playerStats;
    public $name;
    public $userGamesState;
    public $database;
    public $userMG;

    function __construct()
    {

        $this->user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
        $this->database       = \Drupal::database();
    }

    public function create()
    {
        //$this->name           = $this->user->get("name")->value;
        $this->id              = \Drupal::currentUser()->id();
        $player['id']          = \Drupal::currentUser()->id();
        $player['name']        = $this->user->get("name")->value;
        $this->userGamesState  = $this->user->field_game_state->value;
        $player['userState']   = $this->userGamesState;
        $query                 = $this->database->query("SELECT field_map_grid_target_id FROM user__field_map_grid WHERE entity_id= " . $this->id);
        $player['userMG']      = $query->fetchAll()[0]->field_map_grid_target_id;
        $query                 = $this->database->query("SELECT field_credits_value FROM user__field_credits WHERE entity_id= " . $this->id);
        $player['credits']     = $query->fetchAll()[0]->field_credits_value;
        $query                 = $this->database->query("SELECT field_health_value FROM user__field_health WHERE entity_id= " . $this->id);
        $player['health']      = $query->fetchAll()[0]->field_health_value;
        $query                 = $this->database->query("SELECT field_energy_value FROM user__field_energy WHERE entity_id= " . $this->id);
        $player['energy']      = $query->fetchAll()[0]->field_energy_value;
        //Cached stuff
        $player['level'] = $this->user->field_level->value;
        $player['intelligence'] = $this->user->field_intelligence->value;
        $player['strength'] = $this->user->field_strength->value;
        $player['dexterity'] = $this->user->field_dexterity->value;
        $player['endurance'] = $this->user->field_endurance->value;
        $player['charisma'] = $this->user->field_charisma->value;
        $player['psi'] = $this->user->field_psi->value;
        $player['losses'] = $this->user->field_losses->value;
        $player['wins'] = $this->user->field_wins->value;
        $player['xp'] = $this->user->field_experience->value;
        $player['sprite_sheet'] = $this->user->field_sprite_sheet->value;
        return $player;
    }
}
