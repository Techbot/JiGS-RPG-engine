////////////////////////////////////////////////////////////////////////////////
//
//
//
////////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');

export class switchCollider {

  do(room, bodyA, bodyB) {
    if (bodyA.isSwitch) {
      console.log('switch ');
      if (!bodyA.done) {
        const promise1 = Promise.resolve(playerModel.updatePlayerSwitch(bodyB.profileId));
        promise1
          .then(() => { bodyB.portal = bodyA.tiled; })
          .then(() => {
            //        console.log(bodyA.destination_x);
            playerModel.updatePlayerStats(bodyB.profileId, 'x', bodyA.destination_x, 1)
          })
          .then(() => {
            //         console.log(bodyA.destination_y);
            playerModel.updatePlayerStats(bodyB.profileId, 'y', bodyA.destination_y, 1)
          });
        bodyA.done = true;
      }
    }
  }
}
