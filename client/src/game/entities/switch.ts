import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
export default class Switch extends Phaser.Physics.Arcade.Sprite {
  jigs: any;
  constructor(scene, x, y) {
    super(scene, x, y, 'switch-001-lever-off');
    this.jigs = useJigsStore();
    const stuff = 0;
    // this.pathIndex = 0;
    this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' });
    this.on('pointerdown', this.onSwitchDown.bind(this, stuff));


  }
  preUpdate(time, delta) {
    this.setDepth(6);
  }

  onSwitchDown(stuff) {
    console.log('switch flicked')
  }
}
