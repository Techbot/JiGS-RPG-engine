import { Scene } from 'phaser'
import WebFont from '../../assets/WebFont'
const ASSETS_URL = import.meta.env.VITE_ASSETS_URL;

export class BootScene extends Scene {
  constructor () {
    super({ key: 'BootScene', active: true })
  }

  preload () {
    this.load.audio('walk', ['/assets/audio/thud.ogg', ASSETS_URL + '/assets/audio/thud.mp3']);
    this.load.image('nextPage', ASSETS_URL + '/assets/images/gui/arrow-down-left.png');

    this.load.spritesheet('otherPlayer', ASSETS_URL + '/assets/images/sprites/avatars/4351.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-spell-default', ASSETS_URL + '/assets/images/animator/Psibot-Male/spell-default.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-walk-glowsword', ASSETS_URL + '/assets/images/animator/Psibot-Male/walk-glowsword.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-slash-oversize-glowsword', ASSETS_URL + '/assets/images/animator/Psibot-Male/slash-oversize-glowsword.png', { frameWidth: 192, frameHeight: 192 });
    this.load.spritesheet('player-hurt-glowsword', ASSETS_URL + '/assets/images/animator/Psibot-Male/hurt-glowsword.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-walk-axe', ASSETS_URL + '/assets/images/animator/Psibot-Male/walk-axe.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-slash-oversize-axe', ASSETS_URL + '/assets/images/animator/Psibot-Male/slash-oversize-axe.png', { frameWidth: 192, frameHeight: 192 });
    this.load.spritesheet('player-hurt-axe', ASSETS_URL + '/assets/images/animator/Psibot-Male/hurt-axe.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-hurt-rapier', ASSETS_URL + '/assets/images/animator/Psibot-Male/hurt-rapier.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-walk-rapier', ASSETS_URL + '/assets/images/animator/Psibot-Male/walk-rapier.png', { frameWidth: 64, frameHeight: 64 });
    this.load.spritesheet('player-slash-oversize-rapier', ASSETS_URL + '/assets/images/animator/Psibot-Male/slash-oversize-rapier.png', { frameWidth: 192, frameHeight: 192 });

    this.load.image('exit', ASSETS_URL + '/assets/images/System/Exit.png');
    this.load.image('book', ASSETS_URL + '/assets/images/book.png');
    this.load.image('star', ASSETS_URL + '/assets/images/star_gold.png');
    this.load.image('gun', ASSETS_URL + '/assets/images/gun.png');
    this.load.image('bullet', ASSETS_URL + '/assets/images/star_gold.png');
    this.load.image('healthBar', ASSETS_URL + '/assets/images/health_bar.png');
    this.load.image('reward', ASSETS_URL + '/assets/images/various-32-greyout_69.png');
    this.load.image('nextPage', ASSETS_URL + '/assets/images/gui/arrow-down-left.png');
    this.load.addFile(new WebFont(this.load, ['Roboto', 'Neutron Demo']))
    this.load.image('cursor', ASSETS_URL + '/assets/images/cursors/blank.cur');
    this.load.image('cursor2', ASSETS_URL + '/assets/images/cursors/attack.cur');
    this.load.image('cursor3', ASSETS_URL + '/assets/images/cursors/speak.cur');
    this.load.image('cursor4', ASSETS_URL + '/assets/images/cursors/blank.cur');
    this.load.image('cursor4', ASSETS_URL + '/assets/images/cursors/point.cur');

    this.load.image('icon01', ASSETS_URL + '/assets/images/gui/I_Book.png');
    this.load.image('icon02', ASSETS_URL + '/assets/images/gui/I_GoldCoin.png');
    this.load.image('icon03', ASSETS_URL + '/assets/images/gui/I_Scroll.png');
    this.load.image('icon04', ASSETS_URL + '/assets/images/gui/P_Yellow01.png');
  }

  create () {

    this.scene.start('SceneSelector');

  }
}
