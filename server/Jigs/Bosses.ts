///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
import { BossState } from "./GameState";
var roomModel = require('../models/room.ts');
var p2 = require('p2');
export class Boss {

  async load(world, nodeNumber, share) {
    roomModel.getBosses(nodeNumber).then((result: any) => {
      // state.NpcResult = result;
      return result;
    }).then((newResult: any) => {
      for (let i = 0; i < newResult.length; i++) {
        world.addBody(this.make(newResult[i], share));
      }
    }).catch(function () {
      console.log('Boss Error');
    });
  }

  make(boss: any, share: any) {
    // console.log('place');
    const circleShape = new p2.Circle({ radius: 10 });
    circleShape.collisionGroup = share.COL_ENEMY;
    circleShape.collisionMask = share.COL_PLAYER;
    // Create a typical dynamic body
    const circleBody = new p2.Body({
      mass: 1,
      position: [boss.field_x_value, boss.field_y_value],
      angle: 0,
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      velocity: [0, 0],
      angularVelocity: 0
    });
    // console.log(' position:', circleBody.position);
    circleBody.isBoss = true;
    circleBody.sensor = true;
    circleBody.motionState = 2; //STATIC
    // Add a circular shape to the body
    circleBody.addShape(circleShape);
    //this.circleBody.onBeginContact.add(this.checkHits(), this);
    // Add the body to the world
    return circleBody
  }

  updateBoss(room) {
    if (room.P2bossBodies.length > 0) {

      console.log('update boss');

      // Update destination every 2 seconds for one of the bosess
      if (room.pause == 0) {
        room.pause = 1;
        const myPromise = new Promise((resolve, reject) => {
          resolve(Math.ceil(Math.random() * room.P2bossBodies.length - 1));
        });

        myPromise.then((bossNumber) => {
          this.updateBossForce(room.P2bossBodies[bossNumber]);
          room.pause = 0;
        });
      }

      let i = 0;
      //////////////////////////Cycle through Boss bodies
      while (i < room.P2bossBodies.length) {
        room.P2bossBodies[i].setZeroForce();

        /////////////////////// CYCLE THROUGH Boss  State /////////////////////////////
        room.state.bossResult.forEach(bossState => {
          if (bossState.dead != 1) {

            if (room.P2bossBodies[i].field_boss_name_value == bossState.field_boss_name_value) {
              //if  not following someone, do the test
              if (bossState.following == 0) {
                //if state x,y is out of date
                if (parseInt(bossState.field_x_value) != parseInt(room.P2bossBodies[i].position[0])
                  || parseInt(bossState.field_y_value) != parseInt(room.P2bossBodies[i].position[1])) {
                  this.sendObject(room, bossState, i);
                }
                room.state.players.forEach(player => {
                  //find distance
                  var bossPlayerDist = Math.hypot(player.x - parseInt(room.P2bossBodies[i].position[0]), player.y - parseInt(room.P2bossBodies[i].position[1]));
                  if (bossPlayerDist < 160) {
                    // this is to update the bosss follower
                    bossState.following = player.playerId;
                  }
                  this.sendObject(room, bossState, i)
                })
              }

              if (bossState.following) {
                room.state.players.forEach(player => {
                  if (bossState.dead) {
                    room.P2bossBodies[i].velocity[0] = 0;
                    room.P2bossBodies[i].velocity[1] = 0;
                  }
                  //follow the first player in the array
                  else if (player.playerId == bossState.following && !bossState.dead) {
                    var bossPlayerDist = Math.hypot(player.x - parseInt(room.P2bossBodies[i].position[0]), player.y - parseInt(room.P2bossBodies[i].position[1]));

                    if (bossPlayerDist > 160) {
                      // this is to update the bosss follower
                      bossState.following = 0;
                      room.P2bossBodies[i].velocity[0] = 0;
                      room.P2bossBodies[i].velocity[1] = 0;
                    }
                    else {
                      this.adjustVelocity(room.P2bossBodies[i], player.p2Player.Body, 20);
                      this.sendObject(room, bossState, i)
                    }
                  }
                })
              };
            }
          }
        });
        i++;
      };
    };
  }


  async updateBossForce(body) {

    await this.skip(2000);
    // var forceX = (Math.ceil(Math.random() * 50) + 20) * (Math.round(Math.random()) ? 1 : -1);
    //  var forceY = (Math.ceil(Math.random() * 50) + 20) * (Math.round(Math.random()) ? 1 : -1);
    var forceX = (Math.ceil(Math.random() * 50) + 20);
    var forceY = (Math.ceil(Math.random() * 50) + 20);

    if (body.dead != true) {
      body.velocity[0] = forceX;
      body.velocity[1] = forceY;
    }
  }

  adjustVelocity(body, body2, amount) {

    if (!body.dead) {
      body.velocity[0] = 0;
      if (parseInt(body.position[0]) > body2.position[0]) {
        body.velocity[0] = -amount;
      }
      if (parseInt(body.position[0]) < body2.position[0]) {
        body.velocity[0] = amount;
      }
      body.velocity[1] = 0;
      if (parseInt(body.position[1]) > body2.position[1]) {
        body.velocity[1] = -amount;
      }
      if (parseInt(body.position[1]) < body2.position[1]) {
        body.velocity[1] = amount;
      }

    }
  }

  skip(val) {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve('resolved');
      }, val);
    });
  }


  // Sets up a zombie state with the original values, then updates

  static updateBossState(room,
    target_id: number | undefined, name: string | undefined, x: number | undefined, y: number | undefined,
    health: number | undefined, dead: number | undefined, following: number | undefined, bossState, i: number | undefined
  ) {
    const bossItem = new BossState();
    if (bossState != undefined) {
      bossItem.field_mobs_target_id = bossState.field_mobs_target_id;
      bossItem.field_mob_name_value = bossState.field_mob_name_value;
      bossItem.field_x_value = bossState.field_x_value;
      bossItem.field_y_value = bossState.field_y_value;
      bossItem.following = bossState.following;
      bossItem.health = bossState.health;
      bossItem.dead = bossState.dead;
    }
    if (i != undefined) {
      bossItem.field_x_value = parseInt(room.P2bossBodies[i].position[0]);
      bossItem.field_y_value = parseInt(room.P2bossBodies[i].position[1]);
    }
    if (target_id != undefined) {bossItem.field_mobs_target_id = target_id; }
    if (name != undefined) { bossItem.field_mob_name_value = name; }
    if (x != undefined) { bossItem.field_x_value = x; }
    if (y != undefined) { bossItem.field_y_value = y; }
    if (following != undefined) { bossItem.following = following; }
    if (health != undefined) { bossItem.health = health; }
    if (dead != undefined) { bossItem.dead = dead; }

    //worldThing.state.mobResult.set(mobState.field_mob_name_value, mobItem);
    return bossItem;
  }

  sendObject(room, bossState, i) {
    let x = 0;
    let y = 0
    if (parseInt(room.P2bossBodies[i].position[0])) {
      x = parseInt(room.P2bossBodies[i].position[0]);
    }
    if (parseInt(room.P2bossBodies[i].position[1])) {
      y = parseInt(room.P2bossBodies[i].position[1]);
    }
    const bossItem = Boss.updateBossState(
      room,
      bossState.field_bosss_target_id,
      bossState.field_boss_name_value,
      x,
      y,
      undefined,
      undefined,
      bossState.following,
      bossState,
      i
    )
    room.state.bossResult.set(bossItem.field_boss_name_value, bossItem);
  }

}
