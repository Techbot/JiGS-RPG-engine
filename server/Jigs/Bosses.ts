///////////////////////////////////////////////////////////////////////////////
//
//
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
        room.world.addBody(p2Boss);
        room.P2bossBodies.push(p2Boss);
      }
    }).catch(function (e) {
      console.log('Boss Error' + e);
    });
  }

  /////////////////////////////////////////////////////////////////////////////

  updateBosses(room) {

    if (room.P2bossBodies.length > 0) {

      room.P2bossBodies.forEach(P2BossBody => {
        room.state.bossResult.forEach(bossState => {
          P2BossBody.updateToDirection(25);
          if (bossState.dead != 1) {
            //console.log("a " + room.P2bossBodies[i].title);
            //console.log("b " + bossState.title);
            if (P2BossBody.title == bossState.title) {
              if (parseInt(bossState.field_x_value) != parseInt(P2BossBody.position[0])
                || parseInt(bossState.field_y_value) != parseInt(P2BossBody.position[1])) {
                this.sendObject(room, bossState, undefined, P2BossBody);
              }
            }
          }
        });
      }
      );
      this.updateBossForce(room.P2bossBodies);
    }
  };

  async updateBossForce(P2bossBodies) {
    if (this.pause == 0) {
      this.pause = 1;
      const x = await this.skip(4051);
      P2bossBodies.forEach(P2BossBody => {

        P2BossBody.direction = P2BossBody.randomDirection(P2BossBody.direction)
        console.log('---------title ---------- ' + P2BossBody.title);
        P2BossBody.updateToDirection(25);
      })
    }
  }

  randomDirection = (exclude: Direction) => {
    let newDirection = (Math.floor(Math.random() * 4))
    while (newDirection === exclude) {
      newDirection = (Math.floor(Math.random() * 4))
    }
    return newDirection
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

  // Sets up a state with the original values, then updates

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
