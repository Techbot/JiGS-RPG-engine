import { Scene } from 'phaser'
import WebFont from '../../assets/WebFont'
export class BootScene extends Scene {
  constructor () {
    super({ key: 'BootScene', active: true })
  }

  preload () {
    this.load.audio('walk', ['/assets/audio/thud.ogg', '/assets/audio/thud.mp3']);
    this.load.image('nextPage', '/assets/images/gui/arrow-down-left.png');

    this.load.spritesheet('otherPlayer', '/assets/images/sprites/avatars/4351.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-spell-default', '/assets/images/animator/Psibot-Male/spell-default.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-walk-glowsword', '/assets/images/animator/Psibot-Male/walk-glowsword.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-slash-oversize-glowsword', '/assets/images/animator/Psibot-Male/slash-oversize-glowsword.png', { frameWidth: 192, frameHeight: 192 });
    this.load.spritesheet('player-hurt-glowsword', '/assets/images/animator/Psibot-Male/hurt-glowsword.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-walk-axe', '/assets/images/animator/Psibot-Male/walk-axe.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-slash-oversize-axe', '/assets/images/animator/Psibot-Male/slash-oversize-axe.png', { frameWidth: 192, frameHeight: 192 });
    this.load.spritesheet('player-hurt-axe', '/assets/images/animator/Psibot-Male/hurt-axe.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-hurt-rapier', '/assets/images/animator/Psibot-Male/hurt-rapier.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-walk-rapier', '/assets/images/animator/Psibot-Male/walk-rapier.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-slash-oversize-rapier', '/assets/images/animator/Psibot-Male/slash-oversize-rapier.png', { frameWidth: 192, frameHeight: 192 });

    this.load.image('exit', '/assets/images/System/Exit.png');
    this.load.image('book', '/assets/images/book.png');
    this.load.image('star', '/assets/images/star_gold.png');
    this.load.image('gun', "/assets/images/gun.png");
    this.load.image('bullet', "/assets/images/star_gold.png");
    this.load.image('healthBar', "/assets/images/health_bar.png");
    this.load.image('reward', '/assets/images/various-32-greyout_69.png');
    this.load.image('nextPage', '/assets/images/gui/arrow-down-left.png');
    this.load.addFile(new WebFont(this.load, ['Roboto', 'Neutron Demo']))
    this.load.image('cursor', '/assets/images/cursors/blank.cur');
    this.load.image('cursor2', '/assets/images/cursors/attack.cur');
    this.load.image('cursor3', '/assets/images/cursors/speak.cur');
    this.load.image('cursor4', '/assets/images/cursors/blank.cur');
    this.load.image('cursor4', '/assets/images/cursors/point.cur');

    this.load.image('icon01', '/assets/images/gui/I_Book.png');
    this.load.image('icon02', '/assets/images/gui/I_GoldCoin.png');
    this.load.image('icon03', '/assets/images/gui/I_Scroll.png');
    this.load.image('icon04', '/assets/images/gui/P_Yellow01.png');
  }

  create () {
    this.scene.start("SceneSelector",'HudScene');
  }
}
