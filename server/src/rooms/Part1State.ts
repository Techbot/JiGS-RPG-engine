import { Schema, type, MapSchema } from "@colyseus/schema";

export class Player extends Schema {
  @type("number") x: number;
  @type("number") y: number;
}

export class Part1State extends Schema {
  @type("number") mapWidth: number;
  @type("number") mapHeight: number;

  @type({ map: Player }) players = new MapSchema<Player>();
}
