Feature: Attack Loop
  in order to play game
  As a player
  I need to die if my health is zero

  Rules :
  - Both players begin with 100 health
  - Both players begin with 10 strength
  - Each round both players roll one dice and and it to the strenght to make an attack
  - Player with lower attack  loses health points equal to difference in attack
  - First player whose health = 0 loses


  Scenario: I lose
    Given my testHealth is 0
    And my losses is 0
    When I compare
    Then my losses should be 1


  Scenario: I win
    Given Npc testHealth is 0
    And my Wins = 0
    When I compare
    Then my wins should be 1
