import Phaser from "phaser";

import { SceneSelector }    from "./scenes/SceneSelector";
import { MainScene }        from "./scenes/MainScene";
import { HudScene }         from "./scenes/HudScene";
import { BootScene }        from "./scenes/BootScene";
import { DeadScene }        from "./scenes/DeadScene";
import { CutScene }         from "./scenes/CutScene";
import { MessageScene }     from "./scenes/MessageScene";

import { BACKEND_HTTP_URL } from "./backend";
import RexUIPlugin from 'phaser3-rex-plugins/templates/ui/ui-plugin.js';
export const config: Phaser.Types.Core.GameConfig = {
    type: Phaser.WEBGL,
    fps: {
        target: 30,
        forceSetTimeOut: true,
        smoothStep: false,
  },
  width: 960,
  height: 640,
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
  dom: {
    createContainer: true
  },
  pixelArt: true,
  scene: [BootScene, SceneSelector, MainScene, DeadScene, HudScene, CutScene, MessageScene],
};

export function launch() {
  console.log('game launched');
  const game = new Phaser.Game(config);
}

