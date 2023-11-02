<?php

namespace Drupal\jigs\Game;

class Player extends Char implements iPlayer
{
    public $losses;
    public $wins;
    public $credits;

    public function __construct($level, $health, $strength, $stamina, $attack, $defense, $dice1, $dice2, $losses, $wins, $credits )
    {
        $this->level    = $level;
        $this->health   = $health;
        $this->strength = $strength;
        $this->stamina  = $stamina;
        $this->attack   = $attack;
        $this->defense  = $defense;
        $this->losses   = $losses;
        $this->wins     = $wins;
        $this->credits  = $credits;
        $this->dice1    = $dice1;
        $this->dice2    = $dice2;
    }

    public function getLosses()
    {
        return $this->losses;
    }
    public function setLosses($losses)
    {
        $this->losses = $losses;
    }

    public function getWins()
    {
        return $this->wins;
    }
    public function setWins($wins)
    {
        $this->wins = $wins;
    }

    public function getCredits()
    {
        return $this->credits;
    }
    public function setCredits($credits)
    {
        $this->credits = $credits;
    }
}
