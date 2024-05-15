/**
 * -------Loader ---------
 */

import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import Layers from "../entities/layers";
import { createCharacterAnims } from "../entities/anim";
import { createSwitchesAnims } from "../entities/anim";
import  MobLoader  from "./mobLoader"


export default class Load {

    jigs: any;
    npcs: any;
    sprite: any;
    mobloader: any;

    constructor() {
        this.jigs = useJigsStore();
        this.mobloader= new MobLoader();
    }

    padding(n, p, c) {
        var pad_char = typeof c !== 'undefined' ? c : '0';
        var pad = new Array(1 + p).join(pad_char);
        return (pad + n).slice(-pad.length);
    }

    load(scene) {
        const textureManager = scene.textures;

        scene.load.audio(this.jigs.soundtrack, '/assets/soundtracks/' + this.jigs.soundtrack + '.mp3');
        scene.load.image('black', '/assets/images/black.png');
        scene.load.image('pink', '/assets/images/pink.png');
        scene.load.tilemapTiledJSON(this.jigs.city + "_" + this.jigs.tiled, '/assets/cities/json/' + this.jigs.city + this.padding(this.jigs.tiled, 3, '0') + '.json?' + Math.random());

        this.jigs.tilesetArray_1.forEach(function loader(image) {
            if (!textureManager.exists(image)) {
                scene.load.image(image, '/assets/images/System/' + image + '.png');
            }
        }, this);

        this.jigs.tilesetArray_2.forEach(function loader(image) {
            if (!textureManager.exists(image)) {
                scene.load.image(image, '/assets/images/System/' + image + '.png');
            }
        }, this);

        this.jigs.tilesetArray_3.forEach(function loader(image) {
            if (!textureManager.exists(image)) {
                scene.load.image(image, '/assets/images/System/' + image + '.png');
            }
        }, this);

        if (this.jigs.tilesetArray_4 !== undefined) {
            this.jigs.tilesetArray_4.forEach(function loader(image) {
                if (!textureManager.exists(image)) {
                    scene.load.image(image, '/assets/images/System/' + image + '.png');
                }
            }, this);
        }

        if (this.jigs.npcArray) {
            this.jigs.npcArray.forEach(function loader(Npc) {
                scene.load.spritesheet('npc' + Npc[3], '/assets/images/sprites/' + Npc[3] + '.png', { frameWidth: 64, frameHeight: 64 });
            }, this);
        }

/*         if (this.jigs.mobArray) {
            this.jigs.mobArray.forEach(function loader(Mob) {
                scene.load.spritesheet('mob' + Mob[4], '/assets/images/sprites/' + Mob[4] + '.png', { frameWidth: 64, frameHeight: 64 });
            }, this);
        } */
        this.mobloader.add(scene);

        if (this.jigs.switchesArray) {
            this.jigs.switchesArray.forEach(function loader(switchItem) {
                scene.load.spritesheet('switch_' + switchItem.entity_id, '/assets/images/animations/' + switchItem.field_file_value ,
                    { frameWidth: parseInt(switchItem.field_frame_width_value), frameHeight: parseInt(switchItem.field_frame_height_value) });
            });
        }

        if (this.jigs.questsArray) {
            this.jigs.questsArray.forEach(function loader(questsItem) {
                scene.load.spritesheet('quest_' + questsItem.id, '/assets/images/quest/' + questsItem.file + '.png',
                    { frameWidth: questsItem.frameWidth, frameHeight: questsItem.frameHeight });
            });
        }

        scene.load.once(Phaser.Loader.Events.COMPLETE, () => {
            const Layer = new Layers;
            Layer.loadLayers(scene);
/*          createCharacterAnims(scene.anims, 'PsibotF', 'slash_oversize');
            createCharacterAnims(scene.anims, 'PsibotF_slash', 'slash_oversize'); */

            createCharacterAnims(scene.anims, 'player', null);

            createCharacterAnims(scene.anims, 'otherPlayer', null);

            if (this.jigs.npcArray) {
                this.jigs.npcArray.forEach(function loader(Npc) {
                    createCharacterAnims(scene.anims, 'npc' , Npc[3]);
                });
            }
/*             if (this.jigs.mobArray) {
                this.jigs.mobArray.forEach(function loader(mob) {
                    createCharacterAnims(scene.anims, 'mob' + mob[4], 'default');
                });
            } */

            if (this.jigs.mobArray) {
                this.jigs.mobArray.forEach(function loader(mob) {
                    createCharacterAnims(scene.anims, "Zombie-Green", "default");
                });
            }


            if (this.jigs.switchesArray) {
                this.jigs.switchesArray.forEach(function loader(switches) {
                    createSwitchesAnims(scene.anims,
                        'switch_' + switches.entity_id,
                        'switchAnim_' + switches.entity_id,
                        switches.field_switch_type_value,
                        switches.field_repeatable_value
                    );
                });
            }
            return scene;
        });
        scene.load.start();
    }
}
