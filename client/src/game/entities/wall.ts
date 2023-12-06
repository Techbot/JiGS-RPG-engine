import Phaser from "phaser";

export default class Wall extends Phaser.Physics.Arcade.Sprite {
  constructor(scene, x, y,width,height) {
    super(scene, parseInt(x), parseInt(y), 'black');
    this.setDisplaySize(parseInt(width), parseInt(height));
    this.setDepth(7);
  }
}
