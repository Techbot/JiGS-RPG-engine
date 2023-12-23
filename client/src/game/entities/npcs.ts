import Npc from "./npc";
import { useJigsStore } from '../../stores/jigs';

export default class Mobs {
  jigs: any;

  constructor() {
    this.jigs = useJigsStore();
  }

  add(self) {
    self.npcGroup = self.physics.add.group({ allowGravity: false });
    if (typeof this.jigs.npcArray !== 'undefined') {
      let i = 0;
      while (i < this.jigs.npcArray.length) {
        self.NpcContainerArray[i] = self.add.container(parseInt(this.jigs.npcArray[i].x), parseInt(this.jigs.npcArray[i].y));

        /*         self.SceneNpcArray[i] = self.add.sprite(0, 0, 'npc' + this.jigs.npcArray[i][3])
                  .setScale(.85)
                  .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
                  .setData("levelindex", this.jigs.npcArray[i][1])
                  .on('pointerdown', self.onNPCDown.bind(this, this.jigs.npcArray[i])); */

        self.SceneNpcArray[i] = new Npc(self, this);

        self.SceneNpcNameArray[i] = self.add.text(10, -10, this.jigs.npcArray[i][0], {
          font: "12px Neutron Demo",
          fill: 'white',
          fontStyle: 'strong',
          backgroundColor: 'rgba(0, 0, 0, 0.6)',
        }).setPadding({ left: 1, right: 1, top: 1, bottom: 1 });

        self.NpcContainerArray[i].add(self.SceneNpcArray[i]);
        self.NpcContainerArray[i].add(self.SceneNpcNameArray[i]);
        //this.NpcContainerArray[i].setDepth(5);
        self.SceneNpcArray[i].anims.play('walkDown_npc' + this.jigs.npcArray[i][3]);
        self.npcGroup.add(self.NpcContainerArray[i], true);
        i++;
      }
    }
  }
}
