/**
 * -------Portals ---------
 */
import Wall from "../entities/wall";
export default class Walls {
    addWalls(self) {

        const wallsArray = self.jigs.wallsArray;
        const walls = self.physics.add.group({ allowGravity: false });

        for (var index = 0; index < wallsArray.length; index++) {
            console.log(wallsArray[index].destination);
            walls.add(new Wall(self, wallsArray[index].x, wallsArray[index].y), true);
            //portal[index].dest = portals[index].destination;
        }
    }
}
