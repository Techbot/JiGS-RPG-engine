///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
var roomModel = require('../models/room.ts');
var p2 = require('p2');

export class Reward {

  async load(world, nodeNumber: number, share) {
    // Render page
    //var self = this;
    roomModel.getRewards(nodeNumber).then((result: any) => {
      //  this.result = result;
      return result;
    }).then((newResult: any) => {
      for (let i = 0; i < newResult.length; i++) {
        world.addBody(this.make(newResult[i], share));
      }
    }).catch(function () {
      console.log('reward shit');
    });
  }

  make(reward: any, share: any) {
    // console.log('place');
    const circleShape = new p2.Circle({ radius: 10 });
    circleShape.collisionGroup = share.COL_ENEMY;
    circleShape.collisionMask = share.COL_PLAYER;
    // Create a typical dynamic body
    const circleBody = new p2.Body({
      mass: 1,
      position: [reward.field_x_value, reward.field_y_value],

      angle: 0,
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      velocity: [0, 0],
      angularVelocity: 0
    });
    circleBody.ref = reward.field_ref_value;
    // console.log(' position:', circleBody.position);
    circleBody.isReward = true;
    circleBody.sensor = true;
    circleBody.motionState = 2; //STATIC
    // Add a circular shape to the body
    circleBody.addShape(circleShape);
    //this.circleBody.onBeginContact.add(this.checkHits(), this);
    // Add the body to the world
    return circleBody
  }
}
