/**
 * -------Layers ---------
 */
import { useCounterStore } from '../../stores/counter';

export default class Layers {
    counter: any;
    colliderMap: any;

    constructor() {
        this.counter = useCounterStore();
    }

    loadLayers(self) {
        var map = self.make.tilemap({ key: self.counter.tiled, tileWidth: 32, tileHeight: 32 });

        this.counter.tilesetArray_1.forEach(function loader(image: any) {
            map.addTilesetImage(image);
        }, this);

        this.counter.tilesetArray_2.forEach(function loader(image: any) {
            map.addTilesetImage(image);
        }, this);

        this.counter.tilesetArray_3.forEach(function loader(image: any) {
            map.addTilesetImage(image);
        }, this);

        this.counter.tilesetArray_4.forEach(function loader(image: any) {
            map.addTilesetImage(image);
        }, this);


 /*        this.counter.tilesetArray_5.forEach(function loader(image: any) {
            map.addTilesetImage(image);
        }, this); */

        //layer.skipCull = true;
        self.colliderMap = map.createLayer('Tile Layer 1', this.counter.tilesetArray_1).setDepth(1).setPipeline('Light2D');
        map.createLayer('Tile Layer 2', this.counter.tilesetArray_2).setDepth(2);
        map.createLayer('Tile Layer 3', this.counter.tilesetArray_3).setDepth(3);
        //self.physics.world.enable([self.colliderMap]);
        //self.colliderMap.setCollisionBetween(1, 16, true, false); //(line 125)
        map.createLayer('Tile Layer 4', this.counter.tilesetArray_4).setDepth(5);
       // map.createLayer('Tile Layer 5', this.counter.tilesetArray_5).setDepth(6);
    }
}
