/**
 * ------- Doorway ---------
 */
import Phaser from "phaser";

export default class Doorway extends Phaser.Physics.Arcade.Sprite {
  constructor(scene, x, y) {
    super(scene, x, y, 'ship');
    this.pathIndex = 0;
  }

}
