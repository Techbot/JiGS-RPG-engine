import { Schema, Context, type, MapSchema } from "@colyseus/schema";

export interface InputData {
  left: false;
  right: false;
  up: false;
  down: false;
  inputX: number;
  inputY: number;
  tick: number;
  mobClick: string;
}

export class Player extends Schema {
  @type("number") x: number;
  @type("number") y: number;
  @type("number") tick: number;
  @type("number") mouseX: number;
  @type("number") mouseY: number;
  @type("number") health: number;

  inputQueue: InputData[] = [];
  P2: Promise<void>;
  id: string;
  portal: number;
  Body: any;
  playerId: number;
  profileId: number;
  lastX: number;
  lastY: number;
  p2Player: any;

}

export class ZombieState extends Schema {
  @type("number") field_mobs_target_id: number;
  @type("string") field_mob_name_value: string;
  @type("number") field_x_value: number;
  @type("number") field_y_value: number;
  @type("number") health: number;
  @type("number") following: number;
  @type("number") dead: number;
}
export class BossState extends Schema {
  @type("number") field_boss_target_id: number;
  @type("string") title: string;
  @type("number") x: number;
  @type("number") y: number;
  @type("number") health: number;
  @type("number") dead: number;
}

export class PlayerMap extends Schema {
  profileId: number;
}

export class MyRoomState extends Schema {
  npcResult: any;
  NpcResult: any;
  missionAccepted: number;

  @type("number") mapWidth: number;
  @type("number") mapHeight: number;

  @type({ map: ZombieState }) mobResult = new MapSchema<ZombieState>();
  @type({ map: BossState }) bossResult  = new MapSchema<BossState>();

  @type({ map: Player }) players = new MapSchema<Player>();
  @type({ map: PlayerMap }) playerMap = new MapSchema<PlayerMap>();

  destroySomething() {
    console.log('destroy all the things ');
  }
}
