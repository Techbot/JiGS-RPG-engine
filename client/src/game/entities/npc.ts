/**
 * -------Layers ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import { createCharacterAnims } from "../entities/anim";
import axios from "axios";

export default class Npc extends Phaser.Physics.Arcade.Sprite {
    jigs: any;

    constructor(scene, data) {
        console.log('data:' + data[3]);
        super(scene, 0, 0, 'npc' + data[3]);
        this.setTexture('npc' + data[3]);
        this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
        this.setDepth(5)
        this.setScale(.85);
        this.play('walkDown_npc' + data[3]);
        this.on('pointerdown', this.onNPCDown.bind(scene, data, scene));
        this.loadNPC();
    }

    onNPCDown(npc, scene) {
        console.log("who" + npc);
        if (npc[5] == 1) {
            axios
                .get("/mymission?_wrapper_format=drupal_ajax&npc=" + npc[6])
                .then((response) => {
                    console.log("why");
                    scene.hydrateMission(response);
                    scene.events.emit('Mission', npc);
                })
        }
        else {
            console.log("what" + npc[5]);
            this.jigs.npc = 1;
            this.jigs.content = npc[4];
            scene.events.emit('content');
        }
    }

    loadNPC() {
        console.log('NPC added');
    }
}
