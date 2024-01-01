/**
 * -------Reward ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import { createCharacterAnims } from "../entities/anim";

export default class Reward extends Phaser.Physics.Arcade.Sprite {
    jigs: any;
    colliderMap: any;
    data: any;
    sprite: any;
    thing: any;
    ref: any;

    constructor(scene, data) {
        super(scene, 100, 100,'reward');
        this.ref = data.ref;
        this.jigs = useJigsStore();
        const entity = scene.physics.add.sprite(parseInt(data.x), parseInt(data.y) , 'reward' ).setDepth(5);
        entity.setScale(.75);
        this.setTexture('reward');
        this.setDepth(5)
        this.setInteractive({ cursor: 'url(/assets/images/cursors/point.cur), pointer' })
        this.setPosition(parseInt(data.x), parseInt(data.y));
        this.loadReward(this.ref);
    }
    loadReward(arg) {
        console.log('reward added:' + arg);
    }
}

