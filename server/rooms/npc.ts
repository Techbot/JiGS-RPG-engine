///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
var Bridge = require('../services/bridge.ts');
var p2 = require('p2');

  export  function placeNpc( npc: any, share: any) {
   // console.log('place');
    const circleShape = new p2.Circle({ radius: 10 });
    circleShape.collisionGroup = share.COL_ENEMY;
    circleShape.collisionMask = share.COL_PLAYER;
    // Create a typical dynamic body
    const circleBody = new p2.Body({
      mass: 1,
      position: [npc.field_x_value, npc.field_y_value],
      angle: 0,
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      velocity: [0, 0],
      angularVelocity: 0
    });

   // console.log(' position:', circleBody.position);
    circleBody.isNPC = true;
    circleBody.sensor = true;
    circleBody.motionState = 2; //STATIC
    // Add a circular shape to the body
    circleBody.addShape(circleShape);
    //this.circleBody.onBeginContact.add(this.checkHits(), this);
    // Add the body to the world
    return circleBody
  }

  export async function load(world,nodeNumber: number) {
  Bridge.getNpcs(nodeNumber).then((result: any) => {
    this.state.NpcResult = result;
    return result;
  }).then((newResult: any) => {
    for (let i = 0; i < newResult.length; i++) {
      world.addBody(this.placeNpc(newResult[i], this.share));
    }
  }).catch(function () {
    console.log('NPC shit');
  });
}
