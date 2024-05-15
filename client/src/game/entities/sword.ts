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
    this.scene = scene;
    this.x = x;
    this.y = y;
    this.jigs = useJigsStore();
  }

  strike(currentPlayer) {

    if (currentPlayer.dir == 'left') {

      //currentPlayer.play('thrustLeft_' + this.jigs.playerStats.sprite_sheet + '_slash');
      currentPlayer.play('player-slashLeft-glowsword');


      if (currentPlayer.speed == 'go') {
       // currentPlayer.playAfterRepeat('walkLeft_' + this.jigs.playerStats.sprite_sheet);
        currentPlayer.playAfterRepeat('player-walkLeft-' + 'glowsword');
      }
    }
    else if (currentPlayer.dir == 'right') {
      currentPlayer.play('player-slashLeft-glowsword');
    //  currentPlayer.anims.play('thrustRight_' + this.jigs.playerStats.sprite_sheet + '_slash');
      if (currentPlayer.speed == 'go') {
        currentPlayer.playAfterRepeat('player-walkRight-' + 'glowsword');
       // currentPlayer.playAfterRepeat('walkRight_' + this.jigs.playerStats.sprite_sheet);
      }
    }
    else if (currentPlayer.dir == 'up') {
     // currentPlayer.anims.play('thrustUp_' + this.jigs.playerStats.sprite_sheet + '_slash');
      currentPlayer.play('player-slashUp-glowsword');

      if (currentPlayer.speed == 'go') {
       // currentPlayer.playAfterRepeat('walkUp_' + this.jigs.playerStats.sprite_sheet);
        currentPlayer.playAfterRepeat('player-walkUp-' + 'glowsword');
      }
    }
    else if (currentPlayer.dir == 'down') {
     // currentPlayer.anims.play('thrustDown_' + this.jigs.playerStats.sprite_sheet + '_slash');
      currentPlayer.play('player-slashDown-glowsword');
      if (currentPlayer.speed == 'go') {
        //currentPlayer.playAfterRepeat('walkDown_' + this.jigs.playerStats.sprite_sheet);
        currentPlayer.playAfterRepeat('player-walkDown-' + 'glowsword');
      }
    }
    else {
     // currentPlayer.anims.play('thrustDown_' + this.jigs.playerStats.sprite_sheet + '_slash');
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
