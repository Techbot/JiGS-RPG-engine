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
                switchesArray[index].x,
                switchesArray[index].y,
                switchesArray[index].id,
                switchesArray[index].startFrame
                ), true);
        }
    }
}
