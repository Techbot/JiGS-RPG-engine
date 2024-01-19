/**
 * -------NPCs ---------
 */
import Npc from "./npc";
import { useJigsStore } from '../../stores/jigs';
import axios from "axios";

export default class NPCs {
  jigs: any;
  npcGroup: any;
  NpcContainerArray: any;
  SceneNpcArray: any;
  SceneNpcNameArray: any;

  constructor() {
    this.jigs = useJigsStore();
    this.NpcContainerArray = new Array;
    this.SceneNpcArray = new Array;
    this.SceneNpcNameArray = new Array;
  }

  add(self) {
    self.npcGroup = self.physics.add.group({ allowGravity: false });
    if (typeof this.jigs.npcArray !== 'undefined') {
      let i = 0;
      while (i < this.jigs.npcArray.length) {
        this.NpcContainerArray[i] = self.add.container(parseInt(this.jigs.npcArray[i][1]), parseInt(this.jigs.npcArray[i][2]));
        this.SceneNpcArray[i] = new Npc(self, this.jigs.npcArray[i]);

        this.SceneNpcNameArray[i] = self.add.text(10, -10, this.jigs.npcArray[i][0], {
          font: "12px Neutron Demo",
          fill: 'white',
          fontStyle: 'strong',
          backgroundColor: 'rgba(0, 0, 0, 0.6)',
        }).setPadding({ left: 1, right: 1, top: 1, bottom: 1 });
        this.NpcContainerArray[i].add(this.SceneNpcArray[i]);
        this.NpcContainerArray[i].add(this.SceneNpcNameArray[i]);
        this.NpcContainerArray[i].setDepth(5);
        this.SceneNpcArray[i].anims.play('walkDown_npc' + this.jigs.npcArray[i][3]);
        self.npcGroup.add(this.NpcContainerArray[i], true);
        console.log("add container " + this.jigs.npcArray[i][0]);
        i++;
      }
    }
  }
  onNPCDown(npc, self) {
    if (npc[5] == 1) {
      axios
        .get("/mymission?_wrapper_format=drupal_ajax&npc=" + npc[6])
        .then((response) => {
          console.log("");
          self.scene.hydrateMission(response);
          self.scene.events.emit('Mission', npc);
          //   this.game.scene.start("main", 'myScene');
        })
    }
    else {
      console.log("" + npc[5]);
      this.jigs.npc = 1;
      this.jigs.content = npc[4];
      self.events.emit('content');
    }
  }
}
