import Phaser from "phaser";




import { SceneSelector }    from "./scenes/SceneSelector";
import { MainScene }       from "./scenes/MainScene";
import { HudScene }         from "./scenes/HudScene";
import { BootScene }        from "./scenes/BootScene";
import { BACKEND_HTTP_URL } from "./backend";

const config: Phaser.Types.Core.GameConfig = {
    type: Phaser.AUTO,
    fps: {
        target: 60,
        forceSetTimeOut: true,
        smoothStep: false,
    },
    width: 640,
    height: 480,
    // height: 200,
    backgroundColor: '#b6d53c',
    parent: 'game-container',
    physics: {
        default: "arcade"
    },
    pixelArt: true,
    scene: [BootScene, SceneSelector, MainScene, HudScene],
};

const game = new Phaser.Game(config);
