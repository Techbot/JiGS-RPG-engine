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
import WebFont from '../../assets/WebFont'
import { Room, Client } from "colyseus.js";
import { BACKEND_URL } from "../backend";
import { useJigsStore } from '../../stores/jigs';
import axios from "axios";
import Player from "../entities/player";
import OtherPlayer from "../entities/otherPlayer.js";

import Messenger from "../entities/messenger";
import Rewards from "../entities/rewards";
import Portals from "../entities/portals";
import Switches from "../entities/switches";
import NPCs from "../entities/npcs";
import Mobs from "../entities/mobs";
import Bosses from "../entities/bosses";
import Walls from "../entities/walls";
import Folios from "../entities/folios";
import Load from "../loaders/loader";
import Hydrater from '../../utils/Hydrater';

export class MainScene extends Phaser.Scene {
    room: Room;
    currentPlayer: Phaser.Types.Physics.Arcade.ImageWithDynamicBody;
    playerEntities: { [sessionId: string]: any } = {};
    debugFPS: Phaser.GameObjects.Text;
    cursorKeys: Phaser.Types.Input.Keyboard.CursorKeys;

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
    localPlayer: Player;
    otherPlayer: OtherPlayer | undefined;
    Loader: Load;
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
        this.hydrater = new Hydrater;
    }

    preload() {
        //  var self = this;
        this.Loader = new Load;
        this.messenger = new Messenger;
        this.Loader.load(this);
        this.load.audio('walk', ['/assets/audio/thud.ogg', '/assets/audio/thud.mp3']);
        this.load.image('nextPage', 'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/images/arrow-down-left.png');
        this.load.addFile(new WebFont(this.load, ['Roboto', 'Neutron Demo']))
        this.load.scenePlugin('AnimatedTiles', 'https://raw.githubusercontent.com/nkholski/phaser-animated-tiles/master/dist/AnimatedTiles.js', 'animatedTiles', 'animatedTiles');
    }

    async create() {
        var self = this;
        this.cursorKeys = this.input.keyboard.createCursorKeys();
        this.input.setDefaultCursor('url(/assets/images/cursors/blank.cur), pointer');
        this.debugFPS = this.add.text(4, 4, "", { color: "#ff0000", });
        // connect with the room
        //    const room =  await this.connect(this.jigs.city + "-" + this.padding(this.jigs.tiled, 3, 0));

        //      console.log("room" + room);

        try {
            const room = await this.connect(this.jigs.city + "-" + this.padding(this.jigs.tiled, 3, 0));
            console.log("joined successfully " + this.room);

            if (this.room == undefined) {
                console.log("undefined room ");
                this.scene.start('DeadScene');
                return;
            }
        } catch (e) {
            console.error("join error", e);
            this.scene.start('SceneSelector');
        }

        this.walkSound = this.sound.add('walk', { volume: 0.03 });
        this.soundtrack = this.sound.add(this.jigs.soundtrack, { volume: 0.06 });
        this.soundtrack.play();
        this.messenger.initMessages(this);
        this.room.state.players.onAdd((player, sessionId) => {
            this.localPlayer = new Player(this, this.room, player);
            var entity: any;
            // is current player
            if (sessionId === this.room.sessionId) {
                this.jigs.playerState = "alive";
                this.jigs.content = this.jigs.dialogueArray;
                this.events.emit('content');
                this.Rewards.add(this);
                this.NPCs.add(this);
                this.Mobs.add(this);
                this.Bosses.add(this);
                this.Portals.add(this);
                this.Switches.add(this);
                this.Walls.add(this);
                this.Folio.add(this);
                this.localPlayer.add();
                this.playerEntities[sessionId] = entity;
            } else {


/*

                entity = this.physics.add.sprite(player.x, player.y, 'otherPlayer').setDepth(5).setScale(.85);
                // listening for server updates
                player.onChange(() => {
                    //
                    // we're going to LERP the positions during the render loop.
                    //
                    entity.setData('serverX', player.x);
                    entity.setData('serverY', player.y);
                }); */

                const otherPlayer = new OtherPlayer(this, player);
                otherPlayer.add();
                this.playerEntities[sessionId] = otherPlayer;
            }
            this.playerEntities[sessionId] = entity;
        });
        // remove local reference when entity is removed from the server
        this.room.state.players.onRemove((player, sessionId) => {
            const entity = this.playerEntities[sessionId];
            if (entity) {
                entity.destroy();
                delete this.playerEntities[sessionId];
            }
        });
    }

/*     jumpOLD() {
        axios
            .get("/mystate?_wrapper_format=drupal_ajax")
            .then((response) => {
                this.soundtrack.stop();
                console.log("jump");
                this.hydrate(response, 1);
                var Loader = new Load;
                Loader.load(this);
                this.room.leave(); // Backend
                this.scene.start('main'); //Frontend)
            })
    } */

    async jump() {
        console.log("********* jump up ");
        await this.updatePlayer();
        //  this.soundtrack.stop();
        console.log("********** jump down");
    }

    updatePlayer() {
        axios
            .get("states/myplayer?_wrapper_format=drupal_ajax")
            .then((response) => {
                //this.hydratePlayer(response);
                this.hydrater.hydratePlayer(response);
                this.updateMapState();
            })
    }

    updateMapState() {
        axios
            .get("states/mystate?_wrapper_format=drupal_ajax")
            .then((response) => {
                this.hydrater.hydrateMap(response, 1);
                //this.hydrateMap(response, 1);
                var Loader = new Load;
                Loader.load(this);
                this.jigs.room.leave(); // Backend
                this.scene.start('main'); //Frontend)
            })
    }


