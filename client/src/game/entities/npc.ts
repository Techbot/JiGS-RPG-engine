/**
 * -------Layers ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import { createCharacterAnims } from "../entities/anim";

export default class Npc extends Phaser.Physics.Arcade.Sprite {
    jigs: any;
    colliderMap: any;
    data: any;
    sprite: any;
    thing: any;
    anims: any;

    constructor(scene, data) {
        console.log('data:' + data);
        super(scene, 100, 100, 'npc' + data[3]);
        // this.setTexture('npc' + data[3]);
        this.setDepth(5)
        this.setScale(.75);
        this.anims.play('walkDown_npc' + data[3]);
        //  this.loadNPC();
        this.loadNPC();
    }

    loadNPC() {
        console.log('sprite added');
    }
}

