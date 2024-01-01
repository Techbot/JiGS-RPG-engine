/**
 * -------Portals ---------
 */
import Switch from "./switch";
export default class Switches {
    add(self) {
        const switchesArray = self.jigs.switchesArray;

        const switches = self.physics.add.group({ allowGravity: false });

        for (var index = 0; index < switchesArray.length; index++) {
            console.log("switch: " + switchesArray[index].x);
            switches.add(new Switch(self, switchesArray[index].x, switchesArray[index].y), true);
        }
    }
}
