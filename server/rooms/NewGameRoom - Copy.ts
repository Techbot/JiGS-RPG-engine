///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
const db = require("../services/db");
const helper = require("../helper");
const config = require("../config");
var mysql = require("mysql2");
import { MapJson } from "./jsonmap";
import { Room, Client } from "colyseus";
import { InputData, MyRoomState, Player } from "./GameState";
//import loadTiles from "../lib/tiled/server/load";
var Bridge = require('../services/bridge.js');
var p2 = require('p2');

export class Part4Room extends Room<MyRoomState> {
  fixedTimeStep = 1000 / 60;
  // Tilemap: loadTiles;

  /////////////////////////////////
  world = new p2.World({ gravity: [0, 0] });
  mapJson: any = MapJson.mapJson;

  //this.setWorld(world);
  colors = { '6': 14153173, '7': 15153173, '8': 12153173, '9': 16701904 };
  squareSize = 32; // 32;
  speedMultiplier = 1; // 20;

  playerShape: any;
  playerBody: any;
  changePoints: any;

  mapDataLayers: any;
  share = {
    SPEED: (1 * this.speedMultiplier),
    // collisions:
    COL_PLAYER: Math.pow(2, 0),
    COL_ENEMY: Math.pow(2, 1),
    COL_GROUND: Math.pow(2, 2)
  };
  tileW = 1 * this.squareSize;
  tileH = 1 * this.squareSize;
  circleBody: any;
  circleShape: any;
  result: any;










  
  constructor() {
    super();
    this.addP2PLayer();
  }

