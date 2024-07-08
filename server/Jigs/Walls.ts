///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var roomModel = require('../models/room.ts');
var p2 = require('p2');

export class Wall {

 async load(world, nodeNumber: number, share) {
   roomModel.getWalls(nodeNumber).then((result: any) => {
    for (let i = 0; i < result.length; i++) {
      world.addBody(this.make(result[i], share));
    }
  }).catch(function (e) {
    console.log('Wall shit:' + e);
  });
}

  make(wall: any, share: any) {
     console.log('placeWall');
    const Shape = new p2.Box({ width: wall.field_width_value, height: wall.field_height_value });
    Shape.collisionGroup = share.COL_GROUND;
    Shape.collisionMask = share.COL_PLAYER | share.COL_ENEMY;
    // Create a typical dynamic body
    const Body = new p2.Body({
      mass: 1,
      position: [wall.field_x_value, wall.field_y_value],
      angle: 0,
      type: p2.Body.STATIC,
      collisionResponse: true,
      velocity: [0, 0],
      angularVelocity: 0
    });

    Body.isWall = true;
    Body.sensor = true;

    // Add a circular shape to the body
    Body.addShape(Shape);
    //this.circleBody.onBeginContact.add(this.checkHits(), this);
    // Add the body to the world
    return Body
  }
}
