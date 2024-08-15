///////////////////////////////////////////////////////////////////////////////
//
// JiGS ColyseusJs Server
//////////////////////////////////////////////////////////////////////////////
import { Room, Client, ServerError } from "colyseus";
const db = require("../services/db");
import { InputData, MyRoomState, Player, PlayerMap, ZombieState } from "./GameState";

var roomModel = require('../models/room.ts');

var p2 = require('p2');
const fs = require('fs');
import { P2player } from "./P2player";
import { Mob } from "./Mobs";
import { Portal } from "./Portals";
import { Switch } from "./Switches";
import { Wall } from "./Walls";
import { Npc } from "./Npcs";
import { Bosses } from "./Bosses";
import { Reward } from "./Rewards";
import { Layer } from "./Layers";
import { Collision } from "./Collisions";

export class GameRoom extends Room<MyRoomState> {
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
  Bosses: Bosses;
  Rewards: Reward;
  Collisions: Collision;
  Layers: Layer;

  constructor() {
    super();
    this.world = new p2.World({ gravity: [0, 0] });
    this.P2mobBodies = [];
    this.P2bossBodies = [];
    this.Mobs = new Mob;
    this.Portals = new Portal;
    this.Switches = new Switch;
    this.Walls = new Wall;
    this.Rewards = new Reward;
    this.Npcs = new Npc;
    this.Bosses = new Bosses;
    this.Layers = new Layer;
    this.Collisions = new Collision;
  }

  async onAuth(client, options, request) {

  //  return true;

    const loggedInTest = await this.checkAccess(client, options, this.state.playerMap);
    if (loggedInTest) {
      return loggedInTest;

    } else {
      throw new ServerError(400, "You are already logged in elsewhere.");
    }
  }

  async onCreate(options: any) {
    this.indexNumber = 1;
    this.setState(new MyRoomState());
    await this.Mobs.load(this, options.nodeNumber, this.share);
    await this.Bosses.load(this, options.nodeNumber, this.share);
    await this.Portals.load(this.world, options.nodeNumber, this.share);
    //await this.Switches.load(this.world, options.nodeNumber, this.share);
    await this.Walls.load(this.world, options.nodeNumber, this.share);
    await this.Rewards.load(this.world, options.nodeNumber, this.share);
    await this.Npcs.load(this.world, options.nodeNumber, this.share);
    //await this.Layers.load(options.nodeName, this.share);
    await this.Collisions.add(this);

    await roomModel.getRoom(options.nodeNumber).then((result: any) => {
      this.state.mapWidth = result[0].field_map_width_value * 16;
      this.state.mapHeight = result[0].field_map_height_value * 16;
      this.state.missionAccepted = result[0].field_mission_accepted_target_id;
      console.log('-----MA---------' + this.state.missionAccepted);

    }).catch(function (err) {
      console.log('room error' + err)
    });

    this.onMessage(0, (client, input) => {
      const player = this.state.players.get(client.sessionId);
      if (player.p2Player.Body.portal) {
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
    let elapsedTime = 0;
    this.setSimulationInterval((deltaTime) => {
      elapsedTime += deltaTime;
      while (elapsedTime >= this.fixedTimeStep) {
        elapsedTime -= this.fixedTimeStep;
        this.fixedTick(this.fixedTimeStep);
      }
    });
  }

  checkAccess(client, options, playerMap) {
    if (playerMap.size == 0) {
      console.log('no people');
      return true
    } else {
      playerMap.forEach((value, key) => {
        console.log("value" + value.profileId);

        if (value.profileId == options.profile_id) {
          console.log('Access failed');
          return false;
        }
        //  console.log('client.id:' + client.id);
        //  console.log(options);
        //  this.p2player.getUnlockedRooms();
        console.log('Access Checked');
        return true;

      })
    }
  }

  //////////////////////////////////////////////////////////////////////////////
  async onJoin(client: Client, options: any) {
    console.log(client.sessionId, "joined!");
    console.log(options.playerId, "joined!");
    console.log(options.profileId, "joined!");

    const player = new Player();
    player.playerId = options.playerId;
    player.profileId = options.profileId;
    player.p2Player = new P2player();

    const playerMap = new PlayerMap();
    playerMap.profileId = options.profileId;

    await player.p2Player.load(player.playerId, this.share, player, client, this);
    this.world.addBody(player.p2Player.Body);
    this.state.players.set(client.sessionId, player);
    this.state.playerMap.set(client.sessionId, playerMap)
  }
  //////////////////////////////////////////////////////////////////////////////
  onLeave(client: Client, consented: boolean) {
    console.log(client.sessionId, "left!");
    this.state.players.delete(client.sessionId);
    this.state.playerMap.delete(client.sessionId);
  }

  onStateChange(state) {
    console.log(this.roomId, "has new state:", state);
  }

  onDispose() {
    console.log("room", this.roomId, "disposing...");
  }

  fixedTick(timeStep: number) {
    const velocity = 2;
    var fixedTimeStep = 1 / 60;
    this.world.step(fixedTimeStep);
    this.Mobs.update(this);
    this.Bosses.update(this);
    this.state.players.forEach(player => {
      let input: InputData;

      // dequeue player inputs
      while (input = player.inputQueue.shift()) {

        if (this.Mobs.mobClicked(this, input, player) == 1) {
          this.broadcast("zombie dead", this.state.mobResult[input.mobClick].field_mob_name_value);
        }
    //    if (this.Bosses.mobClicked(this, input, player) == 1) {
    //      this.broadcast("zombie dead", this.state.mobResult[input.mobClick].field_mob_name_value);
    //    }

        player.p2Player.update(this, input, player, velocity);
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
