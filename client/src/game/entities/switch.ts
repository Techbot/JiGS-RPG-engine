/**
 * -------Switch ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import axios from "axios";
export default class Switch extends Phaser.Physics.Arcade.Sprite {
  jigs: any;

  constructor(scene, x: number, y: number, id, switchState) {

    super(scene, x, y, null);
    this.setDepth(7);
    scene.add.sprite(0, 0);
    this.setTexture(id);
    this.jigs = useJigsStore();

    if (switchState) {
      this.play(id + "On");
    } else {
      this.play(id + "Off");
      this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' });
    }
    this.on('pointerdown', this.onSwitchDown.bind(this, id, scene));
    console.log("id:" + id);
  }

  onSwitchDown(id, scene) {
    console.log('switchAnim_' + id);
    this.play(id + 'On');
    if (id != 1) {
      axios
        .get("/flickswitch?_wrapper_format=drupal_ajax&id=" + id)
        .then((response) => {
          this.jigs.content = response.data[0].value.dialog;

          if (response.data[0].value.missionDialog){
          this.jigs.content += response.data[0].value.missionDialog;
        }
          scene.events.emit('content');
          //this.jigs.switchesArray.push(id);
          scene.events.emit('Switch', id);
        })
    }
    console.log('switch ' + id + ' flicked');
    this.disableInteractive();
  }
}
