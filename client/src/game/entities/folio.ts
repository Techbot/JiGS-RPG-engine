import Phaser from "phaser";
//import { Scene } from 'phaser'
import { useJigsStore } from '../../stores/jigs';

export default class Folio extends Phaser.Physics.Arcade.Sprite {
  jigs: any;
  mainScene:any;

  constructor(mainScene, x, y) {

    super(mainScene, x, y, 'book');
    this.jigs = useJigsStore();
    this.mainScene = mainScene;
    const stuff = 0;
    // this.pathIndex = 0;
    this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' });
    this.on('pointerdown', this.onFolioDown.bind(this, this.mainScene));
    this.setDepth(6);
  }

  onFolioDown(thing) {
    console.log('Book read');
  //  this.scene.scene.start("CutScene");
    thing.scene.switch("CutScene","HudScene");
  //  this.scene.scene.start("CutScene");
  }
}
