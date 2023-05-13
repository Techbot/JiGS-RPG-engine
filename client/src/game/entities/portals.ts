/**
 * -------Portals ---------
 */
import Portal from "../entities/portal";
export default class Portals {

    addPortals(self) {

/*         let portalsArray: {
            destination: number,
            x: number,
            y: number,
            destination_x: number,
            destination_y: number
        }[] = []; */

        const portalsArray = self.counter.portalsArray;
        const portals = self.physics.add.group({ allowGravity: false });

        for (var index = 0; index < portalsArray.length; index++) {
            console.log('yo');
            console.log(portalsArray[index].destination);
            portals.add(new Portal(self, portalsArray[index].x, portalsArray[index].y), true);
            //portal[index].dest = portals[index].destination;
        }
    }
}
