/**
 * -------NPC ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import { createCharacterAnims } from "../entities/anim";
import axios from "axios";
import Hydrater from '../../utils/Hydrater';
import { useMissionStore } from '../../stores/missions';

export default class Npc extends Phaser.Physics.Arcade.Sprite {
    jigs: any;
    hydrater: Hydrater;

    constructor(scene, data) {
        super(scene, 0, 0, null);
        scene.add.sprite(0, 0);
        this.setTexture('npc' + data[3], 30);
        this.setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
        //this.play('walkDown_npc' + data[3]);
        this.setScale(.85);
        this.on('pointerdown', this.onNPCDown.bind(scene, data, scene));
        this.setDepth(5)
        this.loadNPC();
        this.hydrater = new Hydrater;
    }

    onNPCDown(npc, scene) {
        console.log("who" + npc);
        if (npc[5] == 1) {
            axios
                .get("/mymission?_wrapper_format=drupal_ajax&npc=" + npc[6])
                .then((response) => {
                    console.log("why ");
                    if (response.data[0].value.liveMission) {
                        this.jigs.content = response.data[0].value.playerMission;
                        scene.events.emit('content');
                    } else {
                        this.hydrater.hydrateMission(response);
                        scene.events.emit('Mission', npc);
                    }
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
