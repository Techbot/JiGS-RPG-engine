///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
import { InputData, MyRoomState, Player } from "./GameState";

var p2 = require('p2');
var Bridge = require('../services/bridge.ts');


export function placePlayer(share: any, player: any) {

  Bridge.getPlayer(player.playerId).then((result: any) => {
    this.result = result;
    return result;
  }).then((newResult: any) => {

    const playerShape = new p2.Box({ width: 32, height: 32 });
    playerShape.collisionGroup = share.COL_PLAYER;
    playerShape.collisionMask = share.COL_ENEMY | share.COL_GROUND;

    const playerBody = new p2.Body({
      mass: 1,
      position: [newResult[0].field_x_value, newResult[0].field_y_value],
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      fixedRotation: true
    });

    playerBody.x = newResult[0].field_x_value;
    playerBody.y = newResult[0].field_y_value;
    playerBody.health = newResult[0].field_health_value;
    playerBody.playerId = player.playerId;
    playerBody.isPlayer = true;
    playerBody.motionState = 2; //STATIC
    playerBody.collideWorldBounds = true;
    playerBody.addShape(playerShape);

    return playerBody;

  }).catch(function () {
    console.log('shit');
  });

}

export function updatePlayer(
  input: InputData,
  player: { lastX: any; lastY: any; playerBody: { collide: any; position: any[]; }; x: number; y: number; tick: any; },
  velocity: number) {

  if (input.inputX !== player.lastX) {
    console.log('x = ' + input.inputX);
    player.lastX = input.inputX;
  }
  if (input.inputY !== player.lastY) {
    console.log('y = ' + input.inputY);
    player.lastY = input.inputY;
  }
  if (input.left) {
    if (!player.playerBody.collide) {
      player.x -= velocity;
    }
    else {
      player.x += 32;
    }
  }
  else if (input.right) {
    if (!player.playerBody.collide) {
      player.x += velocity;
    }
    else {
      player.x -= 32;
    }
  }
  else if (input.up) {
    if (!player.playerBody.collide) {
      player.y -= velocity;
    }
    else {
      player.y += 32;
    }
  }
  else if (input.down) {
    if (!player.playerBody.collide) {
      player.y += velocity;
    }
    else {
      player.y -= 32;
    }
  }
  player.playerBody.position[0] = player.x;
  player.playerBody.position[1] = player.y;
  if (this.last_step_x != player.playerBody.position[0] || this.last_step_y != player.playerBody.position[1]) {
    console.log(player.playerBody.position[0], player.playerBody.position[1])
    this.last_step_x = player.playerBody.position[0];
    this.last_step_y = player.playerBody.position[1];
  }
  player.tick = input.tick;
}
