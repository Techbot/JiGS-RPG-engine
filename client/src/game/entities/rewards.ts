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

  add(scene) {
    this.rewardsGroup = scene.physics.add.group({ allowGravity: false });
    let a = 0;
    if (typeof this.jigs.rewardsArray !== 'undefined') {
      while (a < this.jigs.rewardsArray.length) {
        scene.rewardsArray[a] = new Reward(this, this.jigs.rewardsArray[a]);
        this.rewardsGroup.add(scene.rewardsArray[a], true);
        a++;
      }
    }
  }
}