/*     updateStateOLD() {
        if (this.jigs.playerState == "alive") {
            axios
                .get("/mystate?_wrapper_format=drupal_ajax")
                .then((response) => {
                    this.hydrater.hydrate(response, 0);
                })
        }
    } */







    hydrate(response, incMob) {
        this.jigs.playerStats = response.data[0].value["player"];
        this.jigs.playerId = parseInt(response.data[0].value["player"]["id"]);
        this.jigs.profileId = parseInt(response.data[0].value["player"]["profileId"]);
        this.jigs.playerName = response.data[0].value["player"]["name"];

        //this.jigs.gameState     = response.data[0].value["player"]["userState"];
        this.jigs.userMapGrid = parseInt(response.data[0].value["player"]["userMG"]);

        this.jigs.tiled = parseInt(response.data[0].value["MapGrid"]["tiled"]);
        this.jigs.soundtrack = response.data[0].value["MapGrid"]["soundtrack"];
        this.jigs.mapWidth = parseInt(response.data[0].value["MapGrid"]["mapWidth"]);
        this.jigs.mapHeight = parseInt(response.data[0].value["MapGrid"]["mapHeight"]);
        this.jigs.portalsArray = response.data[0].value["MapGrid"]["portalsArray"];

        if (response.data[0].value["MapGrid"]["switchesArray"]) {
            this.jigs.switchesArray = response.data[0].value["MapGrid"]["switchesArray"];
        }

        this.jigs.dialogueArray = response.data[0].value["MapGrid"]["dialogueArray"];
        this.jigs.fireArray = response.data[0].value["MapGrid"]["fireArray"];
        this.jigs.fireBarrelsArray = response.data[0].value["MapGrid"]["fireBarrelsArray"];
        this.jigs.leverArray = response.data[0].value["MapGrid"]["leverArray"];
        this.jigs.machineArray = response.data[0].value["MapGrid"]["machineArray"];
        this.jigs.crystalArray = response.data[0].value["MapGrid"]["crystalArray"];
        this.jigs.foliosArray = response.data[0].value["MapGrid"]["foliosArray"];
        this.jigs.wallsArray = response.data[0].value["MapGrid"]["wallsArray"];
        this.jigs.npcArray = response.data[0].value["MapGrid"]["npcArray"];
        if (incMob) {
            this.jigs.mobArray = response.data[0].value["MapGrid"]["mobArray"];
        }
        this.jigs.bossesArray = response.data[0].value["MapGrid"]["bossesArray"];

        this.jigs.rewardsArray = response.data[0].value["MapGrid"]["rewardsArray"];
        this.jigs.nodeTitle = response.data[0].value["MapGrid"]["name"];
        this.jigs.tilesetArray_1 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_1"];
        this.jigs.tilesetArray_2 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_2"];
        this.jigs.tilesetArray_3 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_3"];
        this.jigs.tilesetArray_4 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_4"];
        this.jigs.city = response.data[0].value["City"];
        // Regex replaces close/open p with \n new line
        // And replaces all other html tags with null.
        this.jigs.debug = parseInt(response.data[0].value["gameConfig"]["Debug"]);
        this.jigs.content = response.data[0].value["gameConfig"]["Body"].replaceAll('</p><p>', '\n').replaceAll(/(<([^>]+)>)/ig, '');
    }

    hydrateMission(response) {
        this.jigs.title = response.data[0].value["title"];
        this.jigs.missionHandlerDialog = response.data[0].value["handler_dialog"];
        let no = { text: 'No I am not ready.', value: 0 }
        let yes = { text: response.data[0].value["choice"], value: response.data[0].value["value"] };
        this.jigs.choice = new Array;
        this.jigs.choice.push(yes);
        this.jigs.choice.push(no);
        // console.log(this.jigs.choice);
    }


    hydrateSwitches(response, id) {
        this.jigs.switchesArray.push(id);
        //this.updatePhaser
    }

    async connect(room) {
        // add connection status text
        const connectionStatusText = this.add
            .text(0, 0, "Trying to connect with the server...")
            .setStyle({ color: "#ff0000" })
            .setPadding(4)
        try {
            this.room = await this.client.joinOrCreate(room,
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

        if (this.localPlayer) {
            this.physics.world.collide(this.localPlayer, this.Walls.walls);
        }
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
            this.localPlayer.updatePlayer();
        }

        if (this.jigs.mobArray != undefined) {
            this.Mobs.updateMobs(this);
        }

        if (this.jigs.bossesArray != undefined) {
            this.Bosses.updateBosses(this);
        }
        ////////////////////// Update Other Players ////////////////////////////////////

        for (let sessionId in this.playerEntities) {
            if (sessionId === this.room.sessionId) {
                continue;
            }
            if (this.playerEntities[sessionId] !== undefined) {



                this.playerEntities[sessionId].update();


/*                 const entity = this.playerEntities[sessionId];
                if (entity.data) {
                    const { serverX, serverY } = entity.data.values;
                    entity.x = Phaser.Math.Linear(entity.x, serverX, 0.2);
                    entity.y = Phaser.Math.Linear(entity.y, serverY, 0.2);
                }
 */




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
