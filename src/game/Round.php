<?php

namespace Drupal\jigs\game;

class Round
{
    public $player;
    public $npc;
    public $text;

    public function __construct($player, $npc, $text)
    {
        $this->npc    = $npc;
        $this->player = $player;
        $this->text   = $text;
    }

    public function roll(){

        $newPlayerDice1 = new Dice;
        $newPlayerDice2 = new Dice;
        $newNpcDice1    = new Dice;
        $newNpcDice2    = new Dice;

        $this->player->setDice1($newPlayerDice1->getDiceValue());
        $this->player->setDice2($newPlayerDice2->getDiceValue());

        $this->player->setAttack(  (int)$this->player->getStrength() + (int)$newPlayerDice1->getDiceValue() );
        $this->player->setDefense( (int)$this->player->getStamina() + (int)$newPlayerDice2->getDiceValue());

        $this->npc->setAttack(  (int)$this->npc->getStrength() + (int)$newNpcDice1->getDiceValue() );
        $this->npc->setAttack( (int)$this->npc->getStamina() + (int)$newNpcDice2->getDiceValue());

}

    public function update(){

        $this->player->setAttack( $this->player->getStrength() +  $this->player->getDice1() );
        $this->npc->setAttack( $this->npc->getStrength() +  $this->npc->getDice1() );
        $this->player->setDefense($this->player->getStamina() +  $this->player->getDice2());
        $this->npc->setDefense($this->npc->getStamina() +  $this->npc->getDice2());

    }

    public function fight(){

        $this->roll();

        if ((int)$this->player->getAttack() > (int)$this->npc->getAttack() ){

         //   $this->text .=  "Player stabs NPC <br>";
        //    $this->npc->setHealth ((int)$this->npc->getHealth() - 10);

        }

        if ($this->player->getAttack() < (int)$this->npc->getAttack() ){
      //      $this->text .=  "NPC stabs Player <br>";
          //  $this->player->setHealth ((int)$this->player->getHealth() - 10);
        }

      return  $this->text;

    }
}
