/**
 * ---------------------------
 * JiGS Main Scene + Colyseus -.
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
import { useJigsStore } from '../../stores/jigs';
import axios, { AxiosResponse } from "axios";

/* import { discordSDK } from '../../utils/DiscordSDK.js';
import { colyseusSDK } from '../../utils/Colyseus.js'; */
//import type { MyRoomState, Player } from '../../utils/MyRoom.ts';
//import { authenticate } from '../../utils/Auth.js';
//import { PlayerObject } from '../../objects/PlayerObject.js';

import MyPlayer from "../entities/player";
import OtherPlayer from "../entities/otherPlayer";
import Messenger from "../entities/messenger";
import Rewards from "../entities/rewards";
import Load from "../loaders/loader";
import Portals from "../entities/portals";
import Switches from "../entities/switches";
import NPCs from "../entities/npcs";
import Mobs from "../entities/mobs";
import Bosses from "../entities/bosses";
import Walls from "../entities/walls";
import Folios from "../entities/folios";
import Hydrater from '../../utils/Hydrater';

export class MainScene extends Phaser.Scene {
    room: any;
    currentPlayer: Phaser.Types.Physics.Arcade.ImageWithDynamicBody | undefined;
    playerEntities: { [sessionId: string]: any } = {};
    debugFPS: Phaser.GameObjects.Text | undefined;
    cursorKeys: Phaser.Types.Input.Keyboard.CursorKeys | undefined;

    inputPayload = {
        left: false,
        right: false,
        up: false,
        down: false,
        tick: undefined,
        mobClick: 0
    };

    elapsedTime = 0;
    fixedTimeStep = 1000 / 60;
    portal = [];
    currentTick: number = 0;
    jigs: any;
    dialogs: any;
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
    localPlayer: MyPlayer | undefined;
    otherPlayer: OtherPlayer | undefined;
    Loader: Load | undefined;
    scene: any;
    game: any;
    colliderMap: any;
    npcGroup: any;
    rewards: any;
    sys: any;
    plugins: any;
    messenger: Messenger;
    Portals: Portals;
    Switches: Switches;
    Walls: Walls;
    Mobs: Mobs;
    Bosses: Bosses;
    NPCs: NPCs;
    Rewards: Rewards;
    Folio: Folios;
    walkSound: Phaser.Sound.BaseSound;
    soundtrack: Phaser.Sound.BaseSound;
    authData: any;
    thing: boolean | undefined;
    hydrater: Hydrater;

    constructor() {
        super({ key: "main" });
        this.jigs = useJigsStore();
        this.client = new Client(BACKEND_URL);
        this.Portals = new Portals;
        this.Switches = new Switches;
        this.Walls = new Walls;
        this.NPCs = new NPCs;
        this.Mobs = new Mobs;
        this.Bosses = new Bosses;
        this.Rewards = new Rewards;
        this.Folio = new Folios;
        this.messenger = new Messenger;
        this.hydrater = new Hydrater;

    }

    preload() {
        //  var self = this;

        this.Loader = new Load;
        this.Loader.load(this);

        this.load.audio('walk', ['/assets/audio/thud.ogg', '/assets/audio/thud.mp3']);
        this.load.image('nextPage', 'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/images/arrow-down-left.png');
        //this.load.addFile(new WebFont(this.load, ['Roboto', 'Neutron Demo']))
        this.load.scenePlugin('AnimatedTiles', 'https://raw.githubusercontent.com/nkholski/phaser-animated-tiles/master/dist/AnimatedTiles.js', 'animatedTiles', 'animatedTiles');
    }

