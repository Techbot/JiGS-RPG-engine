/**
 * -------Switches ---------
 */
import Switch from "./switch";
export default class MissionSwitches {
    switchesGroup: any;
    add(scene) {
        if (scene.jigs.missionSwitchesArray) {
            const switchesArray = scene.jigs.missionSwitchesArray;
            const switches = scene.physics.add.group({ allowGravity: false });
            for (var index = 0; index < switchesArray.length; index++) {
                switches.add(new Switch(scene,
                    parseInt(switchesArray[index].field_x_value),
                    parseInt(switchesArray[index].field_y_value),
                    switchesArray[index].entity_id,
                    switchesArray[index].switchState
                ), true);
            }
        }
    }
}
