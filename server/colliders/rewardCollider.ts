////////////////////////////////////////////////////////////////////////////////
//
//
//
////////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');

export class rewardCollider {

  do(room, bodyA, bodyB) {
    if (bodyA.isReward) {
      if (!bodyA.done) {
        const promise1 = Promise.resolve(playerModel.updatePlayerStats(bodyB.profileId, 'credits', 1, 0));
        promise1.then(() => { });
        const promise2 = Promise.resolve(playerModel.updatePlayerStats(bodyB.profileId, 'xp', 1, 0));
        promise2.then(() => { });
        room.broadcast("remove-reward", bodyA.ref);
        bodyB.reward = bodyA.ref;
        bodyA.done = true;
      }
    }
  }
}
