/**
 * -------Walls ---------
 */
import Wall from "../entities/wall";
import { useJigsStore } from '../../stores/jigs';

export default class Walls {

    jigs: any;
    walls: any;

    constructor() {
        this.jigs = useJigsStore();
    }

    add(self) {
        const wallsArray = this.jigs.wallsArray;
        this.walls = self.physics.add.staticGroup({ allowGravity: false });
        for (var index = 0; index < wallsArray.length; index++) {
            const wall = new Wall(self, wallsArray[index].x, wallsArray[index].y, wallsArray[index].width, wallsArray[index].height);
            this.walls.add(wall, true);
            self.physics.add.existing(wall);
        }
    }
}
