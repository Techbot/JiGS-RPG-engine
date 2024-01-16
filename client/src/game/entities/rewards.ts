/**
 * -------Rewards ---------
 */
import Reward from "./reward";
import { useJigsStore } from '../../stores/jigs';

export default class Rewards {
  jigs: any;
  rewardsGroup: any;

  constructor() {
    this.jigs = useJigsStore();
  }

  add(self) {
    this.rewardsGroup = self.physics.add.group({ allowGravity: false });
    let a = 0;
    if (typeof this.jigs.rewardsArray !== 'undefined') {
      while (a < this.jigs.rewardsArray.length) {
        self.rewardsArray[a] = new Reward(this, this.jigs.rewardsArray[a]);
        this.rewardsGroup.add(self.rewardsArray[a], true);
        a++;
      }
    }
  }
}
