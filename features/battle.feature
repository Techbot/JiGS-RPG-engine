Feature: Attack Battle
  in order to play game
  As a player
  I need to attack another random npc player

  Rules :
  - Both players begin with 100 health
  - Both players begin with 10 strength
  - Each round both players roll one dice and and it to the strenght to make an attack
  - Player with lower attack  loses health points equal to difference in attack
  - First player whose health = 0 loses


  Scenario: Adding dice to strength one
    Given I roll a dice of 6
    And my strength is 10
    When I update
    Then my attack should be 16


  Scenario: Player attack is greater than npc attack
    Given I roll a dice of 6
    And my strength is 10

    And NPC strength is 5
    And NPC rolls a dice of 3
    And NPC health is 100
    When I strike
    Then NPC health should be 90

   Scenario: Adding dice to strength two
    Given I roll a dice of 4
    And my strength is 10
    When I update
    Then my attack should be 14

  Scenario: Player strength is less than npc attack
    Given I roll a dice of 4
    And my strength is 10

    And NPC strength is 15
    And NPC rolls a dice of 3
    And my health is 100
    When I strike
    Then my health should be 90

   Scenario: Adding dice to strength three
    Given I roll a dice of 6
    And my strength is 10
    When I update
    Then my attack should be 16

  Scenario: Player attack is equal to npc attack
    Given I roll a dice of 6
    And my strength is 10

    And NPC strength is 15
    And NPC rolls a dice of 1
    And NPC health is 100
    When I strike
    Then NPC health should be 100
