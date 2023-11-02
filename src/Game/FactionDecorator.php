<?php

namespace Drupal\jigs\Game;

class FactionDecorator extends PlayerDecorator {

    private $faction;
    public $player;


    public function __construct( $player, $faction)
    {
        $this->player  = $player;
        $this->faction = $faction;
    }

    public function getStrength()
    {

        return (int)$this->player->getStrength() + (int)$this->faction->getStrength() ;
    }

    public function setStrength($number)
    {
        $this->player->setStrength($number);
    }

}


