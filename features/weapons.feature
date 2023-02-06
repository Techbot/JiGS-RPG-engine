Feature: Strength creation
  in order to play game
  As a player
  I need to calculate my strength

  Rules :
  - Player has three strength sources player strength, weapon strength and faction strength

  Scenario: Weapon adds to player strength
    Given A strength of player 10
    When weaponStrength of 6
    Then I should have a totalStrength of 23