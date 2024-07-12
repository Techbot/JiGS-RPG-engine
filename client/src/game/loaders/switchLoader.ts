/**
 * -------switchLoader ---------
 */

import { useJigsStore } from '../../stores/jigs';

export default class SwitchLoader {

  jigs: any;

  constructor() {
    this.jigs = useJigsStore();
  }

  add(scene) {
    console.log("------------Switch Loader---------------")

    if (this.jigs.switchesArray) {
      this.jigs.switchesArray.forEach(function loader(switchItem) {
        scene.load.spritesheet(switchItem.entity_id, '/assets/images/switches/' + switchItem.field_file_value,
          { frameWidth: parseInt(switchItem.field_frame_width_value), frameHeight: parseInt(switchItem.field_frame_height_value) });
      });
    }

    if (this.jigs.missionSwitchesArray) {
      this.jigs.missionSwitchesArray.forEach(function loader(switchItem) {
        scene.load.spritesheet( switchItem.entity_id, '/assets/images/switches/' + switchItem.field_file_value,
          { frameWidth: parseInt(switchItem.field_frame_width_value), frameHeight: parseInt(switchItem.field_frame_height_value) });
      });
    }

  }
}
