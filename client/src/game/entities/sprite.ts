/**
 * -------Sprites ---------
 */

import Phaser from "phaser";
import { useCounterStore } from '../../stores/counter';
import Layers from "../entities/layers";


export default class SpriteLoad {

    counter: any;

    constructor() {
        this.counter = useCounterStore();
    }


    loadSprites(self) {

        this.counter.tilesetArray_1.forEach(function loader(image) {
            console.log('blobby');

            self.load.image(image, '/assets/images/System/' + image + '.png');
        }, this);

        this.counter.tilesetArray_2.forEach(function loader(image) {
            self.load.image(image, '/assets/images/System/' + image + '.png');
        }, this);

        this.counter.tilesetArray_3.forEach(function loader(image) {
            self.load.image(image, '/assets/images/System/' + image + '.png');
        }, this);


        if (this.counter.tilesetArray_4 !== undefined) {
            this.counter.tilesetArray_4.forEach(function loader(image) {
                self.load.image(image, '/assets/images/System/' + image + '.png');
            }, this);
        }

        if (this.counter.tilesetArray_5 !== undefined) {
            this.counter.tilesetArray_5.forEach(function loader(image) {
                self.load.image(image, '/assets/images/System/' + image + '.png');
            }, this);
        }

        self.load.spritesheet('brawler', '/assets/images/Sprites/4351.png', { frameWidth: 64, frameHeight: 64 });
        self.load.spritesheet('brawler2', '/assets/images/Sprites/4351.png', { frameWidth: 64, frameHeight: 64 });

        self.load.image('sky', '/assets/images/sky.png');

        self.load.image('ship', '/assets/images/spaceShips_001.png');
        self.load.image('otherPlayer', '/assets/images/enemyBlack5.png');
        self.load.image('star', '/assets/images/star_gold.png');

        /*         self.load.image('celianna_TileA1', '/assets/images/Basic Tiles/celianna_TileA1.png');
                self.load.image('celianna_TileA2', '/assets/images/Basic Tiles/celianna_TileA2.png');
                self.load.image('celianna_TileA5', '/assets/images/Basic Tiles/celianna_TileA5.png');

                self.load.image('TileA1', '/assets/images/System/TileA1.png');
                self.load.image('TileA2', '/assets/images/System/TileA2.png');
                self.load.image('TileA3', '/assets/images/System/TileA3.png');
                self.load.image('TileA4', '/assets/images/System/TileA4.png');
                self.load.image('TileA5', '/assets/images/System/TileA5.png');
                self.load.image('TileB', '/assets/images/System/TileB.png');
                self.load.image('TileC', '/assets/images/System/TileC.png');
                self.load.image('TileD', '/assets/images/System/TileD.png');
                self.load.image('TileE', '/assets/images/System/TileE.png');
                self.load.image('TileF', '/assets/images/System/TileF.png');
                self.load.image('Tile001', '/assets/images/System/001.png'); */

        //self.load.image('001', '/assets/images/System/001.png');


        /*         self.load.image('doors1', '/assets/images/Characters/doors1.png');
                self.load.image('cars2', '/assets/images/Characters/cars2.png'); */

        self.load.image('gun', "/assets/images/gun.png", 5, 5);
        self.load.image('bullet', "/assets/images/star_gold.png", 5, 5);
        self.load.image('portal00001', '/assets/images/enemyBlack5.png', 64, 64);
        self.load.image('portal00002', '/assets/images/enemyBlack5.png', 64, 64);
        self.load.image('portal00003', '/assets/images/enemyBlack5.png', 64, 64);


        /*         self.load.image('pk02A', '/assets/images/System/pk02sceneA.png');
                self.load.image('pk02B', '/assets/images/System/pk02sceneB.png');
                self.load.image('pk01A', '/assets/images/System/pk01sceneA.png');
                self.load.image('pk01B', '/assets/images/System/pk01sceneB.png'); */


        ////////////////////////////////////////////////////////////////////////
        //this.counter

        self.load.tilemapTiledJSON(this.counter.tiled, '/assets/cities/Dublin/json/' + this.counter.tiled + '.json');

        self.load.once(Phaser.Loader.Events.COMPLETE, () => {
            // texture loaded so use instead of the placeholder

            console.log('once');

            const Layer = new Layers;
            Layer.loadLayers(self);

        })
        self.load.start();



        //   self.load.tilemapTiledJSON('1', '/assets/cities/Dublin/json/1.json');
        /*        self.load.tilemapTiledJSON('2', '/assets/cities/Dublin/json/2.json');
               self.load.tilemapTiledJSON('3', '/assets/cities/Dublin/json/3.json');
               self.load.tilemapTiledJSON('4', '/assets/cities/Dublin/json/4.json');
               self.load.tilemapTiledJSON('5', '/assets/cities/Dublin/json/5.json');
               self.load.tilemapTiledJSON('6', '/assets/cities/Dublin/json/6.json');
               self.load.tilemapTiledJSON('7', '/assets/cities/Dublin/json/7.json');
               self.load.tilemapTiledJSON('8', '/assets/cities/Dublin/json/8.json');
               self.load.tilemapTiledJSON('9', '/assets/cities/Dublin/json/9.json');
               self.load.tilemapTiledJSON('10', '/assets/cities/Dublin/json/10.json');
               self.load.tilemapTiledJSON('11', '/assets/cities/Dublin/json/11.json');
               self.load.tilemapTiledJSON('12', '/assets/cities/Dublin/json/12.json');
               self.load.tilemapTiledJSON('13', '/assets/cities/Dublin/json/13.json');
               self.load.tilemapTiledJSON('14', '/assets/cities/Dublin/json/14.json');
               self.load.tilemapTiledJSON('15', '/assets/cities/Dublin/json/15.json');
               self.load.tilemapTiledJSON('16', '/assets/cities/Dublin/json/16.json');
               self.load.tilemapTiledJSON('17', '/assets/cities/Dublin/json/17.json');
               self.load.tilemapTiledJSON('18', '/assets/cities/Dublin/json/18.json');
               self.load.tilemapTiledJSON('19', '/assets/cities/Dublin/json/19.json');
               self.load.tilemapTiledJSON('20', '/assets/cities/Dublin/json/20.json');
               self.load.tilemapTiledJSON('21', '/assets/cities/Dublin/json/21.json');
               self.load.tilemapTiledJSON('22', '/assets/cities/Dublin/json/22.json'); */
        //this.load.tilemapTiledJSON('map', '/assets/json/Dublin/json/' + this.counter.tiled + '.json');
        return self;
    }
}
