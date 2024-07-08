/**
 * -------Other Player ---------
 */

import Phaser from "phaser";
/* import Drones from "../entities/drones.ts";
import Gun from "./gun.ts";
import Sword from "./sword.ts";
import Light from "./light.ts"; */

//import PlayerMovement from "./player_movement.ts";
import { useJigsStore } from '../../stores/jigs.ts';

export default class OtherPlayer {
  entity: any;
  lastDirection: string | undefined;
  scene: Phaser.Scene;
  player: {
    username?: any; x: any; y: any; onChange: (arg0: () => void) => void; discordName: any; direction: any;
  };

  constructor(scene: Phaser.Scene, player: { username?: any, x: any; y: any; onChange: (arg0: () => void) => void; discordName: any; direction: any; }) {
    this.scene = scene;
    this.player = player;
    this.lastDirection = undefined;
  }

  add() {
    const hsv = Phaser.Display.Color.HSVColorWheel();
    const i = Phaser.Math.Between(0, 359);

    this.entity = this.scene.physics.add.sprite(this.player.x, this.player.y, 'otherPlayer')
      .setDepth(5)
      .setScale(.85);
    this.entity.setTint(hsv[i].color);
    // listening for server updates
    this.player.onChange(() => {
      //
      // we're going to LERP the positions during the render loop.
      //
      this.entity.setData('serverX', this.player.x);
      this.entity.setData('serverY', this.player.y);
      this.entity.setData('discordName', this.player.username);
      this.entity.setData('serverDirection', this.player.direction);

    });
  }

  update() {
    if (this.entity.data) {
      const { serverX, serverY, serverDirection, discordName } = this.entity.data.values;
      this.entity.x = Phaser.Math.Linear(this.entity.x, serverX, 0.2);
      this.entity.y = Phaser.Math.Linear(this.entity.y, serverY, 0.2);
      //  entity.direction = serverDirection;
      console.log('************************** discordName ' + discordName);
      console.log('************************** direction ' + serverDirection);

      this.updateDirection(serverDirection);
    }
  }

  updateDirection(serverDirection: string | undefined) {
    if (serverDirection == this.lastDirection || serverDirection == undefined) { return; }
    this.entity.anims.play('player-walk' + serverDirection + '-glowsword');
    this.lastDirection = serverDirection;
  }

}
