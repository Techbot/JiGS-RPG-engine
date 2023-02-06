<?php

namespace spec\Drupal\jigs\game;


use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Drupal\jigs\game\Player;
class PlayerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(6,100,10,0,0,0,0);
        $this->shouldHaveType(Player::class);
    }
}
