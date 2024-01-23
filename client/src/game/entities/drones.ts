/**
 * ------- Drones ---------
 */
import Drone from "./drone";
import { useJigsStore } from '../../stores/jigs';

export default class Drones {
  jigs: any;
  dronesGroup: any;

  constructor(scene, x, y) {
    this.dronesGroup = scene.physics.add.group({ allowGravity: false });
    this.dronesGroup.add(new Drone(scene, x, y, 100, 100, 0.005), true);
    this.dronesGroup.add(new Drone(scene, x, y, 40, 100, 0.005), true);
    this.dronesGroup.add(new Drone(scene, x, y, 40, 100, -0.005), true);

    scene.events.on('position', this.handler, this);

  }

  handler(x, y) {
    if (this.dronesGroup.children) {
      this.dronesGroup.children.each(function (drone) {
        drone.update(x, y);
      }, this);
    }
  }

















}
