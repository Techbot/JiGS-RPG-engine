/**
 * ------- Drones ---------
 */
import Drone from "./drone";
import { useJigsStore } from '../../stores/jigs';

export default class Drones  {
  jigs: any;
  dronesGroup: any;

  constructor(self,x,y) {
    this.dronesGroup = self.physics.add.group({ allowGravity: false });
    this.dronesGroup.add(new Drone(self, x, y, 100, 100, 0.005),true);
    this.dronesGroup.add(new Drone(self, x, y, 40, 100, 0.005), true);
    this.dronesGroup.add(new Drone(self, x, y, 40, 100, -0.005), true);
  }

}
