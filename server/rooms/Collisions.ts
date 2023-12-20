////////////////////////////////////////////////////////////////////////////////
//
//
//
////////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');
import { Mob } from "./Mobs";
export class Collision {
  add(self) {
    console.log('yo');
    self.world.on('impact', (evt: any) => {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      ///////////////////////    PORTAL      ///////////////////////////////////
      if (bodyA.isPortal) {
        console.log('portal ');
        if (!bodyA.done) {
          const promise1 = Promise.resolve(playerModel.updateMap(bodyB.profileId, bodyA.destination));
          promise1
            .then(() => { bodyB.portal = bodyA.tiled; })
            .then(() => {
              //        console.log(bodyA.destination_x);
              playerModel.updatePlayer(bodyB.profileId, 'x', bodyA.destination_x, 1)
            })
            .then(() => {
              //         console.log(bodyA.destination_y);
              playerModel.updatePlayer(bodyB.profileId, 'y', bodyA.destination_y, 1)
            });
          bodyA.done = true;
        }
      }

      ///////////////////////    SWITCH      ///////////////////////////////////
      if (bodyA.isSwitch) {
        console.log('switch ');
        if (!bodyA.done) {
          const promise1 = Promise.resolve(playerModel.updatePlayer(bodyB.profileId));
          promise1
            .then(() => { bodyB.portal = bodyA.tiled; })
            .then(() => {
              //        console.log(bodyA.destination_x);
              playerModel.updatePlayer(bodyB.profileId, 'x', bodyA.destination_x, 1)
            })
            .then(() => {
              //         console.log(bodyA.destination_y);
              playerModel.updatePlayer(bodyB.profileId, 'y', bodyA.destination_y, 1)
            });
          bodyA.done = true;
        }
      }
      ///////////////////////    WALL      ///////////////////////////////////
      if (bodyA.isMob) {
        console.log('Body A mob');
        if (bodyB.isWall) {
          console.log('Body B Wall');
          return;
        }
      }

      ////////////////////////// REWARD      ///////////////////////////////////
      if (bodyA.isReward) {
        if (!bodyA.done) {
          const promise1 = Promise.resolve(playerModel.updatePlayer(bodyB.profileId, 'credits', 1, 0));
          promise1.then(() => { });
          const promise2 = Promise.resolve(playerModel.updatePlayer(bodyB.profileId, 'xp', 1, 0));
          promise2.then(() => { });
          self.broadcast("remove-reward", bodyA.ref);
          bodyB.reward = bodyA.ref;
          bodyA.done = true;
        }
      }
      ////////////////////////////  MOB      ///////////////////////////////////
      if (bodyA.isMob && !bodyA.dead) {
        //  if (!bodyA.done) {
        //      console.log('Mobstrike!!!!');
        //     console.log('playerId: ' + bodyB.playerId);
        //      console.log('health: ' + bodyB.health);
        bodyB.struck = true;
        const promise1 = Promise.resolve(playerModel.updatePlayer(bodyB.profileId, 'health', -10, false));
        promise1.then(() => {
          bodyB.health = bodyB.health - 10;

          if (bodyB.health <= 0) {
            //bodyB.health = 0;
            const promise1 = Promise.resolve(playerModel.updatePlayer(bodyB.profileId, 'health', 80, true));
            self.broadcast("dead", bodyB.profileId);
          }
        });
        //When zombie is dead set dead health  and following
        Mob.updateZombieState(self,
          bodyA.field_mobs_target_id,
          bodyA.field_mob_name_value,
          parseInt(bodyA.position[0]),
          parseInt(bodyA.position[1]),
          0, 0, 1, undefined, undefined);
        self.broadcast("player hit", bodyA.field_mob_name_value); // TODO change to player name
        bodyB.mobHit = bodyA.mob_name;
        //bodyA.done = true;
        //     }
      }
    })
    ////////////////////////////////////////////////////////////////////////////
    self.world.on('beginContact', function (evt: any) {
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
    self.world.on("endcontact", function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      console.log('-----------End Contact--- Pay Attention---');
    });
  }
}
