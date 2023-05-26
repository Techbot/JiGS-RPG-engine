/**
 * -------Sprites ---------
 */

import Phaser from "phaser";
import { useCounterStore } from '../../stores/counter';
import Layers from "../entities/layers";
import { createCharacterAnims } from "../entities/anim";

export default class Load {

    counter: any;
    npcs: any;
    sprite: any;

    constructor() {
        this.counter = useCounterStore();
    }

    padding(n, p, c) {
        var pad_char = typeof c !== 'undefined' ? c : '0';
        var pad = new Array(1 + p).join(pad_char);
        return (pad + n).slice(-pad.length);
    }

    load(self) {

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
        if (this.counter.npcArray) {
            this.counter.npcArray.forEach(function loader(Npc) {
                console.log('loading NPC:' + Npc[3]);
                self.load.spritesheet('npc' + Npc[3], '/assets/cities/' + this.counter.city + '/npc/' + Npc[3] + '.png', { frameWidth: 64, frameHeight: 64 });
            }, this);
        }

        if (this.counter.mobArray) {
            this.counter.mobArray.forEach(function loader(Mob) {
                console.log('loading Mob:' + Mob[3]);
                self.load.spritesheet('mob' + Mob[3], '/assets/cities/' + this.counter.city + '/mob/' + Mob[3] + '.png', { frameWidth: 64, frameHeight: 64 });
            }, this);
        }

        /*  if (this.counter.tilesetArray_5 !== undefined) {
             this.counter.tilesetArray_5.forEach(function loader(image) {
                 self.load.image(image, '/assets/images/System/' + image + '.png');
             }, this);
         } */

        self.load.spritesheet('FixerF', '/assets/images/Sprites/avatars/1000.png', { frameWidth: 64, frameHeight: 64 });
        self.load.spritesheet('FixerM', '/assets/images/Sprites/avatars/50607.png', { frameWidth: 64, frameHeight: 64 });
        self.load.spritesheet('CenobyteF', '/assets/images/Sprites/avatars/12134.png', { frameWidth: 64, frameHeight: 64 });
        self.load.spritesheet('CenobyteM', '/assets/images/Sprites/avatars/4351.png', { frameWidth: 64, frameHeight: 64 });
        self.load.spritesheet('AssassinF', '/assets/images/Sprites/avatars/86333.png', { frameWidth: 64, frameHeight: 64 });
        self.load.spritesheet('AssassinM', '/assets/images/Sprites/avatars/86333.png', { frameWidth: 64, frameHeight: 64 });
        self.load.spritesheet('XeonF', '/assets/images/Sprites/avatars/57231.png', { frameWidth: 64, frameHeight: 64 });
        self.load.spritesheet('XeonM', '/assets/images/Sprites/avatars/45682.png', { frameWidth: 64, frameHeight: 64 });
        self.load.spritesheet('otherPlayer', '/assets/images/Sprites/avatars/47054.png', { frameWidth: 64, frameHeight: 64 });

        self.load.image('sky', '/assets/images/sky.png');
        self.load.image('ship', '/assets/images/spaceShips_001.png');

        self.load.image('star', '/assets/images/star_gold.png');
        self.load.image('gun', "/assets/images/gun.png", 5, 5);
        self.load.image('bullet', "/assets/images/star_gold.png", 5, 5);
        self.load.image('healthBar', "/assets/images/health_bar.png", 64, 15);
        self.load.image('portal00001', '/assets/images/enemyBlack5.png', 64, 64);
        self.load.image('portal00002', '/assets/images/enemyBlack5.png', 64, 64);
        self.load.image('portal00003', '/assets/images/enemyBlack5.png', 64, 64);
        self.load.image('reward', '/assets/images/various-32-greyout_69.png', 32, 32);
        self.load.tilemapTiledJSON(this.counter.tiled, '/assets/cities/' + this.counter.city + '/json/' + this.padding(this.counter.tiled, 3, '0') + '.json');
        self.load.once(Phaser.Loader.Events.COMPLETE, () => {
            // texture loaded so use instead of the placeholder
            console.log('once');
            const Layer = new Layers;
            Layer.loadLayers(self);
            //const Anims = new Anim;
            //Anims.addAnim(this);
            createCharacterAnims(self.anims, 'FixerF');
            createCharacterAnims(self.anims, 'FixerM');
            createCharacterAnims(self.anims, 'CenobyteF');
            createCharacterAnims(self.anims, 'CenobyteM');
            createCharacterAnims(self.anims, 'AssassinF');
            createCharacterAnims(self.anims, 'AssassinM');
            createCharacterAnims(self.anims, 'XeonF');
            createCharacterAnims(self.anims, 'XeonM');
            createCharacterAnims(self.anims, 'otherPlayer');

            if (this.counter.npcArray) {
                this.counter.npcArray.forEach(function loader(Npc) {
                    createCharacterAnims(self.anims, 'npc' + Npc[3]);
                });
            }
            console.log('twice');
        });
        self.load.start();
        return self;
    }
}
