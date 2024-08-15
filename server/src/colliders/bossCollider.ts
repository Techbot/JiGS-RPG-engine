////////////////////////////////////////////////////////////////////////////////
//
//
//
////////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');

export class bossCollider {

  do(room, bodyA, bodyB) {

    if (bodyA.isBoss && bodyB.isWall) {
      return;
    }

    if (bodyA.isBoss && !bodyA.dead) {

      console.log('Boss Strike!!!!');

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

    //  room.broadcast("player hit by boss", bodyA.field_mob_name_value); // TODO change to player name
    //  bodyB.mobHit = bodyA.mob_name;
      bodyA.done = true;
      //     }
    }



  }
}
