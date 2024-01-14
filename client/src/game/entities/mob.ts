/**
 * -------Mob ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import { createCharacterAnims } from "../entities/anim";

export default class Mob {
    jigs: any;
    colliderMap: any;
    data: any;
    sprite: any;
    anims: any;

    constructor(scene, x, y, sprite, name) {
       scene.add.sprite(0, 0, 'mob' + sprite);
   /*      .setTexture('mob' + sprite)
        .setDepth(6)
        .setPosition(parseInt(x), parseInt(y))
        .setInteractive({ cursor: 'url(/assets/images/cursors/attack.cur), pointer' })
        .setScale(.85)
        .on('pointerdown', this.onMobDown.bind(this, name)); */
       // this.loadMob(sprite);
    }

    onMobDown(name) {
        this.jigs.mobClick = name;
        this.jigs.mobShoot = name;
        // this.jigs.playerStats.credits++;
        if (this.jigs.debug) {
            console.log('mob clicked: ' + name);
        }
    }

    loadMob(sprite) {
        console.log('mob added' + sprite);
    }

}

