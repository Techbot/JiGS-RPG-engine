/**
 * ------- Sword ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
export default class Sword extends Phaser.Physics.Arcade.Sprite {
  jigs: any;
  angle: any;

  constructor(scene, x, y, sprite) {
    super(scene, x, y, sprite)
    this.scene = scene;
    this.x = x;
    this.y = y;
    this.jigs = useJigsStore();
  }

  strike(currentPlayer) {
    if (currentPlayer.dir == 'left') {
      currentPlayer.play('player-slashLeft-glowsword');
      if (currentPlayer.speed == 'go') {
        currentPlayer.playAfterRepeat('player-walkLeft-' + 'glowsword');
      }
    }
    else if (currentPlayer.dir == 'right') {
      currentPlayer.play('player-slashLeft-glowsword');
      if (currentPlayer.speed == 'go') {
        currentPlayer.playAfterRepeat('player-walkRight-' + 'glowsword');
      }
    }
    else if (currentPlayer.dir == 'up') {
      currentPlayer.play('player-slashUp-glowsword');
      if (currentPlayer.speed == 'go') {
        currentPlayer.playAfterRepeat('player-walkUp-' + 'glowsword');
      }
    }
    else if (currentPlayer.dir == 'down') {
      currentPlayer.play('player-slashDown-glowsword');
      if (currentPlayer.speed == 'go') {
        currentPlayer.playAfterRepeat('player-walkDown-' + 'glowsword');
      }
    }
    else {
      currentPlayer.play('player-slashDown-glowsword');
    }
  }

  getAngle(event) {
    this.angle = Math.atan2(parseInt(event.worldY) - this.y, parseInt(event.worldX) - this.x) * 180 / Math.PI;
  }

  loadGun(sprite) {
    console.log('gun added' + sprite);
  }

}
