////////////////////////////////////////////////////////////////////////////////
//
//
//
////////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');

export class wallCollider {

  do(room, bodyA, bodyB) {
    if (bodyA.isMob) {
      console.log('Body A mob');
      if (bodyB.isWall) {
        console.log('Body B Wall');
        return;
      }
    }
  }
}