  addP2PLayer() {

    //Bridge.updateMap(1, 1);

    this.playerShape = new p2.Box({ width: this.tileW, height: this.tileH });
    this.playerShape.collisionGroup = this.share.COL_PLAYER;
    this.playerShape.collisionMask = this.share.COL_ENEMY | this.share.COL_GROUND;

    this.playerBody = new p2.Body({
      mass: 1,
      position: [300, 300],
      type: p2.Body.DYNAMIC,
      collisionResponse: true,
      fixedRotation: true
    });
    this.playerBody.isPlayer = true;
    this.playerBody.motionState = 2; //STATIC
    this.playerBody.collideWorldBounds = true;
    this.playerBody.addShape(this.playerShape);
    this.world.addBody(this.playerBody);
    /*  this.playerBody.body.onBeginContact.add(function (body: any, shapeA: any, shapeB: any, equation: any) {
              console.log(body);
        }, this); */

    //  this.world.setPostBroadphaseCallback(this.checkHits, this);

    //console.log('yo2');
    this.changePoints = {
      167: 'House_1',
      168: 'House_1',
      367: 'House_2'
    };

    this.world.on("endcontact", function (evt: any) {
      var bodyA = evt.bodyA;
      //  var bodyB = evt.bodyB; */

      /*       if ((this.playerShape.collisionGroup && this.circleShape.collisionMask) !== 0 &&
              (this.circleShape.collisionGroup && this.playerShape.collisionMask) !== 0) {
              console.log("collide baby");
            } */

    });

    this.world.on("impact", function (evt: any) {
      var bodyA = evt.bodyA;
      //  var bodyB = evt.bodyB; */
      // console.log('yo Contact');
    });

    //  console.log('yo3');
    //this.circleBody.collides(this.playerShape.collisionGroup);
    //this.circleBody.setPostBroadphaseCallback(this.checkHits, this);
    //this.world.setPostBroadphaseCallback(this.checkHits, this);
    // world collisions:
    this.mapDataLayers = [6, 7, 8, 9];
    //  console.log('ygi');
    for (var ci in this.mapDataLayers) {

      //   console.log('----------');
      let colliderIndex = this.mapDataLayers[ci];
      //console.log('colliderIndex: ', colliderIndex, colors[colliderIndex]);

      if (this.mapJson.layers[colliderIndex]) {

        var layerData = this.mapJson.layers[colliderIndex].data;
        for (var c = 0; c < this.mapJson.width; c++) {
          var positionX = c * this.dW;
          for (var r = 0; r < this.mapJson.height; r++) {
            // position in pixels
            var positionY = -(r * this.dH);
            let tileIndex = r * this.mapJson.width + c;
            var tile = layerData[tileIndex];

            // occupy space or add the scene change points:
            if (tile !== 0) { // 0 => empty tiles without collision
              // if the tile is a change point has to be empty for every layer.
              if (this.changePoints[tile]) {
                // only create the change point on the main layer:
                if (colliderIndex == this.mainLayer) {
                  var boxShape = new p2.Box({ width: this.dW, height: this.dH });
                  boxShape.color = 17153666;
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
                  boxBody.changeScenePoint = this.changePoints[tile];
                  /*   console.log('CHANGE POINT TILE: ' + tile,
                      'TILEINDEX: ' + tileIndex,
                      'POSITION: X=' + positionX + ' - Y=' + positionY,
                      'NEXT: ' + changePoints[tile],
                      'boxBody.id: ', boxBody.id,
                      'boxBody.changeScenePoint: ', boxBody.changeScenePoint); */
                  boxBody.addShape(boxShape);
                  this.world.addBody(boxBody);
                } // that's why we don't have an else for the main layer condition here.
              } else {
                // create a box to fill the space:
                var boxShape = new p2.Box({ width: this.dW, height: this.dH });
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
                this.world.addBody(boxBody);
              }
            }
          }
        }
      }
    }

    //  console.log('yo4');

    this.world.on('impact', function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;

      //  console.log('yo Contact');

      if (bodyA.isPlayer) {
        console.log('endContact! --------------------------------------------------------------');
        console.log('BODY A is the player!', bodyA.isPlayer, bodyA.id);
        console.log('BODY B is the wall!', bodyB.isWall, bodyB.id, (bodyB.changeScenePoint ? ' > ' + bodyB.changeScenePoint : 'NCP'), bodyB.position);
        console.log('BODY B TILE / TILEINDEX: ', bodyB.tile, bodyB.tileIndex);
        bodyA.velocity = [0, 0];
      } else {
        console.log('endContact! --------------------------------------------------------------');
        console.log('BODY A is the wall!', bodyA.isWall, bodyA.id, (bodyA.changeScenePoint ? ' > ' + bodyA.changeScenePoint : 'NCP'), bodyA.position);
        console.log('BODY B is the player!', bodyB.isPlayer, bodyB.id);
        console.log('BODY A TILE / TILEINDEX: ', bodyA.tile, bodyA.tileIndex);
        bodyB.velocity = [0, 0];
      }
      console.log('----- endContact END.');
    });
  }


  //////////////////////////////////////////////

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
  //////////////////////////////

  onCreate(options: any) {
    this.setState(new MyRoomState());
    // set map dimensions


    //this.Tilemap = new loadTiles("Blobby Blobby Blobby");
    //this.Tilemap.loadTiles('Wibbly Wobbly');
    this.state.mapWidth = 600;
    this.state.mapHeight = 400;
    this.onMessage(0, (client, input) => {
      // handle player input
      const player = this.state.players.get(client.sessionId);
      // enqueue input to user input buffer.
      player.inputQueue.push(input);
    });

    // Frame rate independent! Success!
    let elapsedTime = 0;
    this.setSimulationInterval((deltaTime) => {
      elapsedTime += deltaTime;
      while (elapsedTime >= this.fixedTimeStep) {
        elapsedTime -= this.fixedTimeStep;
        this.fixedTick(this.fixedTimeStep);
      }
      this.world.on("beginContact", function (evt: any) {
        /*  if (evt.bodyA.entity.name !== 'Holder') {
           alert('Touch down!');
         } */

      }, this);
    });
  }
  fixedTick(timeStep: number) {
    var fixedTimeStep = 1 / 60;
    this.world.step(fixedTimeStep);
    if (!this.playerBody.collision) {
      this.playerBody.collision = true;
      //    console.log('asshole');
      //    console.log('world:');
      //    console.log(this.world);

    } else if (this.playerBody.collision) {
      this.playerBody.collision = false;
      //    console.log('blah');
    };
    const velocity = 2;
    this.state.players.forEach((player: { inputQueue: any[]; x: number; y: number; tick: any; }) => {
      let input: InputData;
      // dequeue player inputs
      while (input = player.inputQueue.shift()) {

        // this.Tilemap.loadTiles(player.x);
        // this.Tilemap.loadTiles(player.y);
        this.playerBody.velocity = [0, 0];
        if (input.left) {
          player.x -= velocity;
          this.playerBody.velocity[0] = -this.share.SPEED;
        } else if (input.right) {
          player.x += velocity;
          this.playerBody.velocity[0] = this.share.SPEED;
        }
        if (input.up) {
          player.y -= velocity;
          this.playerBody.velocity[1] = -this.share.SPEED;
        } else if (input.down) {
          player.y += velocity;
          this.playerBody.velocity[1] = this.share.SPEED;
        }
        this.playerBody.position[0] += this.playerBody.velocity[0];
        this.playerBody.position[1] += this.playerBody.velocity[1];
        // console.log(this.playerBody.position);
        player.tick = input.tick;
      }
    });
  }

  onJoin(client: Client, options: any) {
    console.log(client.sessionId, "joined!");
    const player = new Player();
    /*  player.x = Math.random() * this.state.mapWidth;
        player.y = Math.random() * this.state.mapHeight; */
    player.x = 300;
    player.y = 300;
    this.state.players.set(client.sessionId, player);
  }

  onLeave(client: Client, consented: boolean) {
    console.log(client.sessionId, "left!");
    this.state.players.delete(client.sessionId);
  }

  onDispose() {
    console.log("room", this.roomId, "disposing...");
  }

  //mapData = {};
  mainLayer = 7;
  dW = 1 * this.squareSize;
  dH = 1 * this.squareSize;
  /*   // world boundaries:
    // UP:
    var boxShape = new p2.Box({ width: 24 * squareSize, height: 0.1 * squareSize });
    boxShape.collisionGroup = share.COL_GROUND;
    boxShape.collisionMask = share.COL_PLAYER | share.COL_ENEMY;
    boxShape.color = 17999966;
    var bodyConfig = {
      position: [11.5 * squareSize, 0.5 * squareSize],
      mass: 1,
      type: p2.Body.STATIC,
      fixedRotation: true
    };
    var boxBody = new p2.Body(bodyConfig);
    boxBody.addShape(boxShape);
    world.addBody(boxBody);

    // DOWN:
    var boxShape = new p2.Box({ width: 24 * squareSize, height: 0.1 * squareSize });
    boxShape.collisionGroup = share.COL_GROUND;
    boxShape.collisionMask = share.COL_PLAYER | share.COL_ENEMY;
    boxShape.color = 17999966;
    var bodyConfig = {
      position: [11.5 * squareSize, -17.5 * squareSize],
      mass: 1,
      type: p2.Body.STATIC,
      fixedRotation: true
    };

    var boxBody = new p2.Body(bodyConfig);
    boxBody.addShape(boxShape);
    world.addBody(boxBody);

    // LEFT:
    var boxShape = new p2.Box({ width: 0.1 * squareSize, height: 18 * squareSize });
    boxShape.collisionGroup = share.COL_GROUND;
    boxShape.collisionMask = share.COL_PLAYER | share.COL_ENEMY;
    boxShape.color = 17999966;
    var bodyConfig = {
      position: [-0.5 * squareSize, -8.5 * squareSize],
      mass: 1,
      type: p2.Body.STATIC,
      fixedRotation: true
    };

    var boxBody = new p2.Body(bodyConfig);
    boxBody.addShape(boxShape);
    world.addBody(boxBody);

    // RIGHT:
    var boxShape = new p2.Box({ width: 0.1 * squareSize, height: 18 * squareSize });
    boxShape.collisionGroup = share.COL_GROUND;
    boxShape.collisionMask = share.COL_PLAYER | share.COL_ENEMY;
    boxShape.color = 17999966;
    var bodyConfig = {
      position: [23.5 * squareSize, -8.5 * squareSize],
      mass: 1,
      type: p2.Body.STATIC,
      fixedRotation: true
    };
    var boxBody = new p2.Body(bodyConfig);
    boxBody.addShape(boxShape);
    world.addBody(boxBody); */

}
