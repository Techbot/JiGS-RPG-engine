import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';


export default class Wall extends Phaser.Physics.Arcade.Sprite {
  jigs: any;
  wallWidth: any;
  wallHeight: any;

  constructor(scene, x, y, width, height) {
    super(scene, parseInt(x), parseInt(y), 'black');
    this.setDisplaySize(parseInt(width), parseInt(height));
    this.setDepth(7);
    this.wallWidth  = width;
    this.wallHeight = height;
    this.x          = x;
    this.y          = y;
    this.jigs       = useJigsStore();
    this.setVisible(this.jigs.debug);
    this.alpha      = 0.5;
    this.setTexture('black');
    const obstacle = this;
    if (this.jigs.debug) {
      this.do_something_special();
    }
  }
  do_something_special() {
    this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
    this.on('pointerdown', this.onWallDown.bind(this));
  }

  onWallDown() {
    console.log("X: " + this.x + " Y: " + this.y + "Width: " + this.wallWidth + " Height: " + this.wallHeight )
  }
}
