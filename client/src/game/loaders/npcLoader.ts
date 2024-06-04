

/**
 * -------npcLoader ---------
 */

import { useJigsStore } from '../../stores/jigs';

export default class NpcLoader {

  jigs: any;

  constructor() {
    this.jigs = useJigsStore();
  }

  add(scene) {
    console.log("------------NPC Loader---------------")

    if (this.jigs.npcArray) {
      this.jigs.npcArray.forEach(function loader(Npc) {
        scene.load.spritesheet('npc' + Npc[3], '/assets/images/sprites/' + Npc[3] + '.png', { frameWidth: 64, frameHeight: 64 });
      }, this);
    }
  }
}
