import { Room, Client } from "colyseus";
const db = require("../services/db");
const Mob = require("./mob");
const p2Player = await import("./P2player");
import { InputData, MyRoomState, Player } from "./GameState";
var Bridge = require('../services/bridge.ts');
var p2 = require('p2');
const fs = require('fs');
const Npc = await import("./npc");
const Portal = await import("./portal");
const Reward = await import("./reward");
const Collisions = await import("./collisions");
const Layers = await import("./layers");

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
    this.indexNumber = 1;
    this.setState(new MyRoomState());
    Portal.load(this.world, options.nodeNumber);
    Reward.load(this.world, options.nodeNumber);
    Npc.load(this.world,options.nodeNumber);
    Mob.load(this.world,options.nodeNumber );

    Layers.addLayers(options.nodeName);

    Collisions.addCollisions(this);
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

        if (Mob.mobClicked(input, player) == 1) {
          this.broadcast("zombie dead", this.state.MobResult[input.mobClick].field_mob_name_value);
        }
        ////////////////////////////////////////////////////////////////////////////////
        p2Player.updatePlayer(input, player, velocity);
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
    const player = new Player();
    player.playerId = options.playerId;
    player.playerBody = p2Player.placePlayer(this.share, player);
    this.state.players.set(client.sessionId, player);
    this.world.addBody(player.playerBody);

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

}
