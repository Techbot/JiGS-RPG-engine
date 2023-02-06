<?php

namespace Drupal\jigs\game;

class Npc extends Char
{

    public function __construct( $level, $health, $strength, $stamina, $attack, $defense, $dice1, $dice2)
    {
        $this->level    = $level;
        $this->health   = $health;
        $this->strength = $strength;
        $this->stamina  = $stamina;
        $this->attack   = $attack;
        $this->defense  = $defense;
        $this->dice1    = $dice1;
        $this->dice2    = $dice2;
    }
}
