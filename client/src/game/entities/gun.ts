/**
 * ------- Gun ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import Bullet from "../entities/bullet";


export default class Gun extends Phaser.Physics.Arcade.Sprite {
  jigs: any;
  angle: any;
  bullets: any;

  constructor(scene, x, y,sprite) {
    super(scene, x, y, sprite)
    this.x = x;
    this.y = y;
    this.jigs = useJigsStore();
    scene.events.on('position', this.handler, this);
  }

  shoot(self,event) {
    this.getAngle(event);

    this.bullets = self.physics.add.group({
      classType: Bullet,
      maxSize: 10,
      runChildUpdate: true,
      bodyType: 'Bul'
    });

    if (this.jigs.mobShoot != 0) {
      let bullet = this.bullets.get();
      if (bullet) {
        let offset = new Phaser.Geom.Point(0, -this.height / 2);
        bullet.fire(this);
        this.jigs.mobShoot = 0;
      }
    }
  }

  getAngle(event) {
    this.angle = Math.atan2(parseInt(event.worldY) - this.y, parseInt(event.worldX) - this.x) * 180 / Math.PI;
  }

  loadGun(sprite) {
    console.log('gun added' + sprite);
  }

  handler(x, y) {
    this.setPosition(x , y);
  }

}
