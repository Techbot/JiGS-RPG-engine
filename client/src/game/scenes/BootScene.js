import { Scene } from 'phaser'
import thudMp3 from '@/game/assets/thud.mp3'
import thudOgg from '@/game/assets/thud.ogg'

export default class BootScene extends Scene {
  constructor () {
    super({ key: 'BootScene' })
  }

  preload () {
    this.load.image('bomb', '../../images/bomb.png');
    this.load.image('sky', '../../images/sky.png');
    this.load.audio('thud', [thudMp3, thudOgg])
  }

  create () {
    this.scene.start('PlayScene')
  }
}
