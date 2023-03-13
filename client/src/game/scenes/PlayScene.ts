/**
 * ---------------------------
 * Phaser + Colyseus - Part 1.
 * ---------------------------
 * - Connecting with the room
 * - Sending inputs at the user's framerate
 * - Update each player's positions WITHOUT interpolation
 */

import Phaser from "phaser";
import { Room, Client } from "colyseus.js";
import { BACKEND_URL } from "../backend";
import Bullets from "./bullets"

export class PlayScene extends Phaser.Scene {
    room: Room;
    playerEntities: { [sessionId: string]: Phaser.Types.Physics.Arcade.ImageWithDynamicBody } = {};

    debugFPS: Phaser.GameObjects.Text;

    cursorKeys: Phaser.Types.Input.Keyboard.CursorKeys;

    inputPayload = {
        left: false,
        right: false,
        up: false,
        down: false,
    };

    constructor() {
        super({ key: "PlayScene" });
        this.bullets;
    }

    async create() {
        this bullets = new Bullets(this);
        this.cursorKeys = this.input.keyboard.createCursorKeys();
        this.debugFPS = this.add.text(4, 4, "", { color: "#ff0000", });

        this.input.on('pointerdown', (pointer) => {

            this.bullets.fireBullet(this.ship.x, this.ship.y);

        });
        // connect with the room
        await this.connect();

        this.room.state.players.onAdd((player, sessionId) => {
            const entity = this.physics.add.image(player.x, player.y, 'ship_0001');
            this.playerEntities[sessionId] = entity;

            // listening for server updates
            player.onChange(() => {
                //
                // update local position immediately
                // (WE WILL CHANGE THIS ON PART 2)
                //
                entity.x = player.x;
                entity.y = player.y;
            });
        });

        // remove local reference when entity is removed from the server
        this.room.state.players.onRemove((player, sessionId) => {
            const entity = this.playerEntities[sessionId];
            if (entity) {
                entity.destroy();
                delete this.playerEntities[sessionId]
            }
        });

        // this.cameras.main.startFollow(this.ship, true, 0.2, 0.2);
        // this.cameras.main.setZoom(1);
        this.cameras.main.setBounds(0, 0, 800, 600);
    }

    async connect() {
        // add connection status text
        const connectionStatusText = this.add
            .text(0, 0, "Trying to connect with the server...")
            .setStyle({ color: "#ff0000" })
            .setPadding(4)

        const client = new Client(BACKEND_URL);

        try {
            this.room = await client.joinOrCreate("state_handler", {});

            // connection successful!
            connectionStatusText.destroy();

        } catch (e) {
            // couldn't connect
            connectionStatusText.text = "Could not connect with the server.";
        }

    }

    update(time: number, delta: number): void {
        // skip loop if not connected with room yet.
        if (!this.room) {
            return;
        }

        // send input to the server
        this.inputPayload.left = this.cursorKeys.left.isDown;
        this.inputPayload.right = this.cursorKeys.right.isDown;
        this.inputPayload.up = this.cursorKeys.up.isDown;
        this.inputPayload.down = this.cursorKeys.down.isDown;
        this.room.send(0, this.inputPayload);

        this.debugFPS.text = `Frame rate: ${this.game.loop.actualFps}`;
    }

}
