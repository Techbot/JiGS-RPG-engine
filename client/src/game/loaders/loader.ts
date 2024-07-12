/**
 * -------Loader ---------
 */

import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import Layers from "../entities/layers";
import { createCharacterAnims } from "../entities/anim";
import { createSwitchesAnims } from "../entities/anim";
import { createBossAnims } from "../entities/anim";
import MobLoader from "./mobLoader"
import BossLoader from "./bossLoader"
import NpcLoader from "./npcLoader"
import TilesetLoader from "./tilesetLoader"
import SwitchLoader from "./switchLoader"
import QuestLoader from "./questLoader"

export default class Load {

    jigs: any;
    npcs: any;
    sprite: any;
    mobLoader: any;
    bossLoader: any;
    npcLoader: any;
    tilesetLoader: any;
    switchLoader: any;
    questLoader: any;

    constructor() {
        this.jigs = useJigsStore();
        this.mobLoader = new MobLoader();
        this.bossLoader = new BossLoader();
        this.npcLoader = new NpcLoader();
        this.tilesetLoader = new TilesetLoader();
        this.switchLoader = new SwitchLoader();
        this.questLoader = new QuestLoader();

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

        this.tilesetLoader.add(scene);
        this.npcLoader.add(scene);
        this.mobLoader.add(scene);
        this.bossLoader.add(scene);
        this.switchLoader.add(scene);
        this.questLoader.add(scene);

        scene.load.once(Phaser.Loader.Events.COMPLETE, () => {
            const Layer = new Layers;
            Layer.loadLayers(scene);
            createCharacterAnims(scene.anims, 'player', null);
            createCharacterAnims(scene.anims, 'otherPlayer', null);

            if (this.jigs.npcArray) {
                this.jigs.npcArray.forEach(function loader(Npc) {
                    createCharacterAnims(scene.anims, 'npc', Npc[3]);
                });
            }

            if (this.jigs.mobArray) {
                this.jigs.mobArray.forEach(function loader(mob) {
                    createCharacterAnims(scene.anims, "Zombie-Green", "default");
                });
            }

            if (this.jigs.bossesArray) {
                this.jigs.bossesArray.forEach(function loader(boss) {
                    createBossAnims(scene.anims, boss.name);
                });
            }

            if (this.jigs.switchesArray) {
                this.jigs.switchesArray.forEach(function loader(switches) {
                    createSwitchesAnims(scene.anims,
                        switches.entity_id,
                        switches.field_switch_type_value,
                        switches.field_repeatable_value
                    );
                });
            }
            if (this.jigs.missionSwitchesArray) {
                this.jigs.missionSwitchesArray.forEach(function loader(switches) {
                    console.log("creating switch anim " + switches.entity_id)
                    createSwitchesAnims(scene.anims,
                        switches.entity_id,
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
