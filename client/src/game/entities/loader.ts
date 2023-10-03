/**
 * -------Sprites ---------
 */

import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import Layers from "../entities/layers";
import { createCharacterAnims } from "../entities/anim";

export default class Load {

    jigs: any;
    npcs: any;
    sprite: any;

    constructor() {
        this.jigs = useJigsStore();
    }

    padding(n, p, c) {
        var pad_char = typeof c !== 'undefined' ? c : '0';
        var pad = new Array(1 + p).join(pad_char);
        return (pad + n).slice(-pad.length);
    }

    load(self) {


        self.load.tilemapTiledJSON(this.jigs.tiled, '/assets/cities/' + this.jigs.city + '/json/' + this.padding(this.jigs.tiled, 3, '0') + '.json?' + Math.random());


        this.jigs.tilesetArray_1.forEach(function loader(image) {
            self.load.image(image, '/assets/images/System/' + image + '.png');
        }, this);

        this.jigs.tilesetArray_2.forEach(function loader(image) {
            self.load.image(image, '/assets/images/System/' + image + '.png');
        }, this);

        this.jigs.tilesetArray_3.forEach(function loader(image) {
            self.load.image(image, '/assets/images/System/' + image + '.png');
        }, this);

        if (this.jigs.tilesetArray_4 !== undefined) {
            this.jigs.tilesetArray_4.forEach(function loader(image) {
                self.load.image(image, '/assets/images/System/' + image + '.png');
            }, this);
        }


        if (this.jigs.npcArray) {
            this.jigs.npcArray.forEach(function loader(Npc) {
                //console.log('loading NPC:' + Npc[3]);
                self.load.spritesheet('npc' + Npc[3], '/assets/images/sprites/' + Npc[3] + '.png', { frameWidth: 64, frameHeight: 64 });
            }, this);
        }

        if (this.jigs.mobArray) {
            this.jigs.mobArray.forEach(function loader(Mob) {
                //console.log('loading Mob:' + Mob[3]);
                self.load.spritesheet('mob' + Mob[3], '/assets/images/sprites/' + Mob[3] + '.png', { frameWidth: 64, frameHeight: 64 });
            }, this);
        }

        self.load.once(Phaser.Loader.Events.COMPLETE, () => {
            // texture loaded so use instead of the placeholder
            //console.log('once');

            const Layer = new Layers;
            Layer.loadLayers(self);



            //const Anims = new Anim;
            //Anims.addAnim(this);
            createCharacterAnims(self.anims, 'PsibotF','slash_oversize');
            createCharacterAnims(self.anims, 'PsibotF_slash', 'slash_oversize');
            createCharacterAnims(self.anims, 'PsibotM', 'slash_oversize');
            createCharacterAnims(self.anims, 'PsibotM_slash','slash_oversize');
            createCharacterAnims(self.anims, 'otherPlayer','default');

            if (this.jigs.npcArray) {
                this.jigs.npcArray.forEach(function loader(Npc) {
                    createCharacterAnims(self.anims, 'npc' + Npc[3],'default');
                });
            }

            if (this.jigs.mobArray) {
                this.jigs.mobArray.forEach(function loader(mob) {
                    createCharacterAnims(self.anims, 'mob' + mob[3],'default');
                });
            }
            //console.log('twice');
            return self;

        });
        self.load.start();

    }
}
