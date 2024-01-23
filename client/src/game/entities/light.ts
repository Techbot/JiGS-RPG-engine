/**
 * ------- Light ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';



export default class Light  {
  jigs: any;
  angle: any;
  x: any ;
  y: any;
  torch: any;

  constructor(scene, x, y,sprite) {
    this.x = x;
    this.y = y;
    this.jigs = useJigsStore();
    this.torch = scene.lights.addLight(x, y, 200);
    scene.events.on('position', this.handler, this.torch);
  }

  handler(x, y) {
    this.x = x;
    this.y = y
  }
}
