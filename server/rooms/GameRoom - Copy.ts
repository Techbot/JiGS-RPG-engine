import { Room, Client } from "colyseus";
const db = require("../services/db");
const helper = require("../helper");
const config = require("../config");
var mysql = require("mysql2");
import { InputData, MyRoomState, Player } from "./GameState";
var Bridge = require('../services/bridge.js');
var p2 = require('p2');

export class GameRoom extends Room<MyRoomState> {
  fixedTimeStep = 1000 / 60;
  speedMultiplier = 1; // 20;
  share = {
    SPEED: (1 * this.speedMultiplier),
    // collisions:
    COL_PLAYER: Math.pow(2, 0),
    COL_ENEMY: Math.pow(2, 1),
    COL_GROUND: Math.pow(2, 2)
  };

  result: any;
  world: any;
  p2playa: any;
  playerShape: any;
  playerBody: any;
  last_step_x: any;
  last_step_y: any;
  portalBody: any;
  client: Client;

  constructor() {
    super();
    this.world = new p2.World({ gravity: [0, 0] });
  }

  async loadPortals(nodeNumber : number) {
    const portal = await import("./portal");
    // Render page
    var self = this;

    Bridge.getPortals(nodeNumber).then((result: any) => {
      this.result = result;
      return result;
    }).then((newResult: any) => {
      console.log('length:' + newResult.length);
      for (let i = 0; i < newResult.length; i++) {
        self.world.addBody(portal.placePortal(newResult[i], this.share));
        console.log(
          'added portal to '
          + newResult[i].field_destination_target_id
          + "@: "
          + newResult[i].field_destination_x_value
          + " x ; " + newResult[i].field_destination_y_value + "y"

          + 'to' + newResult[i].field_tiled_value

          );
      }
    }).catch(function () {
      console.log('shit');
    });

  }


  onCreate(options: any) {
    this.setState(new MyRoomState());
    this.loadPortals(options.nodeNumber);
    // set map dimensions
    this.state.mapWidth = 640;
    this.state.mapHeight = 480;

    this.onMessage(0, (client, input) => {

      // handle player input
      const player = this.state.players.get(client.sessionId);

      if (player.playerBody.portal) {
        console.log(player.playerBody.portal);
        client.send("portal", player.playerBody.portal);
        player.playerBody.portal=0;
      }

      player.inputQueue.push(input);

    });

    var self = this;
    this.world.on('impact', function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      if (bodyA.isPortal) {
        if (!bodyA.done) {
          console.log('Body A portal!!!!');
          console.log('tiled: ' + bodyA.tiled);
          const promise1 = Promise.resolve(Bridge.updateMap(1, bodyA.destination));
          promise1.then(() => {
            bodyB.portal = bodyA.tiled;
          });
          bodyA.done = true;
        }
      }

    });

    let elapsedTime = 0;
    this.setSimulationInterval((deltaTime) => {
      elapsedTime += deltaTime;
      while (elapsedTime >= this.fixedTimeStep) {
        elapsedTime -= this.fixedTimeStep;
        this.fixedTick(this.fixedTimeStep);
      }
    });
  }

  fixedTick(timeStep: number) {
    const velocity = 2;
    var fixedTimeStep = 1 / 60;
    this.world.step(fixedTimeStep);
    ///////////////////////////////////////////////////////////////////////////////

    this.state.players.forEach(player => {
      let input: InputData;

      // dequeue player inputs
      while (input = player.inputQueue.shift()) {

        if (input.left) {
          player.x -= velocity;
        } else if (input.right) {
          player.x += velocity;
        }
        else if (input.up) {
          player.y -= velocity;
        } else if (input.down) {
          player.y += velocity;
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
    });
  }

  onJoin(client: Client, options: any) {
    console.log(client.sessionId, "joined!");

    const player = new Player();
    player.x = 500;
    player.y = 500;

    const playerShape = new p2.Box({ width: 32, height: 32 });
    playerShape.collisionGroup = this.share.COL_PLAYER;
    playerShape.collisionMask = this.share.COL_ENEMY | this.share.COL_GROUND;

    player.playerBody = new p2.Body({
      mass: 1,
      position: [player.x, player.y],
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      fixedRotation: true
    });
    player.playerBody.isPlayer = true;
    player.playerBody.motionState = 2; //STATIC
    player.playerBody.collideWorldBounds = true;
    player.playerBody.addShape(playerShape);
    player.playerBody.clientID = client.sessionId;
    this.state.players.set(client.sessionId, player);
    this.world.addBody(player.playerBody);
  }

  onLeave(client: Client, consented: boolean) {
    console.log(client.sessionId, "left!");
    this.state.players.delete(client.sessionId);
  }

  onDispose() {
    console.log("room", this.roomId, "disposing...");
  }

  async loadP2Player(player: any, clientID: any) {
    const p2Player = await import("./P2player");
    const PBody = p2Player.placePlayer(this.share, player);
    return PBody;
  }
}
