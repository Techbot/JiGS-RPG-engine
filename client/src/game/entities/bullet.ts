/**
 * -------Bullet Class ---------
 */

import Phaser from "phaser";

export default class Bullet extends Phaser.Physics.Arcade.Image {
    speed: number;
    lifespan: any;

    constructor(scene) {
        super(scene, 0, 0,"bullet");
        Phaser.Physics.Arcade.Image.call(this, scene, 0, 0, "bullet");
        scene.physics.add.overlap(scene.Mobs.MobContainerArray, this, this.killBullet, null, this);
        this.speed = 400;
    }

    fire(gun) {
        this.lifespan = 3000;
        this.setActive(true);
        this.setVisible(true);
        this.setDepth(7);
        this.setRotation(gun.rotation); // angle is in degree, rotation is in radian
        //self.physics.add.overlap(self.MobContainerArray, self.bullets, this.killBullet, null, self);
        var offset = new Phaser.Geom.Point(0, 0);
        Phaser.Math.Rotate(offset, gun.rotation); // you can only rotate with radian
        this.setPosition(gun.x + offset.x, gun.y + offset.y);
         this.body.reset(gun.x + offset.y, gun.y + offset.y);

        // var angle = Phaser.Math.DegToRad(gun.body.rotation);
        this.body.world.scene.physics.velocityFromRotation(gun.rotation, this.speed, this.body.velocity);
        this.body.velocity.x *= 2;
        this.body.velocity.y *= 2;
    }

    killBullet(mob, bullet) {

        if (bullet.bodyType = "Bul") {
            console.log('kill Bullets');
            bullet.destroy();
        }
    }

    update(time, delta) {
        this.lifespan -= delta;

        if (this.lifespan <= 0) {
            this.setActive(false);
            this.setVisible(false);
            this.body.stop();
        }

    }
}
