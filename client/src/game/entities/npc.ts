/**
 * -------Layers ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import { createCharacterAnims } from "../entities/anim";
import axios from "axios";

export default class Npc extends Phaser.Physics.Arcade.Sprite {
    jigs: any;
    colliderMap: any;
    data: any;
    sprite: any;
    thing: any;
    anims: any;

    constructor(scene, data) {

        console.log('data:' + data);
        super(scene, 0, 0, 'npc' + data[3]);
        // this.setTexture('npc' + data[3]);
        this.scene = scene;
        this.setDepth(5)
        this.setScale(.85);
        this.anims.play('walkDown_npc' + data[3]);
        //  this.loadNPC();
        this.on('pointerdown', this.onNPCDown.bind(scene, this));

        /*         self.SceneNpcArray[i] = self.add.sprite(0, 0, 'npc' + this.jigs.npcArray[i][3])
                  .setScale(.85)
                  .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
                  .setData("levelindex", this.jigs.npcArray[i][1])
                  .on('pointerdown', self.onNPCDown.bind(this, this.jigs.npcArray[i])); */

        this.loadNPC();
    }

    onNPCDown(npc, img) {
        if (npc[5] == 1) {
            axios
                .get("/mymission?_wrapper_format=drupal_ajax&npc=" + npc[6])
                .then((response) => {
                    console.log("");
                    this.scene.hydrateMission(response);
                    this.events.emit('Mission', npc);
                    //   this.game.scene.start("main", 'myScene');
                })
        }
        else {
            console.log("" + npc[5]);
            this.jigs.npc = 1;
            this.jigs.content = npc[4];
            this.events.emit('content');
        }
    }

    loadNPC() {
        console.log('sprite added');
    }
}