    async create() {
        var self = this;

        this.cursorKeys = this.input.keyboard.createCursorKeys();
        this.input.setDefaultCursor('url(/assets/images/cursors/blank.cur), pointer');
        this.debugFPS = this.add.text(4, 4, "", { color: "#ff0000", });
        this.jigs.room = await this.client.joinOrCreate(this.jigs.city + "-" + this.padding(this.jigs.tiled, 3, 0),
                {
                    playerId: this.jigs.playerId,
                    profileId: this.jigs.profileId,
                });
        this.messenger = new Messenger;

        /*        this.jigs.room = await colyseusSDK.joinOrCreate<MyRoomState>(this.jigs.city + "-" + this.padding(this.jigs.tiled, 3, 0),
                   {
                       channelId: discordSDK.channelId, // join by channel ID

                   }); */
        console.log("------------------room--------------------" + this.jigs.room);
        // connection successful!
        // connectionStatusText.destroy();

        console.log("***** joined successfully *****************" + this.jigs.room);

        if (this.jigs.room == undefined) {
            console.log("undefined room ");
            this.scene.start('DeadScene');
            return;
        }
        console.log("**************** Init Messages ************" + this.jigs.room);
        // this.walkSound = this.sound.add('walk', { volume: 0.03 });
        // this.soundtrack = this.sound.add(this.jigs.soundtrack, { volume: 0.06 });
        //  this.soundtrack.play();
        this.messenger.initMessages(this);
        this.jigs.room.state.players.onAdd((player, sessionId: string | number) => {
            var entity: any;
            // is current player
            if (sessionId === this.jigs.room.sessionId) {
                this.jigs.playerId = player.username;
                this.jigs.localPlayer = new MyPlayer(this, this.jigs.room, player);
                this.jigs.playerState = "alive";
                this.jigs.content = this.jigs.dialogueArray;
                this.Portals.add(this);
                // this.events.emit('content');
                //this.Rewards.add(this);
                this.Mobs.add(this);
                this.NPCs.add(this);
                this.Bosses.add(this);
                //this.Switches.add(this);
                this.Walls.add(this);
                //this.Folio.add(this);
                this.jigs.localPlayer.add();
                this.playerEntities[sessionId] = entity;
            } else {

                const otherPlayer = new OtherPlayer(this, player);
                otherPlayer.add();
                this.playerEntities[sessionId] = otherPlayer;
            }
        });
        // remove local reference when entity is removed from the server
        this.jigs.room.state.players.onRemove((player, sessionId) => {
            const entity = this.playerEntities[sessionId];
            if (entity) {
                entity.destroy();
                delete this.playerEntities[sessionId];
            }
        });
    }

    async jump() {
        console.log("********* jump up ");
        await this.updatePlayer();
        //  this.soundtrack.stop();
        console.log("********** jump down");

        var Loader = new Load;
        Loader.load(this);
        this.jigs.room.leave(); // Backend
        this.scene.start('main'); //Frontend)

    }

    updatePlayer() {
        axios
            .get("/states/myplayer?_wrapper_format=drupal_ajax")
            .then((response) => {
                //this.hydratePlayer(response);
                this.hydrater.hydratePlayer(response);
            })
            .then(() => {
                axios
                    .get("/states/mystate?_wrapper_format=drupal_ajax&mapGrid=" + this.jigs.userMapGrid)

            })
            .then((response) => {
                this.hydrater.hydrateMap(response, 1);
                //this.hydrateMap(response, 1);
            })
    }



    async connect(room) {
        // add connection status text
        const connectionStatusText = this.add
            .text(0, 0, "Trying to connect with the server...")
            .setStyle({ color: "#ff0000" })
            .setPadding(4)
        try {
            this.jigs.room = await this.client.joinOrCreate(room,
                {
                    playerId: this.jigs.playerId,
                    profileId: this.jigs.profileId,
                });
            // connection successful!
            connectionStatusText.destroy();
        } catch (e) {
            // couldn't connect
            connectionStatusText.text = "Could not connect with the server.";
        }
    }

    update(time: number, delta: number): void {

        if (this.jigs.localPlayer) {
            this.physics.world.collide(this.jigs.localPlayer, this.Walls.walls);
        }
        // skip loop if not connected yet.
        if (!this.currentPlayer || !this.playerEntities) { return; }
        this.elapsedTime += delta;
        while (this.elapsedTime >= this.fixedTimeStep) {
            this.elapsedTime -= this.fixedTimeStep;
            this.fixedTick(time, this.fixedTimeStep);
        }
        //  this.debugFPS.text = `Frame rate: ${this.game.loop.actualFps}`;
    }

    fixedTick(time, delta) {
        this.currentTick++;
        if (this.jigs.localPlayer !== undefined) {
            this.jigs.localPlayer.updatePlayer();
        }

        if (this.jigs.mobArray != undefined) {
            this.Mobs.updateMobs(this);
        }

        if (this.jigs.bossesArray != undefined) {
            this.Bosses.updateBosses(this);
        }

        ////////////////////// Update Other Players ////////////////////////////////////

        for (let sessionId in this.playerEntities) {
            if (sessionId === this.jigs.room.sessionId) {
                continue;
            }
            if (this.playerEntities[sessionId] !== undefined) {
                this.playerEntities[sessionId].update();
            }
        }
    }

    padding(n, p, c) {
        var pad_char = typeof c !== 'undefined' ? c : '0';
        var pad = new Array(1 + p).join(pad_char);
        return (pad + n).slice(-pad.length);
    }

    async portalJump(self) {
        await self.room.leave(); // Backend
        await self.scene.start('main'); //Frontend

    }

    async hide(entity) {
        entity.disableBody(true, true);
    }
}
