import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
export default class Switch extends Phaser.Physics.Arcade.Sprite {
  jigs: any;

  constructor(scene, x, y,id, startFrame) {
    super(scene, x, y,null);
    //this.jigs = useJigsStore();
    scene.add.sprite(0, 0);
    this.setTexture('switch_' + id);
    this.play('switchAnim_' + id + "On");
    this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' });
    this.on('pointerdown', this.onSwitchDown.bind(this, id));
    console.log("id:" + id + "   startFrame:" + startFrame);

    this.setDepth(6);
  }

  onSwitchDown(id) {
    console.log('switchAnim_' + id);
    this.play('switchAnim_' + id + "Off");
    console.log('switch flicked');
    this.disableInteractive();
  }
}
