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
/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    private $round;
    private $dice;
    private $dice2;
    private $player;
    private $npc;

    public function __construct()
    {
        $this->dice    = new Dice();
        $this->dice2   = new Dice();
        $this->player  = new Player(6,100,10,0,0,0);
        $this->npc     = new Npc(6,100,10,0);
        $this->round   = new Round($this->player,$this->npc );


    }

    /**
     * @Given I roll a dice of :arg1
     */
    public function iRollADiceOf($arg1)
    {
       $this->player->setDice($arg1);

    }

    /**
     * @When NPC rolls a dice of :arg1
     */
    public function npcRollsADiceOf($arg1)
    {
        $this->npc->setDice($arg1);
    }

///////////////////////////////////////////////////////////////

   /**
      * @Given my strength is :arg1
     */

    public function myStrengthIs($arg1)
    {
        $this->player->setStrength($arg1);
    }

    /**
     * @When NPC strength is :arg1
     */
    public function npcStrengthIs($arg1)
    {
        $this->npc->setStrength($arg1 );
    }

/////////////////////////////////////////////////////////////////////////////


    /**
     * @When NPC health is :NpcHealth
     */

    public function npcHealthIs($NpcHealth)
    {
        $this->round->npc->setHealth($NpcHealth);
    }

    /**
     * @When my health is :myHealth
     */
    public function myHealthIs($myHealth)
    {
        $this->round->player->setHealth($myHealth);
    }

////////////////////////////
   /**
     * @When I strike
     */
    public function iStrike()
    {
     //   $this->round->update();
        $this->round->fight();
    }

    /**
     * @When I update
     */
    public function iUpdate()
    {
        $this->round->update();
    }

  /**
     * @Then my attack should be :arg1
     */
    public function myAttackShouldBe($arg1)
    {
        Assert::assertEquals(  intval($arg1), $this->round->player->getAttack() );
    }

    ////////////////////////////////////////////////

    /**
     * @Then NPC health should be :arg1
     */
    public function npcHealthShouldBe($arg1)
    {
        Assert::assertEquals(  intval($arg1), $this->round->npc->getHealth() );
    }

    /**
     * @Then my health should be :arg1
     */
    public function myHealthShouldBe($arg1)
    {
        Assert::assertEquals(  intval($arg1), $this->round->player->getHealth() );
    }

}
