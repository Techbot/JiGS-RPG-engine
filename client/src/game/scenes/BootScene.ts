import { Scene } from 'phaser'
/* import thudMp3 from '../assets/thud.mp3'
import thudOgg from '../assets/thud.ogg'
 */
export class BootScene extends Scene {
  constructor () {
    super({ key: 'BootScene' })
  }

  preload () {
   // this.load.image('bomb', '/assets/images/bomb.png');
   // this.load.image('sky', '/assets/images/sky.png');
  /*   this.load.audio('thud', [thudMp3, thudOgg]) */
  }

  create () {
    this.scene.start("selector","HudScene");
  }
}
