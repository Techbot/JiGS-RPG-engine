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
Use Drupal\jigs\game\Dice;
Use Drupal\jigs\game\Loop;
/**
 * Defines application features from the specific context.
 */
class SecondContext implements Context, SnippetAcceptingContext
{

    public $round;
    public $player;
    public $npc;
    public $loop;

    public function __construct()
    {
        $this->player  = new Player(6,100,10,0,0,0);
        $this->npc     = new Npc(6,100,10,0);
        $this->round   = new Round($this->player,$this->npc );
        $this->loop    = new Loop( $this->round );
    }

    /**
     * @Given my testHealth is :arg1
     */
    public function myTestHealthIs($arg1)
    {
        $this->player->setHealth($arg1);
    }

    /**
     * @Given Npc testHealth is :arg1
     */
    public function npcTestHealthIs($arg1)
    {
        $this->npc->setHealth($arg1);
    }

    /**
     * @Given my losses is :arg1
     */
    public function myLossesIs($arg1)
    {
        $this->player->setLosses($arg1);
    }

    /**
     * @Given my Wins = :arg1
     */
    public function myWins($arg1)
    {
        $this->player->setWins($arg1);
    }

    /**
     * @When I compare
     */
    public function iCompare()
    {
        $this->loop->compare();
    }

    /**
     * @Then my losses should be :arg1
     */
    public function myLossesShouldBe($arg1)
    {
        Assert::assertEquals(  intval($arg1), $this->player->getLosses() );
    }

    /**
     * @Then my wins should be :arg1
     */
    public function myWinsShouldBe($arg1)
    {
        Assert::assertEquals(  intval($arg1), $this->player->getWins() );
    }


}
