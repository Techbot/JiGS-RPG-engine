/**
 * ------- Mobs ---------
 */
import Mob from "./mob";
import { useJigsStore } from '../../stores/jigs';

export default class Mobs {
  jigs: any;
  walls: any;
  mobArray: any;
  SceneMobHealthBarArray: Array<any>;
  MobContainerArray: Array<any>;
  mobGroup: any;
  SceneMobArray: any;

  constructor() {
    this.jigs = useJigsStore();
    this.SceneMobHealthBarArray = new Array;
    this.MobContainerArray = new Array;
    this.SceneMobArray = new Array;
  }

  add(self) {
    this.mobGroup = self.physics.add.group({ allowGravity: false });
    if (typeof this.jigs.mobArray !== 'undefined') {
      let i = 0;
      while (i < this.jigs.mobArray.length) {
        this.MobContainerArray[i] = self.add.container(parseInt(this.jigs.mobArray[i][2]), parseInt(this.jigs.mobArray[i][3]));
        this.SceneMobArray[i] = new Mob(self, 0, 0, this.jigs.mobArray[i][4], this.jigs.mobArray[i][1]);
        self.add.existing(this.SceneMobArray[i]);
        this.SceneMobHealthBarArray[i] = self.add.image(0, -30, 'healthBar');
        this.SceneMobHealthBarArray[i].displayWidth = 25;
        this.MobContainerArray[i].add(this.SceneMobArray[i]);
        this.MobContainerArray[i].add(this.SceneMobHealthBarArray[i]);
        this.MobContainerArray[i].setDepth(6);
        this.mobGroup.add(this.MobContainerArray[i], true);
        i++;
      }
    }
  }

  updateMobs(scene) {
    let i = 0;
    while (i < this.MobContainerArray.length) {
      if (this.jigs.mobArray[i] != undefined) {
        this.MobContainerArray[i].x = this.jigs.mobArray[i][2];
        this.MobContainerArray[i].y = this.jigs.mobArray[i][3];
        this.SceneMobHealthBarArray[i].displayWidth = this.jigs.mobArray[i][6] / 4;
      }
      i++;
    };
  }

  onMobDown(mob, img) {
    this.jigs.mobClick = mob[1];
    this.jigs.mobShoot = mob[1];
    this.jigs.playerStats.credits++;
    if (this.jigs.debug) {
      console.log('mob clicked: ' + mob[1]);
    }
  }
}
