/**
 * -------Portals ---------
 */
import Portal from "../entities/portal";
export default class Portals {
    add(self) {
        const portalsArray = self.jigs.portalsArray;
        const portals = self.physics.add.group({ allowGravity: false });
        for (var index = 0; index < portalsArray.length; index++) {
            console.log(portalsArray[index].destination);
            portals.add(new Portal(self, portalsArray[index].x, portalsArray[index].y), true);
        }
    }
}
