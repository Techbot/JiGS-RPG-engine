<?php

namespace Drupal\jigs\game;

class Faction{

    public $strength;

    public function __construct($strength = 10)
    {
        $this->strength   = $strength;

    }

    public function getStrength()
    {
      return  $this->strength ;

    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

}
