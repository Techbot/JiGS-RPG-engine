/**
 * ------- Mob ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';


export default class Mob extends Phaser.Physics.Arcade.Sprite {
    jigs: any;

    constructor(scene, x, y, sprite, name) {
        super(scene, x, y, null);
        scene.add.sprite(x, y);
        this.jigs = useJigsStore();
        this.setTexture('mob' + sprite)
        this.play('walkDown_mob' + sprite);
        this.setInteractive({ cursor: 'url(/assets/images/cursors/attack.cur), pointer' })
        this.setScale(.85)
        this.on('pointerdown', this.onMobDown.bind(this, name));
        this.loadMob(sprite);
        this.setDepth(6);
    }

    onMobDown(name) {
        this.jigs.mobClick = name;
        this.jigs.mobShoot = name;
        this.jigs.playerStats.credits++;
        if (this.jigs.debug) {
            console.log('mob clicked: ' + name);
        }
    }

    loadMob(sprite) {
        console.log('mob added' + sprite);
    }
}
