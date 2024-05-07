/**
 * -------Portals ---------
 */
import Portal from "../entities/portal";
export default class Portals {
    add(scene) {
        const portalsArray = scene.jigs.portalsArray;
        const portals = scene.physics.add.group({ allowGravity: false });
        for (var index = 0; index < portalsArray.length; index++) {
            console.log(portalsArray[index].destination);
            portals.add(new Portal(scene, portalsArray[index].x, portalsArray[index].y), true);
        }
    }
}
