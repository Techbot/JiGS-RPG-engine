///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
//var Bridge = require('../services/bridge.ts');
import { BossState } from "./GameState";
var roomModel = require('../models/room.ts');
import { Boss } from "./Boss.ts";


enum Direction {
  UP,
  DOWN,
  LEFT,
  RIGHT
}


export class Bosses {
  pause = 0;

  async load(room, nodeNumber: number, share) {
    room.P2bosses = new Array;
    roomModel.getBosses(nodeNumber).then((result: any) => {
      result.forEach(bossState => {
        console.log('target' + bossState.entity_id);

        const bossItem = this.updateBossState(room, bossState,
          undefined, undefined, undefined, undefined, undefined, 0, 0, undefined
        );
        room.state.bossResult.set(bossState.entity_id.toString(), bossItem);
      });
      return result;
    }).then((newResult: any) => {
      for (let i = 0; i < newResult.length; i++) {
        newResult[i].health = 100;

        //var p2Boss = this.make(newResult[i], share);
        var p2Boss = new Boss(newResult[i], share);
        room.P2bosses.push(p2Boss);

        var p2BossBody = p2Boss.make()
        room.world.addBody(p2BossBody);
        room.P2bossBodies.push(p2BossBody);
      }
    }).catch(function (e) {
      console.log('Boss Error' + e);
    });
  }

  /////////////////////////////////////////////////////////////////////////////

   updateBosses(room) {

/*     if (room.P2bossBodies.length > 0) {

     var x = 0;

      while (x < room.P2bossBodies.length) {

        room.state.bossResult.forEach(bossState => {
          //     P2BossBody.move(P2BossBody, 25);
          if (bossState.dead != 1) {

            if (room.P2bossBodies[x].title == bossState.title) {
              if (parseInt(bossState.field_x_value) != parseInt(room.P2bossBodies[x].position[0])
                || parseInt(bossState.field_y_value) != parseInt(room.P2bossBodies[x].position[1])) {
                this.sendObject(room, bossState, undefined, room.P2bossBodies[x]);
              }
            }
          }

        });
     //   room.p2Bosses[x].updateBossDirection(room);
        this.updateBossDirection(room);
x++;
      }
    } */
  }



  async updateBossDirection(room) {

    var proceed = 0;
    var thing = 0
    while (thing < room.P2bossBodies.length + 1) {
      if (proceed == 1) {
        if (this.pause == 0) {
          this.pause = 1;
          if (thing == room.P2bossBodies.length) { thing =0;}
       //   const y = await room.P2bosses[thing].skip(4051);
          //const x = await this.skip(4051);
          room.P2bossBodies[thing].direction = room.P2bosses[thing].randomDirection(room.P2bossBodies[thing].direction)
          console.log('---------title ---------- ' + room.P2bossBodies[thing].title);
          room.P2bosses[thing].move( 25);
        }
        thing = thing + 1;
        proceed = 0;
      }
      proceed++;
    }
    //  console.log('---------title ---------- ' + body.title)
  }




  skip = (val) => {
    return new Promise((resolve) => {
      setTimeout(() => {
        this.pause = 0;
        console.log('-------------------------');
        resolve(val);
      }, val);
    });
  }

  // Sets up a zombie state with the original values, then updates

  updateBossState(room, bossState,
    field_boss_target_id: number | undefined, entity_id: number | undefined, title: string | undefined, x: number | undefined, y: number | undefined,
    health: number | undefined, dead: number | undefined, i: number | undefined
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

  sendObject(room, bossState, i, body) {
    let x = 0;
    let y = 0
    if (parseInt(body.position[0])) {
      x = parseInt(body.position[0]);
    }
    if (parseInt(body.position[1])) {
      y = parseInt(body.position[1]);
    }
    const bossItem = this.updateBossState(
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
