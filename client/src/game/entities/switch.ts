import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
export default class Switch extends Phaser.Physics.Arcade.Sprite {
  jigs: any;

  constructor(scene, x, y,id) {
    super(scene, x, y,null);
    this.jigs = useJigsStore();
    scene.add.sprite(0, 0, 'switch_' + id);
    this.setTexture('switch_' + id);
    const stuff = 0;
    this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' });
    this.on('pointerdown', this.onSwitchDown.bind(this, id));
    this.setFrame(1);
    this.setDepth(6);
  }

  onSwitchDown(id) {
    console.log('switchAnim_' + id);
    this.play('switchAnim_' + id);
    this.setFrame(2);
    console.log('switch flicked');
  }
}
