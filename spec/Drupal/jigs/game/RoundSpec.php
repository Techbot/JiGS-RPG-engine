<?php

namespace spec\Drupal\jigs\game;

use PhpSpec\ObjectBehavior;

use Drupal\jigs\game\Player;
use Drupal\jigs\game\Npc;
use Drupal\jigs\game\Char;
use Drupal\jigs\game\Round;

class RoundSpec extends ObjectBehavior
{
    public $player;
    public $npc;

    function it_is_initializable(Char $player,Char $npc)
    {

        $this->player = new Player(1,6,100,10,0,0,0);
        $this->npc = new Npc(6,100,10,0);

        $this->beConstructedWith($player,$npc);
        $this->shouldHaveType(Round::class);
    }
}
