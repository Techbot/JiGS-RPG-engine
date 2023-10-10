import Phaser from "phaser";

export class DeadScene extends Phaser.Scene {

    parts = {
        '1': "You ",
        '2': "Are ",
        '3': "Dead",

    };

    constructor() {
        super({ key: "DeadScene" });
    }

    image;

    preload() {
        // update menu background color
        this.cameras.main.setBackgroundColor(0x000000);
        this.load.image('tesla', '/assets/images/84a42d08-8165-4111-aec7-edd1d0d4900d.png');
        // preload demo assets
        // this.load.image('ship_0001', 'assets/ship_0001.png');
        // this.load.image('ship_0001', 'https://cdn.glitch.global/3e033dcd-d5be-4db4-99e8-086ae90969ec/ship_0001.png?v=1649945243288');
    }

    create() {

        this.image = this.add.image(320, 240, 'tesla');
        // automatically navigate to hash scene if provided
        if (window.location.hash) {
            this.runScene(window.location.hash.substring(1));
            return;
        }

        const textStyle: Phaser.Types.GameObjects.Text.TextStyle = {
            color: "#ff0000",
            fontSize: "32px",
            // fontSize: "24px",
            fontFamily: "Arial"
        };

        for (let partNum in this.parts) {
            const index = parseInt(partNum) - 1;
            const label = this.parts[partNum];
            // this.add.text(32, 32 + 32 * index, `Part ${partNum}: ${label}`, textStyle)
            this.add.text(80, 100 + 70 * index, `${partNum}: ${label}`, textStyle)
                .setInteractive()
                .setPadding(6)
                .on("pointerdown", () => {
                    this.game.scene.switch("DeadScene", "main")
                });
        }
    }
}
