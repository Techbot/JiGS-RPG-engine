<?php

namespace Drupal\jigs\game;

class Char
{
    public $level;
    public $strength;
    public $stamina;
    public $health;
    public $attack;
    public $defense;
    public $dice1;
    public $dice2;

    public function __construct($level,  $health, $strength, $stamina, $attack, $defense, $dice1, $dice2 )
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

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getLevel()
    {
        return  $this->level;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    public function getStrength()
    {
       return  $this->strength ;
    }

    public function setStamina($stamina)
    {
        $this->stamina = $stamina;
    }

    public function getStamina()
    {
        return  $this->stamina;
    }

    public function getHealth()
    {
        return $this->health;
    }
    public function setHealth($health)
    {
      //  $this->health = $health;
    }

    public function getAttack()
    {
        return $this->attack;
    }
    public function setAttack($attack)
    {
        $this->attack = $attack;
    }

    public function getDefense()
    {
        return $this->defense;
    }
    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    public function setDice1($dice1)
    {
        $this->dice1 = $dice1;
    }

    public function getDice1()
    {
        return  $this->dice1;
    }

    public function setDice2($dice2)
    {
        $this->dice2 = $dice2;
    }

    public function getDice2()
    {
        return  $this->dice2;
    }

}
