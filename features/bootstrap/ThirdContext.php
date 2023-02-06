<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert as Assert;

Use Drupal\jigs\game\Round;
Use Drupal\jigs\game\Player;
Use Drupal\jigs\game\Npc;
Use Drupal\jigs\game\Weapon;
use Drupal\jigs\game\FactionDecorator;
use Drupal\jigs\game\WeaponDecorator;
/**
 * Defines application features from the specific context.
 */
class ThirdContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */

    public $player;
    public $weapon;

    public function __construct()
    {

        $one = new Player(6,100,10,0,0,0);
        $two = new FactionDecorator($one, 7);
        $this->player = new WeaponDecorator($two, 6);
        $this->weapon = new Weapon(6);
        //$this->player =  new Player(6,100,10,0,0,0);

    }

    /**
     * @Given A strength of player :arg1
     */
    public function aStrengthOfPlayer($arg1)
    {
        $this->player->setStrength(10);
    }

    /**
     * @When weaponStrength of :arg1
     */
    public function weaponStrengthOf($arg1)
    {
        $this->weapon->setStrength($arg1);
    }


    /**
     * @Then I should have a totalStrength of :arg1
     */
    public function iShouldHaveATotalStrengthOf($arg1)
    {

        Assert::assertEquals(  intval($arg1), $this->player->getStrength() );
    }


}
