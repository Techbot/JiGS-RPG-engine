import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import axios from "axios";
export class CutScene extends Phaser.Scene {

  jigs:any;

  constructor() {
    super({ key: "CutScene" });
    this.jigs = useJigsStore();
/*     axios
      .get("/cutscene?_wrapper_format=drupal_ajax")
      .then((response) => {
        this.hydrateCutscene(response);
        this.events.emit('Cutscene', response);
             }) */
  }

  preload() {
  //  this.load.text('data', 'assets/test.txt');
  }

  create() {
    console.log('blob');


    this.jigs.foliosArray.forEach(element => {
      if (element.id == this.jigs.folioClicked){
        const data = element.nodeBody;
        this.addDom(data);
        console.log(data);
      }
    });

  }

  onCutsceneDown(){
    this.game.scene.switch("CutScene", "main");
  }

  hydrateCutscene(response){

  }


texty(data){

  this.add.text(200, 100, data, { fontFamily: 'Georgia, "Goudy Bookletter 1911", Times, serif' })
    .setWordWrapWidth(600)
    .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
    .on('pointerdown', this.onCutsceneDown.bind(this));
}

  addDom(data) {
    this.add.dom(450, 280, 'div', ' width: 820px; height: 300px; font: 14px Arial', data)
      .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
      .on('pointerdown', this.onCutsceneDown.bind(this));
  }

}
