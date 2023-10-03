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
    this.load.spritesheet('PsibotF', '/assets/images/sprites/avatars/1000.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('PsibotF_slash', '/assets/images/sprites/avatars/1000.png', { frameWidth: 192, frameHeight: 192 });
    this.load.spritesheet('PsibotM', '/assets/images/sprites/avatars/4351.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('PsibotM_slash', '/assets/images/sprites/avatars/4351.png', { frameWidth: 192, frameHeight: 192 });

    this.load.spritesheet('otherPlayer', '/assets/images/sprites/avatars/47054.png', { frameWidth: 64, frameHeight: 64 });
/*     this.load.image('sky', '/assets/images/sky.png');
    this.load.image('ship', '/assets/images/spaceShips_001.png'); */
    this.load.image('star', '/assets/images/star_gold.png');
    this.load.image('gun', "/assets/images/gun.png");
    this.load.image('bullet', "/assets/images/star_gold.png");
    this.load.image('healthBar', "/assets/images/health_bar.png");
    this.load.image('portal00001', '/assets/images/enemyBlack5.png');
    this.load.image('portal00002', '/assets/images/enemyBlack5.png');
    this.load.image('portal00003', '/assets/images/enemyBlack5.png');
    this.load.image('reward', '/assets/images/various-32-greyout_69.png');
  }

  create () {
    this.scene.start("selector",'HudScene');
  }
}
