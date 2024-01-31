/**
 * -------Player Movement---------
 */

import { Game } from 'phaser';
import { useJigsStore } from '../../stores/jigs';

export default class PlayerMovement {

  jigs: any;
  scene: any;

  constructor(scene) {
    this.jigs  = useJigsStore();
    this.scene = scene;
  }
  move(self, velocity, colliderMap) {

    if (!self.inputPayload.left && !self.inputPayload.right &&
      !self.inputPayload.up && !self.inputPayload.down &&
      self.currentPlayer.speed != 'stopped') {
      self.currentPlayer.anims.play('stop_' + this.jigs.playerStats.sprite_sheet);
      self.currentPlayer.speed = 'stopped';
      self.currentPlayer.dir = 'stopped';
      self.currentPlayer.setVelocityX(0);
      self.currentPlayer.setVelocityY(0);

    }
    if (self.inputPayload.left) {
      const tile = colliderMap.getTileAtWorldXY(self.currentPlayer.x - 16, self.currentPlayer.y, true);
      if (tile) {
        self.currentPlayer.setVelocityX(-velocity);
      }
      else {
        self.currentPlayer.x -= velocity;
      }
      if (self.currentPlayer.dir != 'left') {
        self.currentPlayer.anims.play('walkLeft_' + this.jigs.playerStats.sprite_sheet);
        self.currentPlayer.dir = 'left';
        self.currentPlayer.speed = 'go';
      }
    }
    else if (self.inputPayload.right) {
      const tile = colliderMap.getTileAtWorldXY(self.currentPlayer.x + 16, self.currentPlayer.y, true);
      if (tile) {
        self.currentPlayer.setVelocityX(velocity);
      }
      else {
        self.currentPlayer.x += velocity;
      }
      if (self.currentPlayer.dir != 'right') {
        self.currentPlayer.anims.play('walkRight_' + this.jigs.playerStats.sprite_sheet);
        self.currentPlayer.dir = 'right';
        self.currentPlayer.speed = 'go';
      }
    }
    else if (self.inputPayload.up) {
      const tile = colliderMap.getTileAtWorldXY(self.currentPlayer.x, self.currentPlayer.y - 16, true);
      if (tile) {
        self.currentPlayer.setVelocityY(-velocity);
      }
      else {
        self.currentPlayer.y -= velocity;
      }
      if (self.currentPlayer.dir != 'up') {
        self.currentPlayer.anims.play('walkUp_' + this.jigs.playerStats.sprite_sheet);
        self.currentPlayer.dir = 'up';
        self.currentPlayer.speed = 'go';
      }
    }
    else if (self.inputPayload.down) {
      const tile = colliderMap.getTileAtWorldXY(self.currentPlayer.x, self.currentPlayer.y + 16, true);
      if (tile) {
        self.currentPlayer.setVelocityY(velocity);
      }
      else {
        self.currentPlayer.y += velocity;
      }
      if (self.currentPlayer.dir != 'down') {
        self.currentPlayer.anims.play('walkDown_' + this.jigs.playerStats.sprite_sheet);
        self.currentPlayer.dir = 'down';
        self.currentPlayer.speed = 'go';
      }

    }

    if (self.currentPlayer.speed == 'go') {
      console.log('play');
      if (!this.scene.walkSound.isPlaying) {
        this.scene.walkSound.play();
      }
    }
  }
}
