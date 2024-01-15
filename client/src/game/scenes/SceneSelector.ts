import Phaser from "phaser";
// import WebFont from '../../assets/WebFont'

export class SceneSelector extends Phaser.Scene {

    // parts = {
    //     '1': "Help",
    //     '2': "Credits",
    //     '3': "Options",
    //     '4': "HEADQUARTERS",
    // };

    constructor() {
        super({ key: "selector" });
    }

    image;

    preload() {
        // update menu background color
        this.cameras.main.setBackgroundColor(0x000000);
        // this.load.addFile(new WebFont(this.load, ['Roboto', 'Neutron Demo']))
        this.load.image('einstein', '/assets/images/8b0f172a-80ed-4fbd-b357-c512127970ce.png');
        // preload demo assets
        // this.load.image('ship_0001', 'assets/ship_0001.png');
        //   this.load.image('ship_0001', 'https://cdn.glitch.global/3e033dcd-d5be-4db4-99e8-086ae90969ec/ship_0001.png?v=1649945243288');
        // this.load.sceneFile('ExternalScene', '../assets/scenes/ExternalScene.js');
    }

    create() {
        this.image = this.add.image(480, 320, 'einstein')
            .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' }).
            on("pointerdown", () => {
                this.game.scene.switch("selector", 'main');
            });


        const textStyle: Phaser.Types.GameObjects.Text.TextStyle = {
            color: "#ff0000",
            fontSize: "32px",
            fontFamily: "Neutron Demo"
        };

        // for (let partNum in this.parts) {
        //     const index = parseInt(partNum) - 1;
        //     const label = this.parts[partNum];

        //     // this.add.text(32, 32 + 32 * index, `Part ${partNum}: ${label}`, textStyle)
        //     this.add.text(80, 100 + 70 * index, `${partNum}: ${label}`, textStyle)
        //         .setInteractive()
        //         .setPadding(6)
        //         .on("pointerdown", () => {
        //             this.game.scene.switch("selector", "main");
        //         });
        // }
    }
}
