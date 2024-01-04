/**
 * -------Folios ---------
 */
import Folio from "./folio";

export default class Folios {
    add(self) {
        const foliosArray = self.jigs.foliosArray;
        const folios = self.physics.add.group({ allowGravity: false });

        for (var index = 0; index < foliosArray.length; index++) {
            console.log("switch: " + foliosArray[index].x);
            folios.add(new Folio(self, foliosArray[index].x, foliosArray[index].y), true);
        }
    }
}
