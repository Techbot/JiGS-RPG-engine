/**
 * -------Layers ---------
 */
import { useCounterStore } from '../../stores/counter';

export default class Layers {
    counter: any;

    constructor() {
        this.counter = useCounterStore();
    }

    loadLayers(self) {
        var map = self.make.tilemap({ key: self.counter.tiled, tileWidth: 32, tileHeight: 32 });
        /*         var mapArray = ['TileA1', 'TileA2', 'TileA3', 'TileA4', 'TileA5', 'TileB', 'TileC', 'TileD', 'TileE', 'TileF', 'celianna_TileA1',
                    'celianna_TileA2', 'celianna_TileA5', 'doors1', 'pk02A', 'pk02B', 'pk01A', 'pk01B']; */


        this.counter.tilesetArray_1.forEach(function loader(image: any) {
            map.addTilesetImage(image);
        }, this);

        this.counter.tilesetArray_2.forEach(function loader(image: any) {
            map.addTilesetImage(image);
        }, this);

        this.counter.tilesetArray_3.forEach(function loader(image: any) {
            map.addTilesetImage(image);
        }, this);

        if (this.counter.tilesetArray_4 !== undefined) {
            this.counter.tilesetArray_4.forEach(function loader(image: any) {
                map.addTilesetImage(image);
            }, this);
        }
        if (this.counter.tilesetArray_5 !== undefined) {
            this.counter.tilesetArray_5.forEach(function loader(image: any) {
                map.addTilesetImage(image);
            }, this);
        }
        /*         mapArray.forEach((x) => {
                     map.addTilesetImage(x);
                }); */
        //layer.skipCull = true;
        map.createLayer('Tile Layer 1', this.counter.tilesetArray_1);

        map.createLayer('Tile Layer 2', this.counter.tilesetArray_2);

        map.createLayer('Tile Layer 3', this.counter.tilesetArray_3);
        if (this.counter.tilesetArray_4 !== undefined) {
            map.createLayer('Tile Layer 4', this.counter.tilesetArray_4);
        }
        if (this.counter.tilesetArray_5 !== undefined) {
            map.createLayer('Tile Layer 5', this.counter.tilesetArray_5);
        }
        /*         map.createLayer('Tile Layer 1', [tileset[0], tileset[1], tileset[3], tileset[4], tileset[10], tileset[11], tileset[12], tileset[13],
                tileset[15], tileset[16], tileset[17], tileset[18]]);
                // create the layers we want in the right order
                map.createLayer('Tile Layer 2', [tileset[0], tileset[1], tileset[2], tileset[3], tileset[4]])
                map.createLayer('Tile Layer 3', [tileset[7], tileset[1], tileset[8], tileset[13]]);
                map.createLayer('Tile Layer 4', [tileset[0], tileset[1], tileset[2], tileset[3], tileset[4]])
                map.createLayer('Tile Layer 5', [tileset[7], tileset[1], tileset[8], tileset[13]]); */
    }
}
