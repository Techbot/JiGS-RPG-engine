import Phaser from "phaser";
// import WebFont from '../../assets/WebFont'
import axios, { AxiosResponse } from "axios";
import { useJigsStore } from '../../stores/jigs';
import Hydrater from '../../utils/Hydrater';
export class SceneSelector extends Phaser.Scene {



    hydrater: Hydrater;
    jigs: any;

    // parts = {
    //     '1': "Help",
    //     '2': "Credits",
    //     '3': "Options",
    //     '4': "HEADQUARTERS",
    // };

    constructor() {
        super({ key: "selector" });
        this.jigs = useJigsStore();
        this.hydrater = new Hydrater;
    }

    image;

    preload() {
        // update menu background color
        this.cameras.main.setBackgroundColor(0x000000);
        // this.load.addFile(new WebFont(this.load, ['Roboto', 'Neutron Demo']))
        this.load.image('enter', '/assets/images/game-home.png');

    }

    create() {

        this.updatePlayerData();


        this.image = this.add.image(480, 320, 'enter')
            .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' }).
            on("pointerdown", () => {
                this.game.scene.switch("selector", 'main');
            });


        const textStyle: Phaser.Types.GameObjects.Text.TextStyle = {
            color: "#ff0000",
            fontSize: "32px",
            fontFamily: "Neutron Demo"
        };

    }
    updatePlayerData() {
        axios
            .get("/states/myplayer?_wrapper_format=drupal_ajax")
            .then((response) => {
                //this.hydratePlayer(response);
                this.hydrater.hydratePlayer(response);
                axios
                    .get("/states/mystate?_wrapper_format=drupal_ajax&mapGrid=" + this.jigs.userMapGrid)
                    .then((response) => {
                        console.log(response);
                        this.hydrater.hydrateMap(response, 1);
                    })

            })
            .then(() => {
                this.events.emit('content')
            })


    }
}
