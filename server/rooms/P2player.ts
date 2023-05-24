///////////////////////////////////////////////////////////////////////////////
//
// 
//
//////////////////////////////////////////////////////////////////////////////

var p2 = require('p2');

export function placePlayer(share: any, player: any) {

    const playerShape = new p2.Box({ width: 32, height: 32 });
    playerShape.collisionGroup = share.COL_PLAYER;
    playerShape.collisionMask = share.COL_ENEMY | share.COL_GROUND;

    const playerBody = new p2.Body({
      mass: 1,
      position: [player.x, player.y],
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      fixedRotation: true
    });
   playerBody.isPlayer = true;
   playerBody.motionState = 2; //STATIC
   playerBody.collideWorldBounds = true;
   playerBody.addShape(playerShape);

    return playerBody;
  }


