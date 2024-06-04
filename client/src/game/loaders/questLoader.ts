

/**
 * -------questLoader ---------
 */

import { useJigsStore } from '../../stores/jigs';

export default class QuestLoader {

  jigs: any;

  constructor() {
    this.jigs = useJigsStore();
  }

  add(scene) {
    console.log("------------Quest Loader---------------")

    if (this.jigs.questsArray) {
      this.jigs.questsArray.forEach(function loader(questsItem) {
        scene.load.spritesheet('quest_' + questsItem.id, '/assets/images/quest/' + questsItem.file + '.png',
          { frameWidth: questsItem.frameWidth, frameHeight: questsItem.frameHeight });
      });
    }

  }
}
