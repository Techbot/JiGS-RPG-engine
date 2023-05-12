/**
 * -------Bullet Class ---------
 */

import Phaser from "phaser";

export default class Bullet extends Phaser.Physics.Arcade.Image {
    constructor(scene) {
        super(scene);
        Phaser.Physics.Arcade.Image.call(this, scene, 0, 0, "bullet");

        this.speed = Phaser.Math.GetSpeed(400, 1);
        this.speed = 200;
    }

    fire(gun) {
        this.lifespan = 2000;
        this.setActive(true);
        this.setVisible(true);
        this.setRotation(gun.rotation); // angle is in degree, rotation is in radian
        var offset = new Phaser.Geom.Point(40, 0);
        Phaser.Math.Rotate(offset, gun.rotation); // you can only rotate with radian
        this.setPosition(gun.x + offset.x, gun.y + offset.y);
        // this.body.reset(gun.x + offset.y, gun.y + offset.y);

        // var angle = Phaser.Math.DegToRad(gun.body.rotation);
        this.body.world.scene.physics.velocityFromRotation(gun.rotation, this.speed, this.body.velocity);
        this.body.velocity.x *= 2;
        this.body.velocity.y *= 2;
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
