////////////////////////////////////////////////////////////////////////////////
//
//
//
////////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');
import { portalCollider } from "../colliders/portalCollider";
import { switchCollider } from "../colliders/switchCollider";
import { wallCollider } from "../colliders/wallCollider";
import { rewardCollider } from "../colliders/rewardCollider";
import { mobCollider } from "../colliders/mobCollider";

export class Collision {

  portalCollider: portalCollider;
  switchCollider: switchCollider;
  wallCollider: wallCollider;
  rewardCollider: rewardCollider;
  mobCollider: mobCollider;

  constructor() {
    this.portalCollider = new portalCollider();
    this.switchCollider = new switchCollider();
    this.wallCollider = new wallCollider();
    this.rewardCollider = new rewardCollider();
    this.mobCollider = new mobCollider();
  }

  add(room) {
    console.log('yo');
    room.world.on('impact', (evt: any) => {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;

      this.portalCollider.do(room, bodyA, bodyB);
      this.switchCollider.do(room, bodyA, bodyB);
      this.wallCollider.do(room, bodyA, bodyB);
      this.rewardCollider.do(room,bodyA, bodyB);
      this.mobCollider.do(room, bodyA, bodyB);
    })
    ////////////////////////////////////////////////////////////////////////////
    room.world.on('beginContact', function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      //  console.log('Begin Contact');
      if (bodyA.isPlayer) {
        /*        console.log('endContact! --------------------------------------------------------------');
                  console.log('BODY A is the player!', bodyA.isPlayer, bodyA.id);
                  console.log('BODY B is the wall!', bodyB.isWall, bodyB.id,  bodyB.position); */
        //  console.log('BODY B TILE / TILEINDEX: ', bodyB.tile, bodyB.tileIndex);
        bodyA.collide = true;
        //    bodyA.velocity = [0, 0];
      } else {
        /*   console.log('endContact! --------------------------------------------------------------');
          console.log('BODY A is the wall!', bodyA.isWall, bodyA.id, bodyA.position);
          console.log('BODY B is the player!', bodyB.isPlayer, bodyB.id); */
        //  console.log('BODY A TILE / TILEINDEX: ', bodyA.tile, bodyA.tileIndex);
        bodyB.collide = true;
        //  bodyB.velocity = [0, 0];
      }
      //  console.log('----- .');
    });
    room.world.on("endcontact", function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      console.log('-----------End Contact--- Pay Attention---');
    });
  }
}
