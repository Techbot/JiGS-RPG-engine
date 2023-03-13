import Phaser from "phaser";

import { SceneSelector } from "./scenes/SceneSelector";
import { Part1Scene } from "./scenes/Part1Scene";
import { Part2Scene } from "./scenes/Part2Scene";
import { Part3Scene } from "./scenes/Part3Scene";
import { Part4Scene } from "./scenes/Part4Scene";

import { BACKEND_HTTP_URL } from "./backend";

const config: Phaser.Types.Core.GameConfig = {
    type: Phaser.AUTO,
    fps: {
        target: 60,
        forceSetTimeOut: true,
        smoothStep: false,
    },
    width: 600,
    height: 400,
    // height: 200,
    backgroundColor: '#b6d53c',
    parent: 'game-container',
    physics: {
        default: "arcade"
    },
    pixelArt: true,
    scene: [SceneSelector, Part1Scene, Part2Scene, Part3Scene, Part4Scene],
};

const game = new Phaser.Game(config);

/**
 * Create FPS selector
 */

// current fps label
const fpsInput = document.querySelector<HTMLInputElement>("input#fps");
const fpsValueLabel = document.querySelector<HTMLSpanElement>("#fps-value");
fpsValueLabel.innerText = fpsInput.value;

fpsInput.oninput = function(event: InputEvent) {
    const value = (event.target as HTMLInputElement).value;
    fpsValueLabel.innerText = value;

    // destroy previous loop
    game.loop.destroy();

    // create new loop
    game.loop = new Phaser.Core.TimeStep(game, {
        target: parseInt(value),
        forceSetTimeOut: true,
        smoothStep: false,
    });

    // start new loop
    game.loop.start(game.step.bind(game));
};

/**
 * Create latency simulation selector
 */
let fetchLatencySimulationInterval: number;

// latency simulation label
const latencyInput = document.querySelector<HTMLInputElement>("input#latency");

if (latencyInput) {
    // current latency label
    const selectedLatencyLabel = document.querySelector<HTMLInputElement>("#latency-value")
    selectedLatencyLabel.innerText = `${latencyInput.value} ms`;

    latencyInput.onpointerdown = (event: PointerEvent) =>
        clearInterval(fetchLatencySimulationInterval);

    latencyInput.oninput = (event: InputEvent) =>
        selectedLatencyLabel.innerText = `${latencyInput.value} ms`;

    latencyInput.onchange = function (event: InputEvent) {
        // request server to update its latency simulation
        fetch(`${BACKEND_HTTP_URL}/simulate-latency/${latencyInput.value}`);

     //   setIntervalFetchLatencySimulation();
    };

    function setIntervalFetchLatencySimulation() {
        //
        // Keep fetching latency simulation number from server to keep all browser tabs in sync
        //
        fetchLatencySimulationInterval = setInterval(() => {
            fetch(`${BACKEND_HTTP_URL}/latency`)
                .then((response) => response.json())
                .then((value) => {
                    latencyInput.value = value;
                    latencyInput.oninput(undefined);
                });
        }, 1000);
    }
  //  setIntervalFetchLatencySimulation();
}
