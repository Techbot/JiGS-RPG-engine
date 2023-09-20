<?php

namespace Drupal\jigs\game;
class Loop
{
    public $round;
    public $player;
    public $npc;
    public $text;

    public function __construct($round)
    {
        $this->round   = $round;
        $this->player  = $this->round->player;
        $this->npc     = $this->round->npc;
    }

    public function Loop(){
        do {
          $this->text .=  $this->round->fight();
        }
        while  ($this->player->getHealth() >= 0 && $this->npc->getHealth() >= 0 );

        return $this->compare();
    }

    public function compare(){

        if ($this->npc->getHealth() <= 0){
            $this->player->setWins($this->player->getWins() + 1);
            $this->text .=  "you won<br>";
          //  $this->player->setHealth(200);
        }
        elseif ($this->player->getHealth() <= 0){
            $this->player->setHealth(100);
            $this->player->setLosses($this->player->getLosses() + 1);
            $this->text .=  "you died<br>";
        }

    $response['text'] =   $this->text;
    $response['name'] = 'fight';

    $response['player_level']    = $this->player->getLevel();
    $response['player_strength'] = $this->player->getStrength();
    $response['player_stamina']  = $this->player->getStamina();
    $response['player_attack']   = $this->player->getAttack();
    $response['player_defense']  = $this->player->getDefense();
    $response['player_dice1']    = $this->player->getDice1();
    $response['player_dice2']    = $this->player->getDice2();
    $response['player_health']   = $this->player->getHealth();
    $response['player_wins']     = $this->player->getWins();
    $response['player_losses']   = $this->player->getLosses();
    $response['player_credits']  = $this->player->getCredits();

    $response['npc_level']    = $this->npc->getLevel();
    $response['npc_strength'] = $this->npc->getStrength();
    $response['npc_stamina']  = $this->npc->getStamina();
    $response['npc_attack']   = $this->npc->getAttack();
    $response['npc_defense']  = $this->npc->getDefense();
    $response['npc_dice1']    = $this->npc->getDice1();
    $response['npc_dice2']    = $this->npc->getDice2();
    $response['npc_health']   = $this->npc->getHealth();


    return  $response;

    }

}
