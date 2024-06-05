/**
 * ------- Bosses ---------
 */
import Boss from "./boss";
import { useJigsStore } from '../../stores/jigs';

export default class Bosses {
  jigs: any;
  walls: any;
  bossArray: any;
  SceneBossHealthBarArray: Array<any>;
  BossContainerArray: Array<any>;
  bossGroup: any;
  SceneBossArray: any;

  constructor() {
    this.jigs = useJigsStore();
    this.SceneBossHealthBarArray = new Array;
    this.BossContainerArray = new Array;
    this.SceneBossArray = new Array;
  }

  add(self) {
    this.bossGroup = self.physics.add.group({ allowGravity: false });
    if (typeof this.jigs.bossesArray !== 'undefined') {
      let i = 0;
      while (i < this.jigs.bossesArray.length) {
        this.BossContainerArray[i] = self.add.container(parseInt(this.jigs.bossesArray[i].x), parseInt(this.jigs.bossesArray[i].y));
        this.SceneBossArray[i] = new Boss(self, 0, 0, this.jigs.bossesArray[i].name, this.jigs.bossesArray[i].name);
        self.add.existing(this.SceneBossArray[i]);
        this.SceneBossHealthBarArray[i] = self.add.image(0, -30, 'healthBar');
        this.SceneBossHealthBarArray[i].displayWidth = 25;
        this.BossContainerArray[i].add(this.SceneBossArray[i]);
        this.BossContainerArray[i].add(this.SceneBossHealthBarArray[i]);
        this.BossContainerArray[i].setDepth(6);
        this.bossGroup.add(this.BossContainerArray[i], true);
        i++;
      }
    }
  }

  updateBosses(scene) {
    let i = 0;
    while (i < this.BossContainerArray.length) {
      if (this.jigs.bossesArray[i] != undefined) {
        this.BossContainerArray[i].x = this.jigs.bossesArray[i].x;
        this.BossContainerArray[i].y = this.jigs.bossesArray[i].y;
     //   this.SceneBossHealthBarArray[i].displayWidth = this.jigs.bossesArray[i][6] / 4;
        this.SceneBossHealthBarArray[i].displayWidth = 100 / 4;
      }
      i++;
    };
  }

  onBossDown(boss, img) {
    this.jigs.bossClick = boss[1];
    this.jigs.bossShoot = boss[1];
    this.jigs.playerStats.credits++;
    if (this.jigs.debug) {
      console.log('boss clicked: ' + boss[1]);
    }
  }
}
