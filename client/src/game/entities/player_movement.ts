/**
 * -------Player Movement---------
 */

import { Game } from 'phaser';
import { useJigsStore } from '../../stores/jigs';

export default class PlayerMovement {

  jigs: any;
  scene: any;

  constructor(scene) {
    this.jigs = useJigsStore();
    this.scene = scene;
  }
  move(currentPlayer, velocity, colliderMap) {

    if (!this.scene.inputPayload.left && !this.scene.inputPayload.right &&
      !this.scene.inputPayload.up && !this.scene.inputPayload.down &&
      currentPlayer.speed != 'stopped') {
      currentPlayer.anims.play('stop_' + this.jigs.playerStats.sprite_sheet);
      currentPlayer.speed = 'stopped';
      currentPlayer.dir = 'stopped';
      currentPlayer.setVelocityX(0);
      currentPlayer.setVelocityY(0);

    }

    if (this.scene.inputPayload.down) {
      const tile = colliderMap.getTileAtWorldXY(currentPlayer.x, currentPlayer.y + 16, true);
      if (tile) {
        currentPlayer.setVelocityY(velocity);
      }
      else {
        currentPlayer.y += velocity;
      }
      if (currentPlayer.dir != 'down') {
        currentPlayer.anims.play('walkDown_' + this.jigs.playerStats.sprite_sheet);
        currentPlayer.dir = 'down';
        currentPlayer.speed = 'go';
      }
    }
    else if (this.scene.inputPayload.up) {
      const tile = colliderMap.getTileAtWorldXY(currentPlayer.x, currentPlayer.y - 16, true);
      if (tile) {
        currentPlayer.setVelocityY(-velocity);
      }
      else {
        currentPlayer.y -= velocity;
      }
      if (currentPlayer.dir != 'up') {
        currentPlayer.anims.play('walkUp_' + this.jigs.playerStats.sprite_sheet);
        currentPlayer.dir = 'up';
        currentPlayer.speed = 'go';
      }
    }
    else if (this.scene.inputPayload.right) {
      const tile = colliderMap.getTileAtWorldXY(currentPlayer.x + 16, currentPlayer.y, true);
      if (tile) {
        currentPlayer.setVelocityX(velocity);
      }
      else {
        currentPlayer.x += velocity;
      }
      if (currentPlayer.dir != 'right') {
        currentPlayer.anims.play('walkRight_' + this.jigs.playerStats.sprite_sheet);
        currentPlayer.dir = 'right';
        currentPlayer.speed = 'go';
      }
    }
    else if (this.scene.inputPayload.left) {
      const tile = colliderMap.getTileAtWorldXY(currentPlayer.x - 16, currentPlayer.y, true);
      if (tile) {
        currentPlayer.setVelocityX(-velocity);
      }
      else {
        currentPlayer.x -= velocity;
      }
      if (currentPlayer.dir != 'left') {
        currentPlayer.anims.play('walkLeft_' + this.jigs.playerStats.sprite_sheet);
        currentPlayer.dir = 'left';
        currentPlayer.speed = 'go';
      }
    }

    if (currentPlayer.speed == 'go') {
      //console.log('play');
      if (!this.scene.walkSound.isPlaying) {
        this.scene.walkSound.play();
      }
    }
  }
}
