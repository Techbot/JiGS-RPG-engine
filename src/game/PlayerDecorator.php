<?php

namespace Drupal\jigs\game;

/**
 * The base Decorator class follows the same interface as the other components.
 * The primary purpose of this class is to define the wrapping interface for all
 * concrete decorators. The default implementation of the wrapping code might
 * include a field for storing a wrapped component and the means to initialize
 * it.
 */
class PlayerDecorator extends Player implements iPlayer
{
    /**
     * @var Player
     */
    public $player;

    public function __construct(iPlayer $player)
    {
        $this->player = $player;
    }

    /**
     * The Decorator delegates all work to the wrapped component.
     */
    public function getStrength()
    {
        return $this->player->getStrength();
    }

    public function setStrength($number) {

        $this->player->setStrength($number);
    }

    public function getCredits()
    {
        return $this->player->getCredits();
    }

    public function getLevel()
    {
        return $this->player->getLevel();
    }

    public function getStamina()
    {
        return $this->player->getStamina();
    }


}
