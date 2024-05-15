/**
 * -------mobLoader ---------
 */

import { useJigsStore } from '../../stores/jigs';

export default class MobLoader{

  jigs: any;

  constructor() {
    this.jigs = useJigsStore();
  }

 add(scene){
  console.log("------------------------------------")
      if (this.jigs.mobArray) {
        this.jigs.mobArray.forEach(function loader(Mob) {
          scene.load.spritesheet('Zombie-Green-walk-default', '/assets/images/animator/Zombie-Green/walk-default.png', { frameWidth: 64, frameHeight: 64 });
          scene.load.spritesheet('Zombie-Green-hurt-default', '/assets/images/animator/Zombie-Green/hurt-default.png', { frameWidth: 64, frameHeight: 64 });
        }, this);
      }
    }
}
