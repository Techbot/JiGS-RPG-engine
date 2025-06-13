////////////////////////////////////////////////////////////////////////////////
//
//
//
////////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');

export class switchCollider {

  do(room: any, bodyA: any, bodyB: any) {
    if (bodyA.isSwitch) {
      console.log('switch ');
      if (!bodyA.done) {
        const promise1 = Promise.resolve(playerModel.updatePlayerSwitch(bodyB.profileUuid));
        promise1
          .then(() => { bodyB.portal = bodyA.tiled; })
          .then(() => {
            //        console.log(bodyA.destination_x);
            playerModel.updatePlayerStats(bodyB.profileUuid, 'x', bodyA.destination_x, 1)
          })
          .then(() => {
            //         console.log(bodyA.destination_y);
            playerModel.updatePlayerStats(bodyB.profileUuid, 'y', bodyA.destination_y, 1)
          });
        bodyA.done = true;
      }
    }
  }
}
