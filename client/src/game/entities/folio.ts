/**
 * ------- Folio ---------
 */
import Phaser from "phaser";
//import { Scene } from 'phaser'
import { useJigsStore } from '../../stores/jigs';

export default class Folio extends Phaser.Physics.Arcade.Sprite {
  jigs: any;
  mainScene:any;

  constructor(mainScene, x, y, id) {

    super(mainScene, x, y, 'book');
    this.jigs = useJigsStore();
    this.mainScene = mainScene;
    const stuff = 0;
    this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' });
    this.on('pointerdown', this.onFolioDown.bind(this, this.mainScene,id));
    this.setDepth(6);
  }

  onFolioDown(thing, id) {
    console.log('Book read');
    this.jigs.folioClicked = id;
    thing.scene.switch("CutScene","HudScene");
  }
}
