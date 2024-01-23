/**
 * ------- Drone ---------
 */
import Phaser from "phaser";

export default class Drone extends Phaser.Physics.Arcade.Sprite {
  path: Phaser.Curves.Ellipse;
  pathIndex: number;
  pathSpeed: any;
  pathVector: Phaser.Math.Vector2;

  constructor(scene, x, y, width, height, speed) {
    super(scene, x, y, 'star');
    //  This is the path the sprite will follow
    //     scene.add.existing(this);
    this.path = new Phaser.Curves.Ellipse(x, y, width, height);
    this.pathIndex = 0;
    this.pathSpeed = speed;
    this.pathVector = new Phaser.Math.Vector2();
    this.setDepth(7);
    this.path.getPoint(0, this.pathVector);
    this.setPosition(this.pathVector.x, this.pathVector.y);
  }

  preUpdate(time, delta) {
    super.preUpdate(time, delta);
    this.path.getPoint(this.pathIndex, this.pathVector);
    this.setPosition(this.pathVector.x, this.pathVector.y);
    this.pathIndex = Phaser.Math.Wrap(this.pathIndex + this.pathSpeed, 0, 1);
  }

  update(newX, newY) {
    this.path.x = newX;
    this.path.y = newY;
  }
}
