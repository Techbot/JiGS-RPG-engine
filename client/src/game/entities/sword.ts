/**
 * ------- Sword ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';


export default class Sword extends Phaser.Physics.Arcade.Sprite {
  jigs: any;
  angle: any;


  constructor(scene, x, y,sprite) {
    super(scene, x, y, sprite)
    this.x = x;
    this.y = y;
    this.jigs = useJigsStore();
  }

  strike(self) {

    if (self.currentPlayer.dir == 'left') {
      self.currentPlayer.play('thrustLeft_' + self.jigs.playerStats.sprite_sheet + '_slash');
      if (self.currentPlayer.speed == 'go') {
        self.currentPlayer.playAfterRepeat('walkLeft_' + self.jigs.playerStats.sprite_sheet);
      }
    }
    else if (self.currentPlayer.dir == 'right') {
      self.currentPlayer.anims.play('thrustRight_' + self.jigs.playerStats.sprite_sheet + '_slash');
      if (self.currentPlayer.speed == 'go') {
        self.currentPlayer.playAfterRepeat('walkRight_' + self.jigs.playerStats.sprite_sheet);
      }
    }
    else if (self.currentPlayer.dir == 'up') {
      self.currentPlayer.anims.play('thrustUp_' + self.jigs.playerStats.sprite_sheet + '_slash');
      if (self.currentPlayer.speed == 'go') {
        self.currentPlayer.playAfterRepeat('walkUp_' + self.jigs.playerStats.sprite_sheet);
      }
    }
    else if (self.currentPlayer.dir == 'down') {
      self.currentPlayer.anims.play('thrustDown_' + self.jigs.playerStats.sprite_sheet + '_slash');
      if (self.currentPlayer.speed == 'go') {
        self.currentPlayer.playAfterRepeat('walkDown_' + self.jigs.playerStats.sprite_sheet);
      }
    }
    else {
      self.currentPlayer.anims.play('thrustDown_' + self.jigs.playerStats.sprite_sheet + '_slash');
    }

  }

  getAngle(event) {
    this.angle = Math.atan2(parseInt(event.worldY) - this.y, parseInt(event.worldX) - this.x) * 180 / Math.PI;
  }

  loadGun(sprite) {
    console.log('gun added' + sprite);
  }

}
