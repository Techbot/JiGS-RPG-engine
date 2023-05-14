import { Room, Client } from "colyseus";
const db = require("../services/db");
const helper = require("../helper");
const config = require("../config");
var mysql = require("mysql2");
import { mapJson } from "./jsonMap";
import { InputData, MyRoomState, Player } from "./GameState";
var Bridge = require('../services/bridge.js');
var p2 = require('p2');
const fs = require('fs');

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
  colors = { '6': 14153173, '7': 15153173, '8': 12153173, '9': 16701904 };
  result: any;
  world: any;
  p2playa: any;
  playerShape: any;
  playerBody: any;
  last_step_x: any;
  last_step_y: any;
  portalBody: any;
  client: Client;
  changePoints: any;
  mapDataLayers: number[];
  dW: number;
  dH: number;
  mainLayer: number;
  mapJson: any;

  constructor() {
    super();
    this.world = new p2.World({ gravity: [0, 0] });

  }

  loadMaps(nodeName: string) {
    try {
      const data = require('../../../../../assets/cities/' + nodeName + '.json');
      //   console.log(data);
      return data;
    } catch (err) {
      console.log(err);
      console.log('ggggg');
    }
  }

  async loadPortals(nodeNumber: number) {
    const portal = await import("./portal");
    // Render page
    var self = this;

    Bridge.getPortals(nodeNumber).then((result: any) => {
      this.result = result;
      return result;
    }).then((newResult: any) => {
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

  async loadNpcs(nodeNumber: number) {
    const Npc = await import("./npc");
    // Render page
    var self = this;
    Bridge.getNpcs(nodeNumber).then((result: any) => {
      this.result = result;
      return result;
    }).then((newResult: any) => {
      for (let i = 0; i < newResult.length; i++) {
        self.world.addBody(Npc.placeNpc(newResult[i], this.share));
        console.log(
          'added Npc to '
          + newResult[i].field_x_value + " x ; "
          + newResult[i].field_y_value + " y "
        );
      }
    }).catch(function () {
      console.log('shit');
    });

  }

  async loadRewards(nodeNumber: number) {
    const reward = await import("./reward");
    // Render page
    var self = this;
    Bridge.getRewards(nodeNumber).then((result: any) => {
      this.result = result;
      return result;
    }).then((newResult: any) => {
      for (let i = 0; i < newResult.length; i++) {
        self.world.addBody(reward.placeReward(newResult[i], this.share));
        console.log(
          'added reward to '
          + '@: '
          + newResult[i].field_x_value
          + ' x ; ' + newResult[i].field_y_value + 'y'
        );
      }
    }).catch(function () {
      console.log('shit');
    });

  }

  onCreate(options: any) {
    this.setState(new MyRoomState());
    this.loadPortals(options.nodeNumber);
    this.loadRewards(options.nodeNumber);
    this.loadNpcs(options.nodeNumber);

    this.addLayers(options.nodeName);

    // set map dimensions
    this.state.mapWidth = 1900;
    this.state.mapHeight = 1900;

    this.onMessage(0, (client, input) => {

      // handle player input
      const player = this.state.players.get(client.sessionId);

      if (player.playerBody.portal) {
        console.log(player.playerBody.portal);
        client.send("portal", player.playerBody.portal);
        player.playerBody.portal = false;
      }

      else if (player.playerBody.collide) {
        console.log(player.playerBody.collide);
        client.send("collide", player.playerBody.collide);
        player.playerBody.collide = false;
        // player.inputQueue.push(input);
      }
      else {
        player.inputQueue.push(input);
      }
    });

    var self = this;



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
    });
  }

  onJoin(client: Client, options: any) {
    console.log(client.sessionId, "joined!");
    console.log(options.playerId, "joined!");

    const player = new Player();
    player.playerId = options.playerId;

    player.x = 500;
    player.y = 500;

    const playerShape = new p2.Box({ width: 32, height: 48 });
    playerShape.collisionGroup = this.share.COL_PLAYER;
    playerShape.collisionMask = this.share.COL_ENEMY | this.share.COL_GROUND;

    player.playerBody = new p2.Body({
      mass: 1,
      position: [player.x, player.y],
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      fixedRotation: true
    });
    player.playerBody.playerId = player.playerId;
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


  checkHits() {

    //  To explain - the post broadphase event has collected together all potential collision pairs in the world
    //  It doesn't mean they WILL collide, just that they might do.

    //  This callback is sent each collision pair of bodies. It's up to you how you compare them.
    //  If you return true then the pair will carry on into the narrow phase, potentially colliding.
    //  If you return false they will be removed from the narrow phase check all together.

    //  In this simple example if one of the bodies is our space ship,
    //  and the other body is the green pepper sprite (frame ID 4) then we DON'T allow the collision to happen.
    //  Usually you would use a collision mask for something this simple, but it demonstates use.

    /*     if ((body1.sprite.name === 'ship' && body2.sprite.frame === 4) || (body2.sprite.name === 'ship' && body1.sprite.frame === 4)) {
          console.log('Bilbo Baggins')
          return false;
        } */
    console.log('Frodo Baggins')
    return true;
  }

  async addLayers(nodeName: any) {
    this.mapJson = this.loadMaps(nodeName);

    var layerData = this.mapJson.layers[0].data;

    console.log('activated');
    var self = this;
    // world collisions:
    console.log('----------');
    for (var c = 0; c < this.mapJson.width; c++) {
      var positionX = c * 16;
      for (var r = 0; r < this.mapJson.height; r++) {
        // position in pixels
        var positionY = (r * 16);
        let tileIndex = r * this.mapJson.width + c;
        var tile = layerData[tileIndex];
        // occupy space or add the scene change points:
        if (tile !== 0) { // 0 => empty tiles without collision
          // if the tile is a change point has to be empty for every layer.
          // only create the change point on the main layer:
          // create a box to fill the space:
          var boxShape = new p2.Box({ width: 16, height: 16 });
          //boxShape.color = this.colors[colliderIndex];
          boxShape.collisionGroup = this.share.COL_GROUND;
          boxShape.collisionMask = this.share.COL_PLAYER | this.share.COL_ENEMY;
          var bodyConfig = {
            position: [positionX, positionY],
            mass: 1,
            type: p2.Body.STATIC,
            fixedRotation: true
          };
          var boxBody = new p2.Body(bodyConfig);
          boxBody.tile = tile;
          boxBody.tileIndex = tileIndex;
          boxBody.isWall = true;
          boxBody.addShape(boxShape);
          //console.log(boxBody.tile);
          //console.log("c:" + c);
          self.world.addBody(boxBody);
        }
      }
    }

    this.world.on("endcontact", function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      console.log('-----------End Contact--- Pay Attention---');

    });

    //  console.log('yo4');


    this.world.on('impact', function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      if (bodyA.isPortal) {
        if (!bodyA.done) {
          console.log('Portal!!!!');
          console.log('tiled: ' + bodyA.tiled);
          console.log('playerId: ' + bodyB.playerId);
          const promise1 = Promise.resolve(Bridge.updateMap(bodyB.playerId, bodyA.destination));
          promise1.then(() => {
            bodyB.portal = bodyA.tiled;
          });
          bodyA.done = true;
        }
      }

      if (bodyA.isReward) {
        if (!bodyA.done) {
          console.log('Reward!!!!');
          console.log('playerId: ' + bodyB.playerId);
/*           const promise1 = Promise.resolve(Bridge.updateMap(bodyB.playerId, bodyA.destination));
          promise1.then(() => {
            bodyB.portal = bodyA.tiled;
          }); */
          bodyA.done = true;
        }
      }






    });



    this.world.on('beginContact', function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      console.log('Begin Contact');
      if (bodyA.isPlayer) {
        /*           console.log('endContact! --------------------------------------------------------------');
                  console.log('BODY A is the player!', bodyA.isPlayer, bodyA.id);
                  console.log('BODY B is the wall!', bodyB.isWall, bodyB.id,  bodyB.position); */
        console.log('BODY B TILE / TILEINDEX: ', bodyB.tile, bodyB.tileIndex);
        bodyA.collide = true;
        //    bodyA.velocity = [0, 0];
      } else {
        /*   console.log('endContact! --------------------------------------------------------------');
          console.log('BODY A is the wall!', bodyA.isWall, bodyA.id, bodyA.position);
          console.log('BODY B is the player!', bodyB.isPlayer, bodyB.id); */
        console.log('BODY A TILE / TILEINDEX: ', bodyA.tile, bodyA.tileIndex);
        bodyB.collide = true;
        //  bodyB.velocity = [0, 0];
      }
      console.log('----- .');
    });
  }
}
