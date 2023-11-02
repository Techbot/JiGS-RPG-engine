<?php

namespace Drupal\jigs\Game;

class Dice
{
    private $diceValue;

    public function __construct(){

        $this->diceValue = rand(1,6);

    }

    public function getDiceValue()
    {
        return $this->diceValue ;

    }

    public function setDiceValue($arg){

        $this->diceValue = $arg;

    }

}
