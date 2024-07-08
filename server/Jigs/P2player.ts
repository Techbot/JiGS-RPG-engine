///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
import { InputData, MyRoomState, Player } from "./GameState";

var p2 = require('p2');
//var Bridge = require('../services/bridge.ts');
var playerModel = require('../models/player.ts');

export class P2player {
  Body: any;
  constructor() {
  }

  async load(id: any, share: any, player) {
    await playerModel.getPlayer(id).then((result: any) => {
      this.Body = new p2.Body({
        mass: 1,
        angle: 0,
        type: p2.Body.DYNAMIC,
        collisionResponse: true,
        velocity: [0, 0],
        angularVelocity: 0
      });
      const playerShape = new p2.Box({ width: 32, height: 32 });
      playerShape.collisionGroup = share.COL_PLAYER;
      playerShape.collisionMask = share.COL_ENEMY | share.COL_GROUND;

      this.Body.playerId = id;
      this.Body.profileId = result[0].profile_id;
      this.Body.isPlayer = true;
      this.Body.position[0] = result[0].field_x_value;
      this.Body.position[1] = result[0].field_y_value;
      this.Body.health = result[0].field_health_value;
      this.Body.flags = result[0].flags;
      this.Body.addShape(playerShape);
      player.x = this.Body.position[0];
      player.y = this.Body.position[1];

    }).catch(function () {
      console.log('---------------------Player Error---------------------');
    });
  }

  update(input: InputData,
    player: { lastX: any; lastY: any; Body: { collide: any; position: any[]; }; x: number; y: number; tick: any; },
    velocity: number) {
      velocity = 76;

    this.Body.velocity[0] = 0;
    this.Body.velocity[1] = 0;

    if (input.inputX !== player.lastX) {
      player.lastX = input.inputX;
    }
    if (input.inputY !== player.lastY) {
      player.lastY = input.inputY;
    }
    if (input.down) {
      if (!this.Body.collide) {
        this.Body.velocity[1] = velocity;
        this.Body.velocity[0] = 0;
      }
      else {
        this.Body.position[0] += 32;
      }
    }
    else if (input.up) {
      if (!this.Body.collide) {

        this.Body.velocity[1] = -velocity;
        this.Body.velocity[0] = 0;
      }
      else {
        this.Body.position[0] -= 32;
      }
    }
    else if (input.right) {
      if (!this.Body.collide) {
        this.Body.velocity[1] = 0;
        this.Body.velocity[0] = velocity;
      }
      else {
        this.Body.position[1] += 32;
      }
    }
    else if (input.left) {
      if (!this.Body.collide) {
        this.Body.velocity[1] = 0;
        this.Body.velocity[0] = -velocity;
      }
      else {
        this.Body.position[1] -= 32;
      }
    }
    player.x = this.Body.position[0];
    player.y = this.Body.position[1];
    /*   if (this.last_step_x != player.playerBody.position[0] || this.last_step_y != player.playerBody.position[1]) {
      //  console.log(player.playerBody.position[0], player.playerBody.position[1])
        this.last_step_x = player.playerBody.position[0];
        this.last_step_y = player.playerBody.position[1];
      } */
    player.tick = input.tick;
    return player;
  }
}
