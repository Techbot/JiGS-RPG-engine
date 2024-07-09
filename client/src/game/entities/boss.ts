/**
 * ------- Boss ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';

export default class Boss extends Phaser.Physics.Arcade.Sprite {
    jigs: any;
    previousDirection: string;

    constructor(scene, x, y, id, name) {
        super(scene, x, y, null);
        scene.add.sprite(x, y);
        //scene.children.add(this).play(name + '-walkRight', true);
        this.jigs = useJigsStore();
        this.setTexture('boss_' + name)
     //   this.play('walkDown_boss' + sprite);
        this.setInteractive({ cursor: 'url(/assets/images/cursors/attack.cur), pointer' })
        this.setScale(.85)
        this.on('pointerdown', this.onBossDown.bind(this, name));
        this.loadBoss(name);
        this.setDepth(6);
    }

    updateAnim(direction: string | undefined, name: string) {
        if (direction == undefined || direction == this.previousDirection) {
            return;
        }
        console.log('***************************** update anim ' + direction)
        this.anims.play(name + '-walk' + direction);
        this.previousDirection = direction;
    }

    onBossDown(name) {
        this.jigs.bossClick = name;
        this.jigs.bossShoot = name;
        this.jigs.playerStats.credits++;
        if (this.jigs.debug) {
            console.log('boss clicked: ' + name);
        }
    }

    loadBoss(name) {
        console.log('boss added ' + name);
    }
}
