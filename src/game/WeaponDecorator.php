<?php

namespace Drupal\jigs\game;

class WeaponDecorator extends PlayerDecorator {
    private $weapon;
    public $player;

    public function __construct( $player, $weapon)
    {
        $this->player = $player;
        $this->weapon = $weapon;
    }

    public function getStrength() {
       return $this->player->getStrength() + $this->weapon->getStrength() ;
    }

}
