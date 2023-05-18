/**
 * -------Layers ---------
 */
import Phaser from "phaser";
import { useCounterStore } from '../../stores/counter';
import { createCharacterAnims } from "../entities/anim";

export default class Reward extends Phaser.Physics.Arcade.Sprite {
    counter: any;
    colliderMap: any;
    data: any;
    sprite: any;
    thing: any;
    ref: any;

    constructor(scene, data) {
        super(scene, 100, 100);
        this.ref = data.ref;
        this.counter = useCounterStore();
        //const entity = scene.physics.add.sprite(parseInt(data.x), parseInt(data.y) , 'reward' ).setDepth(5);
        //entity.setScale(.75);
        this.setTexture('reward');
        this.setDepth(5)
        this.setPosition(parseInt(data.x), parseInt(data.y));
        this.loadReward(this.ref);
    }
    loadReward(arg) {
        console.log('reward added:' + arg);
    }
}

