/**
 * -------Mobs ---------
 */
import Mob from "./mob";
import { useJigsStore } from '../../stores/jigs';

export default class Mobs {
  jigs: any;
  walls: any;
  mobArray: any;

  constructor() {
    this.jigs = useJigsStore();
  }

  add(self) {
    self.mobGroup = self.physics.add.group({ allowGravity: false });

    if (typeof this.jigs.mobArray !== 'undefined') {
      let i = 0;
      while (i < this.jigs.mobArray.length) {
        self.MobContainerArray[i] = self.add.container(parseInt(this.jigs.mobArray[i][2]), parseInt(this.jigs.mobArray[i][3]));
        //  this.add.existing(this.add.sprite(0, 0, 'mob' + this.jigs.mobArray[i][4]));


         self.SceneMobArray[i] = self.add.sprite(0, 0, 'mob' + this.jigs.mobArray[i][4])
          .setInteractive({ cursor: 'url(/assets/images/cursors/attack.cur), pointer' })
          .setScale(.85)
          .setData("levelindex", self.jigs.mobArray[i][1])
          .on('pointerdown', this.onMobDown.bind(this, this.jigs.mobArray[i]));

   //     self.SceneMobArray[i] = new Mob(self, this.jigs.mobArray[i].x, this.jigs.mobArray[i].y, this.jigs.mobArray[i].sprite);

        self.SceneMobArray[i].anims.play('walkDown_mob' + self.jigs.mobArray[i][4]);
        self.SceneMobHealthBarArray[i] = self.add.image(0, -30, 'healthBar');
        self.SceneMobHealthBarArray[i].displayWidth = 25;
        self.MobContainerArray[i].add(self.SceneMobArray[i]);
        self.MobContainerArray[i].add(self.SceneMobHealthBarArray[i]);
        self.MobContainerArray[i].setDepth(6);
        self.mobGroup.add(self.MobContainerArray[i], true);
        i++;
      }
    }
  }
    /*   add(self) {
        this.mobArray = self.physics.add.group({ allowGravity: false });
        if (typeof this.jigs.mobArray !== 'undefined') {
          let i = 0;
          while (i < this.jigs.mobArray.length) {
            self.MobContainerArray[i] = self.add.container(parseInt(self.jigs.mobArray[i][2]), parseInt(this.jigs.mobArray[i][3]));
            self.add.existing(self.add.sprite(0, 0, 'mob' + self.jigs.mobArray[i][4]));
            self.SceneMobArray[i] = self.add.sprite(0, 0, 'mob' + self.jigs.mobArray[i][4])
              .setInteractive({ cursor: 'url(/assets/images/cursors/attack.cur), pointer' })
              .setScale(.85)
              .setData("levelindex", this.jigs.mobArray[i][1])
              .on('pointerdown', self.onMobDown.bind(this, self.jigs.mobArray[i]));
            self.SceneMobArray[i].anims.play('walkDown_mob' + self.jigs.mobArray[i][4]);
            self.SceneMobHealthBarArray[i] = self.add.image(0, -30, 'healthBar');
            self.SceneMobHealthBarArray[i].displayWidth = 25;
            self.MobContainerArray[i].add(self.SceneMobArray[i]);
            self.MobContainerArray[i].add(self.SceneMobHealthBarArray[i]);
            self.MobContainerArray[i].setDepth(6);
            self.mobArray.add(self.MobContainerArray[i], true);
            i++;
          }
        }
      } */

    onMobDown(mob, img) {
      this.jigs.mobClick = mob[1];
      this.jigs.mobShoot = mob[1];
      this.jigs.playerStats.credits++;
    }
  }
