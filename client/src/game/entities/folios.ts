/**
 * ------- Folios ---------
 */
import Folio from "./folio";

export default class Folios {
    add(scene) {
        const foliosArray = scene.jigs.foliosArray;
        const folios = scene.physics.add.group({ allowGravity: false });

        for (var index = 0; index < foliosArray.length; index++) {
            folios.add(new Folio(scene, foliosArray[index].x, foliosArray[index].y,foliosArray[index].id), true);
        }
    }
}
