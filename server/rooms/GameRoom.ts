import { Room, Client } from "colyseus";
const db = require("../services/db");
const Mob = require("./mob");
import { InputData, MyRoomState, Player } from "./GameState";
var Bridge = require('../services/bridge.ts');
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
  indexNumber: any;
  P2mobBodies: any;
  pause: number;
  constructor() {
    super();
    this.world = new p2.World({ gravity: [0, 0] });
    this.P2mobBodies = [];
    this.pause = 0;
  }

  onCreate(options: any) {
    let self = this;
    this.indexNumber = 1;
    this.setState(new MyRoomState());
    this.loadPortals(options.nodeNumber);
    this.loadRewards(options.nodeNumber);
    this.loadNpcs(options.nodeNumber);
    Mob.loadMobs(options.nodeNumber, self);
    this.addLayers(options.nodeName);
    this.state.mapWidth = 1900;
    this.state.mapHeight = 1900;

    this.onMessage(0, (client, input) => {
      // handle player input

      const player = this.state.players.get(client.sessionId);
      if (player.playerBody.portal) {
        client.send("portal", player.playerBody.portal);
        player.playerBody.portal = false;
      }
      else if (player.playerBody.collide) {
        client.send("collide", player.playerBody.collide);
        player.playerBody.collide = false;
      }
      else if (player.playerBody.struck) {
        client.send("struck", player.playerBody.health);
        player.playerBody.struck = false;
      }
      else if (player.playerBody.dead) {
        client.send("dead", player);
        player.playerBody.dead = false;
      }
      else if (player.playerBody.reward) {
        client.send("reward", player.playerBody.reward);
        player.playerBody.reward = false;
        player.inputQueue.push(input);
      }
      else {
        player.inputQueue.push(input);
      }
    });
    // var self = this;
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
    ////////////////////////////////////////////////////////////////////////////
    this.world.step(fixedTimeStep);
    ////////////////////////////////////////////////////////////////////////////
    var self = this;
    Mob.updateMob(self);
    ////////////////////////////////////////////////////////////////////////////
    this.state.players.forEach(player => {
      let input: InputData;
      // dequeue player inputs
      while (input = player.inputQueue.shift()) {

        if (input.mobClick != '') {
          this.state.MobResult.forEach(element => {
            console.log(element.field_mob_name_value);
          });
          if (this.state.MobResult[input.mobClick] != undefined) {
            if (this.state.MobResult[input.mobClick].health > 0) {
              this.state.MobResult[input.mobClick].health -= 20;
              this.state.MobResult[input.mobClick].mass = 0;
              console.log(input.mobClick + "with " + this.state.MobResult[input.mobClick].health + "health, was attacked by " + player.playerId);
              if (this.state.MobResult[input.mobClick].health == 0) {
                console.log('zombie dead');
                // if mob is dead update health and dead and following
                Mob.updateZombieState(undefined, undefined, undefined,
                  undefined, 0, 0, 1, this.state.MobResult[input.mobClick], undefined
                )
                this.broadcast("zombie dead", this.state.MobResult[input.mobClick].field_mob_name_value);
                const promise1 = Promise.resolve(Bridge.updatePlayer(player.playerId, 'credits', 10, 0));
                promise1.then(() => {
                });
              }
              if (this.state.MobResult[input.mobClick].health < 0) {
                this.state.MobResult[input.mobClick].health = 0;
              }
              else {
                const promise1 = Promise.resolve(Bridge.updatePlayer(player.playerId, 'credits', 1, 0));
                promise1.then(() => {
                });
              }
              Mob.updateZombieState(
                this.state.MobResult[input.mobClick].field_mobs_target_id, this.state.MobResult[input.mobClick].field_mob_name_value,
                undefined, undefined, undefined, undefined, undefined, this.state.MobResult[input.mobClick], undefined
              )
            }
          }
        }
////////////////////////////////////////////////////////////////////////////////

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
        ////////////////////////////////////////////////////////////////////////////////
        //
        ////////////////////////////////////////////////////////////////////////////////

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

  async updateMobForce(i) {
    await this.skip(2000);
    var forceX = (Math.ceil(Math.random() * 50) + 20) * (Math.round(Math.random()) ? 1 : -1);
    var forceY = (Math.ceil(Math.random() * 50) + 20) * (Math.round(Math.random()) ? 1 : -1);
    if (this.P2mobBodies[i].dead != 1) {
      this.P2mobBodies[i].destinationX = forceX;
      this.P2mobBodies[i].destinationY = forceY;
    }
    this.pause = 0;
  }

  skip(val) {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve('resolved');
      }, val);
    });
  }

  onJoin(client: Client, options: any) {
    console.log(client.sessionId, "joined!");
    console.log(options.playerId, "joined!");
    const player = new Player();
    var self = this;
    player.playerId = options.playerId;
    Bridge.getPlayer(options.playerId).then((result: any) => {
      this.result = result;
      return result;
    }).then((newResult: any) => {

      player.x = newResult[0].field_x_value;
      player.y = newResult[0].field_y_value;
      player.health = newResult[0].field_health_value;
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
      player.playerBody.health = player.health;
      player.playerBody.playerId = player.playerId;
      player.playerBody.isPlayer = true;
      player.playerBody.motionState = 2; //STATIC
      player.playerBody.collideWorldBounds = true;
      player.playerBody.addShape(playerShape);
      player.playerBody.clientID = client.sessionId;
      this.state.players.set(client.sessionId, player);
      console.log(player.playerBody.health, "health!");
      this.world.addBody(player.playerBody);
    }).catch(function () {
      console.log('shit');
    });
  }

  onLeave(client: Client, consented: boolean) {
    console.log(client.sessionId, "left!");
    this.state.players.delete(client.sessionId);
  }

  onStateChange(state) {
    console.log(this.roomId, "has new state:", state);
  }

  onDispose() {
    console.log("room", this.roomId, "disposing...");
  }

  async loadP2Player(player: any, clientID: any) {
    const p2Player = await import("./P2player");
    const PBody = p2Player.placePlayer(this.share, player);
    return PBody;
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
      }
    }).catch(function () {
      console.log('Portal shit');
    });
  }

  async loadNpcs(nodeNumber: number) {
    const Npc = await import("./npc");
    var self = this;
    Bridge.getNpcs(nodeNumber).then((result: any) => {
      this.state.NpcResult = result;
      return result;
    }).then((newResult: any) => {
      for (let i = 0; i < newResult.length; i++) {
        self.world.addBody(Npc.placeNpc(newResult[i], this.share));
      }
    }).catch(function () {
      console.log('NPC shit');
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
      }
    }).catch(function () {
      console.log('shit');
    });
  }

  loadMaps(nodeName: string) {
    var cityName = nodeName.split("-")[0];
    var cityNumber = nodeName.split("-")[1];
    try {
      const data = require(`../../../../../assets/cities/` + cityName + `/json/` + cityNumber + `.json`);
      return data;
    } catch (err) {
      console.log(err);
      console.log('shit');
    }
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
        }
      }
    }

    this.world.on('impact', (evt: any) => {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      if (bodyA.isPortal) {
        if (!bodyA.done) {
          console.log('Portal!!!!');
          console.log('tiled: ' + bodyA.tiled);
          console.log('playerId: ' + bodyB.playerId);
          const promise1 = Promise.resolve(Bridge.updateMap(bodyB.playerId, bodyA.destination));
          promise1
            .then(() => { bodyB.portal = bodyA.tiled; })
            .then(() => {
              console.log(bodyA.destination_x);
              Bridge.updatePlayer(bodyB.playerId, 'x', bodyA.destination_x, 1)
            })
            .then(() => {
              console.log(bodyA.destination_y);
              Bridge.updatePlayer(bodyB.playerId, 'y', bodyA.destination_y, 1)
            });
          bodyA.done = true;
        }
      }
      if (bodyA.isReward) {
        if (!bodyA.done) {
          const promise1 = Promise.resolve(Bridge.updatePlayer(bodyB.playerId, 'credits', 1, 0));
          promise1.then(() => { });
          const promise2 = Promise.resolve(Bridge.updatePlayer(bodyB.playerId, 'experience', 1, 0));
          promise2.then(() => { });
          this.broadcast("remove-reward", bodyA.ref);
          bodyB.reward = bodyA.ref;
          bodyA.done = true;
        }
      }
      if (bodyA.isMob && bodyA.dead == 0) {
        //  if (!bodyA.done) {
        console.log('Mobstrike!!!!');
        console.log('playerId: ' + bodyB.playerId);
        console.log('health: ' + bodyB.health);
        bodyB.struck = true;
        const promise1 = Promise.resolve(Bridge.updatePlayer(bodyB.playerId, 'health', -10, false));

        promise1.then(() => {
          bodyB.health = bodyB.health - 10;

          if (bodyB.health <= 0) {
            //bodyB.health = 0;
            const promise1 = Promise.resolve(Bridge.updatePlayer(bodyB.playerId, 'health', 80, true));
            this.broadcast("dead", bodyB.playerId);
          }
        });
        //When zombie is dead set dead health  and following
        Mob.updateZombieState(
          bodyA.field_mobs_target_id, bodyA.field_mob_name_value, parseInt(bodyA.position[0]), parseInt(bodyA.position[1]),
          0, 0, 1, undefined, undefined)

        this.broadcast("player hit", bodyA.field_mob_name_value); // TODO change to player name

        bodyB.mobHit = bodyA.mob_name;
        //bodyA.done = true;
        //     }
      }
    })
    ///////////////////////////////////////////////////////////////////////////
    this.world.on('beginContact', function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      console.log('Begin Contact');
      if (bodyA.isPlayer) {
        /*        console.log('endContact! --------------------------------------------------------------');
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

    this.world.on("endcontact", function (evt: any) {
      var bodyA = evt.bodyA;
      var bodyB = evt.bodyB;
      console.log('-----------End Contact--- Pay Attention---');
    });
  }
}
