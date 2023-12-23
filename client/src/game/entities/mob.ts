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
    anims: any;

    constructor(scene, x,y, sprite) {
        super(scene, 100, 100,null);
        this.setTexture('mob' + sprite);
        this.setDepth(5)
        this.setPosition(parseInt(x), parseInt(y));
        this.setInteractive({ cursor: 'url(/assets/images/cursors/attack.cur), pointer' })
        this.setScale(.85)
        this.on('pointerdown', this.onMobDown.bind(this));
      //  this.loadNPC();

    }

    onMobDown(mob, img) {
        this.jigs.mobClick = mob[1];
        this.jigs.mobShoot = mob[1];
        this.jigs.playerStats.credits++;
    }

    loadMob() {
        console.log('mob added');
    }
}

