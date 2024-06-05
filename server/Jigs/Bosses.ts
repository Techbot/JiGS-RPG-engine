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
  pause = 0;

  async load(room, nodeNumber: number, share) {
    roomModel.getBosses(nodeNumber).then((result: any) => {
      result.forEach(bossState => {
        console.log('target' + bossState.entity_id);

        const bossItem = Boss.updateBossState(room, bossState,
            undefined, undefined,undefined, undefined, undefined, 0, 0, undefined
          );
        room.state.bossResult.set(bossState.entity_id.toString(), bossItem);
      });
      return result;
    }).then((newResult: any) => {
      for (let i = 0; i < newResult.length; i++) {
        newResult[i].health = 100;
        var p2Boss = this.make(newResult[i], share);
        p2Boss.destinationX = 0;
        p2Boss.destinationY = 0;
        room.world.addBody(p2Boss);
        room.P2bossBodies.push(p2Boss);
      }
    }).catch(function (e) {
      console.log('Boss Error' + e);
    });
  }

  make(boss: any, share: any) {
    console.log('place boss ' + boss.entity_id + ' @ ' + boss.x + ' X and ' + boss.y + ' Y');
    const circleShape = new p2.Circle({ radius: 10 });
    circleShape.collisionGroup = share.COL_ENEMY;
    circleShape.collisionMask = share.COL_PLAYER;
    // Create a typical dynamic body
    const circleBody = new p2.Body({
      mass: 1,
      position: [boss.x, boss.y],
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      velocity: [0, 0],
      angularVelocity: 0
    });
    // console.log(' position:', circleBody.position);
    circleBody.isBoss = true;
    circleBody.title = boss.title;
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

      // Update destination every 2 seconds for one of the bosess

      let i = 0;
      //////////////////////////Cycle through Boss bodies
      while (i < room.P2bossBodies.length) {
        room.P2bossBodies[i].setZeroForce();
        this.updateBossForce(room.P2bossBodies[i]);

        /////////////////////// CYCLE THROUGH Boss  State /////////////////////////////
        room.state.bossResult.forEach(bossState => {
          if (bossState.dead != 1) {


            console.log("a" + room.P2bossBodies[i].title);
            console.log("b" + bossState.title);


            if (room.P2bossBodies[i].title == bossState.title) {
              //if  not following someone, do the test
          //    if (bossState.following == 0) {
                //if state x,y is out of date
                if (parseInt(bossState.field_x_value) != parseInt(room.P2bossBodies[i].position[0])
                  || parseInt(bossState.field_y_value) != parseInt(room.P2bossBodies[i].position[1])) {
                  this.sendObject(room, bossState, i);
                }
                room.state.players.forEach(player => {
                  //find distance
                 // var bossPlayerDist = Math.hypot(player.x - parseInt(room.P2bossBodies[i].position[0]), player.y - parseInt(room.P2bossBodies[i].position[1]));
/*                   if (bossPlayerDist < 160) {
                    // this is to update the bosss follower
                    bossState.following = player.playerId;
                  } */
              //    this.sendObject(room, bossState, i)
                })
          //    }

/*               if (bossState.following) {
                room.state.players.forEach(player => {
                  if (bossState.dead) {
                    room.P2bossBodies[i].velocity[0] = 0;
                    room.P2bossBodies[i].velocity[1] = 0;
                  }
                  //follow the first player in the array
                  else if (player.playerId == bossState.following && !bossState.dead) {
                    var bossPlayerDist = Math.hypot(player.x - parseInt(room.P2bossBodies[i].position[0]), player.y - parseInt(room.P2bossBodies[i].position[1]));

                    if (bossPlayerDist > 160) {
                      // this is to update the boss follower
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
              }; */
            }
          }
        });
        i++;
      };
    };
  }

  async updateBossForce(body) {

    if (this.pause ==0){
      this.pause=1
   const x = await this.skip(4000);
      console.log('--------------------------- ' + x)
  }

 //   console.log(body);
    // var forceX = (Math.ceil(Math.random() * 50) + 20) * (Math.round(Math.random()) ? 1 : -1);
    //  var forceY = (Math.ceil(Math.random() * 50) + 20) * (Math.round(Math.random()) ? 1 : -1);
    var forceX = (Math.ceil(Math.random() * 50) + 20);
    var forceY = (Math.ceil(Math.random() * 50) + 20);

 //   if (body.dead != true) {
      body.velocity[0] = forceX;
      body.velocity[1] = forceY;
//    }
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
        this.pause= 0;
        console.log('-------------------------');
        resolve(val);
      }, val);
    });
  }




  // Sets up a zombie state with the original values, then updates

  static updateBossState(room,bossState,
    field_boss_target_id: number | undefined, entity_id: number | undefined, title: string | undefined, x: number | undefined, y: number | undefined,
    health: number | undefined, dead: number | undefined,  i: number | undefined
  ) {
    const bossItem = new BossState();
    if (bossState != undefined) {
      bossItem.field_boss_target_id = bossState.field_boss_target_id;
      bossItem.entity_id = bossState.entity_id.toString();
      bossItem.title = bossState.title;
      bossItem.x = bossState.x;
      bossItem.y = bossState.y;
      bossItem.health = bossState.health;
      bossItem.dead = bossState.dead;
    }
    if (i != undefined) {
      bossItem.x = parseInt(room.P2bossBodies[i].position[0]);
      bossItem.y = parseInt(room.P2bossBodies[i].position[1]);
    }
    if (field_boss_target_id != undefined) { bossItem.field_boss_target_id = field_boss_target_id; }
    if (title != undefined) { bossItem.title = title; }
    if (x != undefined) { bossItem.x = x; }
    if (y != undefined) { bossItem.y = y; }
    if (entity_id != undefined) { bossItem.entity_id = entity_id; }
    if (health != undefined) { bossItem.health = health; }
    if (dead != undefined) { bossItem.dead = dead; }

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
      bossState,
      bossState.field_boss_target_id,
      bossState.entity_id.toString(),
      bossState.title,
      x,
      y,
      undefined,
      undefined,
      i
    )
    room.state.bossResult.set(bossState.entity_id.toString(), bossItem);
  }
}
