/**
 * -------Layers ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import { createCharacterAnims } from "../entities/anim";

export default class Mob extends Phaser.Physics.Arcade.Sprite {
    jigs: any;
    colliderMap: any;
    data: any;
    sprite: any;
    thing: any;
    anims: any;

    constructor(scene, data) {
        console.log('data:' + data);
        super(scene, 100, 100,null);
        //const entity = scene.physics.add.sprite(parseInt(data[1]), parseInt(data[2]), 'npc' + data[3]).setDepth(5);
        this.setTexture('mob' + data[3]);
        this.setDepth(5)
        this.setPosition(parseInt(data[1]), parseInt(data[2]));
        this.setScale(.75);
        this.anims.play('hurt_mob' + data[3]);
      //  this.loadNPC();
        //entity.setScale(.75);
        //entity.anims.play('stop_npc' + data[3] );
      //  this.loadNPC();
    }

    loadNPC() {
        console.log('sprite added');
    }
}

