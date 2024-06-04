/**
 * -------bossLoader ---------
 */

import { useJigsStore } from '../../stores/jigs';

export default class BossLoader {

  jigs: any;

  constructor() {
    this.jigs = useJigsStore();
  }

  add(scene) {
    console.log("---------------Boss Loader-------------")

    if (this.jigs.bossesArray) {
      this.jigs.bossesArray.forEach(function loader(boss) {
        scene.load.spritesheet('boss_' + boss.boss, '/assets/images/Level Bosses/' + boss.boss + '.png',
          { frameWidth: parseInt(boss.field_frame_width), frameHeight: parseInt(boss.field_frame_height) });
      });
    }
  }
}
