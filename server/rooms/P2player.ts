///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
import { InputData, MyRoomState, Player } from "./GameState";

var p2 = require('p2');
var Bridge = require('../services/bridge.ts');

export class P2player {
  playerBody: any;

  constructor(id, share) {
    this.playerBody = new p2.Body({
      mass: 1,
      position: [500, 500],
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      fixedRotation: true
    });
    this.playerBody.playerId = id;
    this.placePlayer(id, share);
    this.playerBody.isPlayer = true;
    this.playerBody.motionState = 2; //STATIC
    this.playerBody.collideWorldBounds = true;
  }

  placePlayer(id: any, share: any,) {

    Bridge.getPlayer(id).then((result: any) => {
      const playerShape = new p2.Box({ width: 32, height: 32 });
      playerShape.collisionGroup = share.COL_PLAYER;
      playerShape.collisionMask = share.COL_ENEMY | share.COL_GROUND;
      this.playerBody.position[0] = result[0].field_x_value
      this.playerBody.position[1] = result[0].field_y_value
      this.playerBody.health = result[0].field_health_value;
      this.playerBody.addShape(playerShape);

      console.log('Player body:' + this.playerBody);
    }).catch(function () {
      console.log('---------------------Player shit---------------------');
    });
  }

  updatePlayer(input: InputData,
    player: { lastX: any; lastY: any; playerBody: { collide: any; position: any[]; }; x: number; y: number; tick: any; },
    velocity: number) {
    if (input.inputX !== player.lastX) {
      //   console.log('x = ' + input.inputX);
      player.lastX = input.inputX;
    }
    if (input.inputY !== player.lastY) {
      //   console.log('y = ' + input.inputY);
      player.lastY = input.inputY;
    }
    if (input.left) {
      if (!this.playerBody.collide) {
        player.x -= velocity;
      }
      else {
        player.x += 32;
      }
    }
    else if (input.right) {
      if (!this.playerBody.collide) {
        player.x += velocity;
      }
      else {
        player.x -= 32;
      }
    }
    else if (input.up) {
      if (!this.playerBody.collide) {
        player.y -= velocity;
      }
      else {
        player.y += 32;
      }
    }
    else if (input.down) {
      if (!this.playerBody.collide) {
        player.y += velocity;
      }
      else {
        player.y -= 32;
      }
    }
    this.playerBody.position[0] = player.x;
    this.playerBody.position[1] = player.y;
    /*   if (this.last_step_x != player.playerBody.position[0] || this.last_step_y != player.playerBody.position[1]) {
      //  console.log(player.playerBody.position[0], player.playerBody.position[1])
        this.last_step_x = player.playerBody.position[0];
        this.last_step_y = player.playerBody.position[1];
      } */
    player.tick = input.tick;
  }
}
