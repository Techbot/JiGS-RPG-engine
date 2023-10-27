import { Room, Client } from "colyseus";
const db = require("../services/db");
import { InputData, MyRoomState, Player, ZombieState } from "./GameState";
var Bridge = require('../services/bridge.ts');
var p2 = require('p2');
const fs = require('fs');
import { P2player } from "./P2player";
import { Mob } from "./Mobs";
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
  p2player: P2player;
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

  Mobs: Mob;
  Npc: typeof import("z:/web/modules/custom/jigs/server/rooms/npc");
  Portal: typeof import("z:/web/modules/custom/jigs/server/rooms/portal");
  Reward: typeof import("z:/web/modules/custom/jigs/server/rooms/reward");
  Collisions: typeof import("z:/web/modules/custom/jigs/server/rooms/collisions");
  Layers: typeof import("z:/web/modules/custom/jigs/server/rooms/layers");

  constructor() {
    super();
    this.world = new p2.World({ gravity: [0, 0] });
    this.P2mobBodies = [];
    this.Mobs = new Mob;
  }

  async onCreate(options: any) {
    this.Npc = await import("./npc");
    this.Portal = await import("./portal");
    this.Reward = await import("./reward");
    this.Collisions = await import("./collisions");
    this.Layers = await import("./layers");
    this.indexNumber = 1;
    this.setState(new MyRoomState());
    this.Portal.load(this.world, options.nodeNumber, this.share);
    this.Reward.load(this.world, options.nodeNumber, this.share);
    this.Npc.load(this.world, options.nodeNumber, this.share);
    this.Layers.addLayers(options.nodeName, this.share);
    this.Mobs.load(this, options.nodeNumber, this.share);
    this.state.mapWidth = 1900;
    this.state.mapHeight = 1900;
    this.onMessage(0, (client, input) => {
      const player = this.state.players.get(client.sessionId);
      if (player.p2Player.playerBody.portal) {
        client.send("portal", player.playerBody.portal);
        player.playerBody.portal = false;
      }
      else if (player.p2Player.playerBody.collide) {
        client.send("collide", player.playerBody.collide);
        player.playerBody.collide = false;
      }
      else if (player.p2Player.playerBody.struck) {
        client.send("struck", player.playerBody.health);
        player.playerBody.struck = false;
      }
      else if (player.p2Player.playerBody.dead) {
        client.send("dead", player);
        player.playerBody.dead = false;
      }
      else if (player.p2Player.playerBody.reward) {
        client.send("reward", player.playerBody.reward);
        player.playerBody.reward = false;
        player.inputQueue.push(input);
      }
      else {
        player.inputQueue.push(input);
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
    this.Mobs.updateMob(this);
    this.state.players.forEach(player => {
      let input: InputData;
      // dequeue player inputs
      while (input = player.inputQueue.shift()) {
        if (this.Mobs.mobClicked(this, input, player) == 1) {
          this.broadcast("zombie dead", this.state.mobResult[input.mobClick].field_mob_name_value);
        }
        player.p2Player.updatePlayer(input, player, velocity);
        player.tick = input.tick;
      }
    });
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
  //  var self = this;
    player.playerId = options.playerId;
    player.p2Player = new P2player(player.playerId, this.share);
    player.x = player.p2Player.playerBody.position[0];
    player.y = player.p2Player.playerBody.position[1];
    this.state.players.set(client.sessionId, player);
    this.world.addBody(player.p2Player.playerBody);
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
}
