/**
 * -------Switches ---------
 */
import Switch from "./switch";
export default class Switches {
    switchesGroup: any;
    add(self) {

        const switchesArray = self.jigs.switchesArray;
        const switches = self.physics.add.group({ allowGravity: false });

        for (var index = 0; index < switchesArray.length; index++) {
            switches.add(new Switch(self,
                parseInt(switchesArray[index].field_x_value),
                parseInt(switchesArray[index].field_y_value),
                switchesArray[index].entity_id,
                switchesArray[index].switchState,
                switchesArray[index].field_starting_frame_value
                ), true);
        }
    }
}
