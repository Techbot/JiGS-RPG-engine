import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';


export default class Wall extends Phaser.Physics.Arcade.Sprite {

  jigs: any;

  constructor(scene, x, y,width,height) {
    super(scene, parseInt(x), parseInt(y), 'black');
    this.setDisplaySize(parseInt(width), parseInt(height));
    this.setDepth(7);
    this.jigs = useJigsStore();
    this.setVisible(this.jigs.debug);
    this.alpha = 0.5;
  }
}
