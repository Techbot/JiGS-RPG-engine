/**
 * ---------------------------
 * Phaser + Colyseus - Part 4.
 * ---------------------------
 * - Connecting with the room
 * - Sending inputs at the user's framerate
 * - Update other player's positions WITH interpolation (for other players)
 * - Client-predicted input for local (current) player
 * - Fixed tickrate on both client and server
 */

import Phaser from "phaser";
import { Room, Client } from "colyseus.js";
import { BACKEND_URL } from "../backend";
import { useCounterStore } from '../../stores/counter';
import Player from "../entities/player";
import SpriteLoad from "../entities/sprite";
import Portals from "../entities/portals";
import {createCharacterAnims} from "../entities/anim";
import axios from "axios";

export class MainScene extends Phaser.Scene {
    room: Room;
    currentPlayer: Phaser.Types.Physics.Arcade.ImageWithDynamicBody;
    playerEntities: { [sessionId: string]: Phaser.Types.Physics.Arcade.ImageWithDynamicBody } = {};
    debugFPS: Phaser.GameObjects.Text;
    localRef: Phaser.GameObjects.Rectangle;
    remoteRef: Phaser.GameObjects.Rectangle;
    cursorKeys: Phaser.Types.Input.Keyboard.CursorKeys;

    inputPayload = {
        left: false,
        right: false,
        up: false,
        down: false,
        tick: undefined,
    };

    elapsedTime = 0;
    fixedTimeStep = 1000 / 60;
    portal = [];
    currentTick: number = 0;
    counter: any;
    load: any;
    input: any;
    add: any;
    anims: any;
    make: any;
    physics: any;
    key_left: any;
    key_up: any;
    key_right: any;
    key_down: any;
    bullets: any;
    cameras: any;
    client: Client;
    localPlayer: Player;
    SpriteLoader: SpriteLoad;
    scene: any;

    constructor() {
        super({ key: "main" });
        this.counter = useCounterStore();
        this.client = new Client(BACKEND_URL);
        this.localPlayer = new Player;
    }

    preload() {

    }

    async create() {
        var self = this;
        // const portals = new Portals;
        // portals.addPortals(self);
        this.SpriteLoader = new SpriteLoad;
        this.SpriteLoader.loadSprites(self);

        this.cursorKeys = this.input.keyboard.createCursorKeys();
        this.debugFPS = this.add.text(4, 4, "", { color: "#ff0000", });
        // connect with the room
        await this.connect(this.counter.city + "-" + padding(this.counter.tiled, 3, 0));

        //await this.connect('Dublin-001');
        /*  this.room.onStateChange((state) => {
                    console.log("the room state has been updated:", state);
        }); */

        var self = this;
        this.room.onMessage("portal", (message) => {
            console.log("message received from server");
            console.log(message);
            const promise1 = Promise.resolve(this.increment());
            self.counter.tiled = message;
            //  hide(this.localPlayer);

        });
        //const Anims = new Anim;
        //Anims.addAnim(this);
        createCharacterAnims(this.anims);

        this.room.state.players.onAdd((player, sessionId) => {
            var entity: any;
            // is current player
            if (sessionId === this.room.sessionId) {
                this.localPlayer.addLocalPLayer(this, player, entity);
                //  self.physics.add.overlap(player, this.portals, hidePortal, null, self);
            } else {
                entity = this.physics.add.sprite(player.x, player.y, 'brawler2');
                // listening for server updates
                player.onChange(() => {
                    //
                    // we're going to LERP the positions during the render loop.
                    //
                    entity.setData('serverX', player.x);
                    entity.setData('serverY', player.y);
                });
            }
            this.playerEntities[sessionId] = entity;
        });

        // remove local reference when entity is removed from the server
        this.room.state.players.onRemove((player, sessionId) => {
            const entity = this.playerEntities[sessionId];
            if (entity) {
                entity.destroy();
                delete this.playerEntities[sessionId]
            }
        });
        this.cameras.main.setZoom(1.25);
        //this.cameras.main.setBounds(0, 0, 4096, 4096);
    }

    increment() {
        console.log("increment");
        axios
            .get("https://www.eclecticmeme.com/mystate?_wrapper_format=drupal_ajax")
            .then((response) => {
                this.counter.gameState = response.data[0].value["userGamesState"];
                this.counter.userMapGrid = parseInt(response.data[0].value["userMapGrid"]);
                this.counter.tiled = parseInt(response.data[0].value["Tiled"]);
                this.counter.portalsArray = response.data[0].value["portalsArray"];
                this.counter.NPCArray = response.data[0].value["NPCArray"];
                this.counter.nodeTitle = response.data[0].value["Name"];
                this.counter.city = response.data[0].value["City"];

                this.counter.tilesetArray_1 = response.data[0].value["tilesetArray_1"];
                this.counter.tilesetArray_2 = response.data[0].value["tilesetArray_2"];
                this.counter.tilesetArray_3 = response.data[0].value["tilesetArray_3"];
                this.counter.tilesetArray_4 = response.data[0].value["tilesetArray_4"];
                this.counter.tilesetArray_5 = response.data[0].value["tilesetArray_5"];
                var SpriteLoader = new SpriteLoad;
                SpriteLoader.loadSprites(this);
                //portalJump(this);
                this.room.leave(); // Backend
                this.scene.start('main'); //Frontend
            });

        return true;
    }


    async connect(room) {
        // add connection status text
        const connectionStatusText = this.add
            .text(0, 0, "Trying to connect with the server...")
            .setStyle({ color: "#ff0000" })
            .setPadding(4)
        try {
            this.room = await this.client.joinOrCreate(room, {});
            // connection successful!
            connectionStatusText.destroy();
        } catch (e) {
            // couldn't connect
            connectionStatusText.text = "Could not connect with the server.";
        }
    }

    update(time: number, delta: number): void {
        // skip loop if not connected yet.
        if (!this.currentPlayer || !this.playerEntities) { return; }
        this.elapsedTime += delta;
        while (this.elapsedTime >= this.fixedTimeStep) {
            this.elapsedTime -= this.fixedTimeStep;
            this.fixedTick(time, this.fixedTimeStep);
        }
        this.debugFPS.text = `Frame rate: ${this.game.loop.actualFps}`;
    }

    fixedTick(time, delta) {
        this.currentTick++;

        if (this.localPlayer !== undefined) {

            this.localPlayer.updatePlayer(this);
            // const currentPlayerRemote = this.room.state.players.get(this.room.sessionId);
            // const ticksBehind = this.currentTick - currentPlayerRemote.tick;
            // console.log({ ticksBehind });
            for (let sessionId in this.playerEntities) {
                // interpolate all player entities
                // (except the current player)
                if (sessionId === this.room.sessionId) {
                    continue;
                }

                if (this.playerEntities[sessionId] !== undefined) {
                    const entity = this.playerEntities[sessionId];
                    if (entity.data) {
                        const { serverX, serverY } = entity.data.values;
                        entity.x = Phaser.Math.Linear(entity.x, serverX, 0.2);
                        entity.y = Phaser.Math.Linear(entity.y, serverY, 0.2);
                    }

                }

            }
        }
    }
}

function padding(n, p, c) {
    var pad_char = typeof c !== 'undefined' ? c : '0';
    var pad = new Array(1 + p).join(pad_char);
    return (pad + n).slice(-pad.length);
}

async function portalJump(self) {
    await self.room.leave(); // Backend
    await self.scene.start('main'); //Frontend

}

async function hide(entity) {
    entity.disableBody(true, true);
}
