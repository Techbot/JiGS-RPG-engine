import Drone from "./drone";
import { useJigsStore } from '../../stores/jigs';

export default class Drones {
  jigs: any;
  drones: any;

  constructor() {
    this.jigs = useJigsStore();
  }

  add(self,x,y) {
    this.drones = self.physics.add.group({ allowGravity: false });
    this.drones.add(new Drone(self, x, y, 100, 100, 0.005), true);
    this.drones.add(new Drone(self, x, y, 40, 100, 0.005), true);
    this.drones.add(new Drone(self, x, y, 40, 100, -0.005), true);
  }
}
