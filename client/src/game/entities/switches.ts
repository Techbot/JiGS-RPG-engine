/**
 * -------Switches ---------
 */
import Switch from "./switch";
export default class Switches {
    switchesGroup: any;
    add(scene) {
        if (scene.jigs.switchesArray) {
            const switchesArray = scene.jigs.switchesArray;
            const switches = scene.physics.add.group({ allowGravity: false });
            for (var index = 0; index < switchesArray.length; index++) {
                switches.add(new Switch(scene,
                    parseInt(switchesArray[index].field_x_value),
                    parseInt(switchesArray[index].field_y_value),
                    switchesArray[index].entity_id,
                    switchesArray[index].switchState,
                    switchesArray[index].field_starting_frame_value
                ), true);
            }
        }
    }
}
