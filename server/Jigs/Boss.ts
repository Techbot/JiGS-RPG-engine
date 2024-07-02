///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
import { BossState } from "./GameState";
var p2 = require('p2');
var p2 = require('p2');

enum Direction {
  UP,
  DOWN,
  LEFT,
  RIGHT
}


export class Boss {

  private direction = Direction.RIGHT
  pause: number;
  body: any;

  constructor(boss: any, share: any) {
    console.log('place boss ' + boss.entity_id + ' @ ' + boss.x + ' X and ' + boss.y + ' Y');
    const circleShape = new p2.Circle({ radius: 10 });
    circleShape.collisionGroup = share.COL_ENEMY;
    circleShape.collisionMask = share.COL_PLAYER;
    // Create a typical dynamic body
    this.body = new p2.Body({
      mass: 1,
      position: [boss.x, boss.y],
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      velocity: [0, 0],
      angularVelocity: 0
    });
    // console.log(' position:', circleBody.position);
    this.body.isBoss = true;
    this.body.title = boss.title;
    this.body.sensor = true;
    this.body.motionState = 2; //STATIC
    // Add a circular shape to the body
    this.body.addShape(circleShape);
    //this.circleBody.onBeginContact.add(this.checkHits(), this);
    // Add the body to the world
    this.body.destinationX = 0;
    this.body.destinationY = 0;
    //return this.body;
    this.body.something = (speed) => {

      switch (this.body.direction) {
        case Direction.UP:
          console.log("body" + this.body.title + "Up")
          this.body.velocity[0] = 0;
          this.body.velocity[1] = -speed
          break

        case Direction.DOWN:

          console.log("body" + this.body.title + "DOWN")
          this.body.velocity[0] = 0;
          this.body.velocity[1] = speed
          break

        case Direction.LEFT:

          console.log("body" + this.body.title + "LEFT")
          this.body.velocity[0] = -speed;
          this.body.velocity[1] = 0

          break

        case Direction.RIGHT:

          console.log("body" + this.body.title + "RIGHT")
          this.body.velocity[0] = speed;
          this.body.velocity[1] = 0;
          break
      }

      this.body.updateBossForce = async () => {

        if (this.pause == 0) {
          this.pause = 1
          const x = await this.body.skip(4000);
          //   console.log('--------------------------- ' + x)
          this.direction = this.body.randomDirection(this.direction)
          this.body.something(25)

        }
      }
      this.body.skip = (val) => {
        return new Promise((resolve) => {
          setTimeout(() => {
            this.pause = 0;
            console.log('-------------------------');
            resolve(val);
          }, val);
        });
      }



    }
    return this.body;
  }
}
