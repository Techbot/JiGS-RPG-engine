import Phaser from "phaser";

import { SceneSelector }    from "./scenes/SceneSelector";
import { MainScene }       from "./scenes/MainScene";
import { HudScene }         from "./scenes/HudScene";
import { BootScene }        from "./scenes/BootScene";
import { DeadScene }        from "./scenes/DeadScene";
import { BACKEND_HTTP_URL } from "./backend";
import RexUIPlugin from 'phaser3-rex-plugins/templates/ui/ui-plugin.js';
const config: Phaser.Types.Core.GameConfig = {
    type: Phaser.WEBGL,
    fps: {
        target: 60,
        forceSetTimeOut: true,
        smoothStep: false,
    },
    width: 640,
    height: 480,
    // height: 200,
    backgroundColor: '#000000',
    parent: 'game-container',
    physics: {
        default: "arcade"
    },
    plugins: {
        scene: [{
            key: 'rexUI',
            plugin: RexUIPlugin,
            mapping: 'rexUI'
        },
        ]
    },
    pixelArt: true,
    scene: [BootScene, SceneSelector, MainScene, DeadScene, HudScene],
};

const game = new Phaser.Game(config);
