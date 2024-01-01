import Drone from "./drone";
import { useJigsStore } from '../../stores/jigs';

export default class Drones extends Phaser.Physics.Arcade.Group {
  jigs: any;
  dronesGroup: any;

  constructor(self,x,y) {
    super(self.physics.world, self);
    this.jigs = useJigsStore();
    this.add(new Drone(self, x, y, 100, 100, 0.005),true);
    this.add(new Drone(self, x, y, 40, 100, 0.005), true);
    this.add(new Drone(self, x, y, 40, 100, -0.005), true);
  }

}
