////////////////////////////////////////////////////////////////////////////////
//
//
//
////////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');

export class portalCollider {

  do(room, bodyA, bodyB) {
    if (bodyA.isPortal) {
        console.log('portal ');
      if (!bodyA.done) {
        //    const missionAccepted = room.state.missionAccepted;
        //    const player = bodyB.client_id;
        //    const playerFlags = bodyB.flags;

        //    if (playerFlags.includes(missionAccepted)) {
        const promise1 = Promise.resolve(playerModel.updateMap(bodyB.profileId, bodyA.destination));
        promise1
          .then(() => { bodyB.portal = bodyA.tiled; })// defining .portal triggers the jump for the client
          .then(() => {
            //        console.log(bodyA.destination_x);
            playerModel.updatePlayer(bodyB.profileId, 'x', bodyA.destination_x, 1)
          })
          .then(() => {
            //         console.log(bodyA.destination_y);
            playerModel.updatePlayer(bodyB.profileId, 'y', bodyA.destination_y, 1)
          });
        bodyA.done = true;
        //   }
      }
    }
  }
}
