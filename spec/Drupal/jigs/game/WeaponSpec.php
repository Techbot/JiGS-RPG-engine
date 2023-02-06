<?php

namespace spec\Drupal\jigs\game;

use Drupal\jigs\game\Weapon;
use PhpSpec\ObjectBehavior;

class WeaponSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(4);
        $this->shouldHaveType(Weapon::class);
    }


    function it_sets_a_weapon_Strength()
    {
        $this->beConstructedWith(4);
        $this->setStrength(4);
    }

}
