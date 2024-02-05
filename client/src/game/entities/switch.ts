/**
 * -------Switch ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import axios from "axios";
export default class Switch extends Phaser.Physics.Arcade.Sprite {
  jigs: any;

  constructor(scene, x, y,id, startFrame) {
    super(scene, x, y,null);

    scene.add.sprite(0, 0);
    this.setTexture('switch_' + id);
    this.play('switchAnim_' + id + "On");

    this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' });

    this.on('pointerdown', this.onSwitchDown.bind(this, id, scene));
    console.log("id:" + id + "   startFrame:" + startFrame);
    this.setDepth(6);
  }

  onSwitchDown(id,scene) {
    console.log('switchAnim_' + id);
    this.play('switchAnim_' + id + 'Off');
     if (id != 1) {
      axios
        .get("/flickswitch?_wrapper_format=drupal_ajax&id=" + id)
        .then((response) => {
          console.log("why");
          scene.hydrateSwitches(id, response);
          scene.events.emit('Switch', id);
        })
    }
    console.log('switch ' + id + ' flicked');
    this.disableInteractive();
  }
}
