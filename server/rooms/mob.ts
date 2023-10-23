///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
import { ZombieState } from "./GameState";
var Bridge = require('../services/bridge.ts');
var p2 = require('p2');

export function makeMob(mob: any, share: any) {
  // console.log('place');
  const circleShape = new p2.Circle({ radius: 10 });
  circleShape.collisionGroup = share.COL_ENEMY;
  circleShape.collisionMask = share.COL_PLAYER;
  // Create a typical dynamic body
  const circleBody = new p2.Body({
    mass: 20,
    position: [mob.field_x_value, mob.field_y_value],
    angle: 0,
    type: p2.Body.DYNAMIC,
    collisionResponse: true,
    velocity: [0, 0],
    angularVelocity: 0
  });
  circleBody.field_mobs_target_id = mob.field_mobs_target_id;
  circleBody.field_mob_name_value = mob.field_mob_name_value
  circleBody.health = mob.health;

  // console.log(' position:', circleBody.position);
  circleBody.isMob = true;
  circleBody.sensor = true;
  //circleBody.motionState = 2; //STATIC
  // Add a circular shape to the body
  circleBody.addShape(circleShape);
  //this.circleBody.onBeginContact.add(this.checkHits(), this);
  // Add the body to the world
  return circleBody
}

export function updateMob(self) {

  if (self.P2mobBodies.length > 0) {
    // Update destination every 2 seconds for one of the mobs
    if (self.pause == 0) {
      self.pause = 1;
      const myPromise = new Promise((resolve, reject) => {
        resolve(Math.ceil(Math.random() * self.P2mobBodies.length - 1));
      });
      myPromise.then((mobNumber) => {
        self.updateMobForce(mobNumber);
      });
    }
    let i = 0;
    while (i < self.P2mobBodies.length) {
      self.P2mobBodies[i].setZeroForce();
      //    this.P2mobBodies[i].force[0] = this.P2mobBodies[i].destinationX;
      //    this.P2mobBodies[i].force[1] = this.P2mobBodies[i].destinationY;
      ////////////////////////////////////////////////////////////////////////////
      self.state.MobResult.forEach(mobState => {
        if (self.P2mobBodies[i].field_mob_name_value == mobState.field_mob_name_value) {
          //  console.log('follow ' + mob.following);
          //if  not following someone, do the test
          if (mobState.following == 0) {

            if (parseInt(mobState.field_x_value) != parseInt(self.P2mobBodies[i].position[0])
              || parseInt(mobState.field_y_value) != parseInt(self.P2mobBodies[i].position[1])) {
              //if state x,y is out of date
              this.updateZombieState(mobState.field_mobs_target_id, mobState.field_mob_name_value, parseInt(self.P2mobBodies[i].position[0]),
                parseInt(self.P2mobBodies[i].position[1]), 0, undefined, undefined, mobState, i
              )
            }
            self.state.players.forEach(player => {
              //var mobPlayerDist = Math.sqrt(Math.pow((player.x - parseInt(this.P2mobBodies[i].position[0])), 2) + Math.pow((player.y - parseInt(this.P2mobBodies[i].position[0])), 2));
              var mobPlayerDist = Math.hypot(player.x - parseInt(self.P2mobBodies[i].position[0]), player.y - parseInt(self.P2mobBodies[i].position[0]));
              //  console.log('player ' + player.playerId + ' dist: ' + mobPlayerDist + "from " + i);
              if (mobPlayerDist < 800) {
                // this is to update the mobs follower
                this.updateZombieState(
                  mobState.field_mobs_target_id, mobState.field_mob_name_value,
                  parseInt(this.P2mobBodies[i].position[0]), parseInt(this.P2mobBodies[i].position[1]),
                  player.playerId, undefined, undefined, mobState, i
                )
              }
            })
          }
          if (mobState.following > 0) {
            //   console.log('almost following');
            self.state.players.forEach(player => {
              if (player.playerId == mobState.following && mobState.dead != 1) {
                if (mobState.dead == 0) {
                  //        console.log('following');
                  if (parseInt(self.P2mobBodies[i].position[0]) > player.playerBody.position[0]) {
                    self.P2mobBodies[i].force[0] = -130;
                  }
                  else {
                    self.P2mobBodies[i].force[0] = 130;
                  }
                  if (parseInt(self.P2mobBodies[i].position[1]) > player.playerBody.position[1]) {
                    self.P2mobBodies[i].force[1] = -130;
                  }
                  else {
                    self.P2mobBodies[i].force[1] = 130;
                  }
                }
                this.updateZombieState(
                  mobState.field_mobs_target_id, mobState.field_mob_name_value, parseInt(self.P2mobBodies[i].position[0]), parseInt(self.P2mobBodies[i].position[1]),
                  player.playerId, undefined, undefined, mobState, i
                )
              }
            })
          };
          if (mobState.dead > 0) {
            self.P2mobBodies[i].destinationX = 0;
            self.P2mobBodies[i].destinationY = 0;
          }
        }
      });
      ////////////////////////////////////////////////////////////////////////////////
      i++;
    };
  };
}
export function updateZombieState(
  target_id: number | undefined, name: string | undefined, x: number | undefined, y: number | undefined,
  following: number | undefined, health: number | undefined, dead: number | undefined, mobState, i: number | undefined
) {
  const mobItem = new ZombieState();
  if (mobState != undefined) {
    mobItem.field_mobs_target_id = mobState.field_mobs_target_id;
    mobItem.field_mob_name_value = mobState.field_mob_name_value;
    if (i != undefined) {
      mobItem.field_x_value = parseInt(this.P2mobBodies[i].position[0]);
      mobItem.field_y_value = parseInt(this.P2mobBodies[i].position[1]);
    }
    mobItem.following = mobState.following;
    mobItem.health = mobState.health;
    mobItem.dead = mobState.dead;
  }
  if (target_id != undefined) { mobItem.field_mobs_target_id = target_id; }
  if (name != undefined) { mobItem.field_mob_name_value = name; }
  if (x != undefined) { mobItem.field_x_value = x; }
  if (y != undefined) { mobItem.field_y_value = y; }
  if (following != undefined) { mobItem.following = following; }
  if (health != undefined) { mobItem.health = health; }
  if (dead != undefined) { mobItem.dead = dead; }
  this.state.MobResult.set(mobState.field_mob_name_value, mobItem);
}

 export  async function loadMobs(nodeNumber: number,self) {

  //var self = this;
  Bridge.getMobs(nodeNumber).then((result: any) => {
    result.forEach(mobState => {
      this.updateZombieState(
        undefined, undefined, undefined, undefined, 100, 0, 0, mobState, undefined
      )
    });
    return result;
  }).then((newResult: any) => {
    for (let i = 0; i < newResult.length; i++) {
      newResult[i].health = 100;
      var p2Mob = this.makeMob(newResult[i], this.share);
      p2Mob.destinationX = 0;
      p2Mob.destinationY = 0;
      self.world.addBody(p2Mob);
      this.P2mobBodies.push(p2Mob);
    }
  }).catch(function () {
    console.log('Mob shit');
  });
}
