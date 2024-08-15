////////////////////////////////////////////////////////////////////////////////
//
//
//
////////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');

export class mobCollider {

  do(room, bodyA, bodyB) {

    if (bodyA.isMob && bodyB.isWall) {
      return;
    }

    if (bodyA.isMob && !bodyA.dead) {
      //  if (!bodyA.done) {
      //      console.log('Mobstrike!!!!');
      //     console.log('playerId: ' + bodyB.playerId);
      //      console.log('health: ' + bodyB.health);
      bodyB.struck = true;
      const promise1 = Promise.resolve(playerModel.updatePlayerStats(bodyB.profileId, 'health', -10, false));
      promise1.then(() => {
        bodyB.health = bodyB.health - 10;

        if (bodyB.health <= 0) {
          //bodyB.health = 0;
          const promise1 = Promise.resolve(playerModel.updatePlayerStats(bodyB.profileId, 'health', 80, true));
          room.broadcast("dead", bodyB.profileId);
        }
      });
      //When zombie is dead set dead health  and following
      /*       Mob.updateZombieState(self,
              bodyA.field_mobs_target_id,
              bodyA.field_mob_name_value,
              parseInt(bodyA.position[0]),
              parseInt(bodyA.position[1]),
              0, 0, 1, undefined, undefined); */
      room.broadcast("player hit", bodyA.field_mob_name_value); // TODO change to player name
      bodyB.mobHit = bodyA.mob_name;
      //bodyA.done = true;
      //     }
    }



  }
}
