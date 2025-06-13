///////////////////////////////////////////////////////////////////////////////
//
// JiGS ColyseusJs Server
//////////////////////////////////////////////////////////////////////////////
import { JWT } from "@colyseus/auth";
import { Room, Client, ServerError } from "colyseus";
import { InputData, MyRoomState, Player, PlayerMap, ZombieState } from "./GameState";

// var roomModel = require('../models/room.ts');

const p2 = require('p2');
const fs = require('fs');
import { P2player } from "./P2player";
import { Mob } from "./Mobs";
import { Portal } from "./Portals";
import { Switch } from "./Switches";
import { Wall } from "./Walls";
import { Npc } from "./Npcs";
//import { Boss } from "./Bosses";

import { Reward } from "./Rewards";
import { Layer } from "./Layers";
import { Collision } from "./Collisions";

export class PreRoom extends Room<MyRoomState> {

  maxClients = 4;

  fixedTimeStep = 1000 / 60;
  speedMultiplier = 1; // 20;
  share = {
    SPEED: (1 * this.speedMultiplier),
    // collisions:a
    COL_PLAYER: Math.pow(2, 0),
    COL_ENEMY: Math.pow(2, 1),
    COL_GROUND: Math.pow(2, 2)
  };

  colors = { '6': 14153173, '7': 15153173, '8': 12153173, '9': 16701904 };
  result: any;
  world: any;
  p2player: P2player;
  playerShape: any;
  //Body: any;
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
  P2bossBodies: any;
  Mobs: Mob;
  Portals: Portal;
  Switches: Switch;
  Walls: Wall;
  Npcs: Npc;
  //Bosses: Boss;
  Rewards: Reward;
  Collisions: Collision;
  Layers: Layer;

  constructor() {
    super();
    //  this.world = new p2.World({ gravity: [0, 0] });
    //  this.P2mobBodies = [];
    // this.P2bossBodies = [];
    //this.Mobs = new Mob;
    // this.Portals = new Portal;
    //this.Switches = new Switch;
    //this.Walls = new Wall;
    //this.Rewards = new Reward;
    //this.Npcs = new Npc;
    //this.Bosses = new Boss;
    // this.Layers = new Layer;

    // this.Collisions = new Collision;
  }
  /*
    async onAuth(client, options, request) {

      const userData = await this.checkAccess(client, options, this.state.playerMap);
      if (userData) {
        return userData;

      } else {
        throw new ServerError(400, "bad access token");
      }
    } */

  static onAuth(token: string) {
    return JWT.verify(token);

  }

  async onCreate(options: any) {

    this.indexNumber = 1;
    this.setState(new MyRoomState());

    //  await this.Mobs.load(this, options.nodeNumber, this.share);
    //  await this.Bosses.load(this, options.nodeNumber, this.share);
    //   await this.Portals.load(this.world, options.nodeNumber, this.share);
    //await this.Switches.load(this.world, options.nodeNumber, this.share);
    //   await this.Walls.load(this.world, options.nodeNumber, this.share);
    //   await this.Rewards.load(this.world, options.nodeNumber, this.share);
    //   await this.Npcs.load(this.world, options.nodeNumber, this.share);
    //await this.Layers.load(options.nodeName, this.share);
    //    await this.Collisions.add(this);

    /*     await roomModel.getRoom().then((result: any) => {

          console.log('-----Pre Room ---------' );

        }).catch(function (err) {
          console.log('room error' + err)
        }); */

    this.onMessage(0, (client, input) => {
      //  console.log('yo');
      const player = this.state.players.get(client.sessionId);
      if (player.p2Player.Body.portal) {

        console.log('send portal message' + player.p2Player.Body.portal);

        client.send("portal", player.p2Player.Body.portal);
        player.p2Player.Body.portal = false;

      }
      else if (player.p2Player.Body.collide) {
        client.send("collide", player.p2Player.Body.collide);
        player.p2Player.Body.collide = false;
      }
      else if (player.p2Player.Body.struck) {
        client.send("struck", player.p2Player.Body.health);
        player.p2Player.Body.struck = false;
      }
      else if (player.p2Player.Body.dead) {
        client.send("dead", player);
        player.p2Player.Body.dead = false;
      }
      else if (player.p2Player.Body.reward) {
        client.send("reward", player.p2Player.Body.reward);
        player.p2Player.Body.reward = false;
        player.inputQueue.push(input);
      }
      else {
        player.inputQueue.push(input);
      }
    });

    /* //remove
        this.onMessage("move", (client, message) => {
          const player = this.state.players.get(client.sessionId);
          player.position.x = message.x;
          player.position.y = message.y;
        }); */


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
    //   this.world.step(fixedTimeStep);
    //  this.Mobs.updateMob(this);
    // this.Bosses.updateBoss(this);

    this.state.players.forEach(player => {
      let input: InputData;
      // dequeue player inputs
      while (input = player.inputQueue.shift()) {
        if (this.Mobs.mobClicked(this, input, player) == 1) {
          const mobResult = this.state.mobResult.get(input.mobClick);
          if (mobResult) {
            this.broadcast("zombie dead", mobResult.field_mob_name_value);
          } else {
            console.error(`Mob result for key ${input.mobClick} not found.`);
          }
        }
        player.p2Player.update(input, player, velocity);
        player.tick = input.tick;
      }
    });
  }

  skip(val: any) {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve('resolved');
      }, val);
    });
  }
  ////////////////////////////////////////////////////////////////////////////////



  /////////////////////////////////////////////////////////////////////////////////
  async onJoin(client: Client, options: any) {
    const player = new Player();
    player.channelId = options.channelId;
    player.playerUuid = options.playerUuid;
    player.playerId = options.playerId;
    player.playerName = options.playerName;

    // @TODO Why are these lines here?
    player.p2Player = new P2player(player.playerUuid);
    await player.p2Player.load(this.share, player);
    //this.world.addBody(player.p2Player.Body);

    const playerMap = new PlayerMap();
    playerMap.profileId = options.profileId;

    this.state.players.set(client.sessionId, player);
    this.state.playerMap.set(client.sessionId, playerMap)
  }
  ////////////////////////////////////////////////////////////////////////////////
  onLeave(client: Client, consented: boolean) {
    console.log(client.sessionId, "left!");
    /*     this.state.players.delete(client.sessionId);
        this.state.playerMap.delete(client.sessionId); */

  }

  onStateChange(state: any) {
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
    //  Usually you would use a collision mask for something this simple, but it demonstrates use.
    /*     if ((body1.sprite.name === 'ship' && body2.sprite.frame === 4) || (body2.sprite.name === 'ship' && body1.sprite.frame === 4)) {
          console.log('Bilbo Baggins')
          return false;
        } */
    console.log('Frodo Baggins')
    return true;
  }
}
