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
import Player from "../entities/player";
import Messenger from "../entities/messenger";
//import NPC from "../entities/npc";
//import Mob from "../entities/mob";
import Reward from "../entities/reward";
import Load from "../entities/loader";
import Portals from "../entities/portals";
import { createCharacterAnims } from "../entities/anim";
import axios from "axios";

export class MainScene extends Phaser.Scene {
    room: Room;
    currentPlayer: Phaser.Types.Physics.Arcade.ImageWithDynamicBody;
    playerEntities: { [sessionId: string]: Phaser.Types.Physics.Arcade.ImageWithDynamicBody } = {};
    debugFPS: Phaser.GameObjects.Text;
    //localRef: Phaser.GameObjects.Rectangle;
    // remoteRef: Phaser.GameObjects.Rectangle;
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
    Loader: Load;
    scene: any;
    game: any;
    colliderMap: any;
    npcArray: any;
    rewards: any;
    rewardsArray: any;
    rewardsGroup: any;
    NPCcontainer: any;
    SceneNpcArray: any;
    SceneNpcNameArray: any;
    NpcContainerArray: any;
    MobContainerArray: any;
    SceneMobArray: any;
    mobArray: any;
    SceneMobHealthBarArray: any;
    SceneMobNameArray: any[];
    sys: any;
    plugins: any;
    messenger: Messenger;
    walkSound: Phaser.Sound.BaseSound;

    constructor() {
        super({ key: "main" });
        this.jigs = useJigsStore();
        this.client = new Client(BACKEND_URL);
        this.localPlayer = new Player(this.room, this.scene);
        this.rewardsArray = new Array;
        this.rewardsArray = new Array;
        this.NpcContainerArray = new Array;
        this.MobContainerArray = new Array;
        this.SceneNpcArray = new Array;
        this.SceneMobArray = new Array;
        this.SceneNpcNameArray = new Array;
        this.SceneMobHealthBarArray = new Array;
        this.SceneMobNameArray = new Array;
    }

    preload() {
        var self = this;
        this.Loader = new Load;
        this.messenger = new Messenger;
        this.Loader.load(self);
        this.load.audio('walk', ['/assets/audio/thud.ogg', '/assets/audio/thud.mp3']);
        this.load.image('nextPage', 'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/images/arrow-down-left.png');
        // this.load.script('webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js');
        this.load.addFile(new WebFont(this.load, ['Roboto', 'Neutron Demo']))
        this.load.scenePlugin('AnimatedTiles', 'https://raw.githubusercontent.com/nkholski/phaser-animated-tiles/master/dist/AnimatedTiles.js', 'animatedTiles', 'animatedTiles');
    }

    async create() {
        var self = this;
        this.cursorKeys = this.input.keyboard.createCursorKeys();
        this.input.setDefaultCursor('url(/assets/images/cursors/blank.cur), pointer');
        this.debugFPS = this.add.text(4, 4, "", { color: "#ff0000", });
        // connect with the room

        await this.connect(this.jigs.city + "-" + this.padding(this.jigs.tiled, 3, 0));

        this.walkSound = this.sound.add('walk', { volume: 0.1 });
        this.messenger.initMessages(self);

        this.room.state.players.onAdd((player, sessionId) => {
            var entity: any;
            // is current player
            if (sessionId === this.room.sessionId) {
                self.jigs.playerState = "alive";
                this.localPlayer.addLocalPlayer(this, player, entity, this.colliderMap);

                this.jigs.content = "City: " + this.jigs.city;

                self.events.emit('content');

                this.addRewards();
                this.addNpc();
                this.addMobs();
            } else {
                entity = this.physics.add.sprite(player.x, player.y, 'otherPlayer').setDepth(5).setScale(.85);
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
                delete this.playerEntities[sessionId];
            }
        });
        // this.cameras.main.setZoom(1);
    }

    addRewards() {
        this.rewardsGroup = this.physics.add.group({ allowGravity: false });
        let a = 0;
        if (typeof this.jigs.rewardsArray !== 'undefined') {
            while (a < this.jigs.rewardsArray.length) {
                this.rewardsArray[a] = new Reward(this, this.jigs.rewardsArray[a]);
                this.rewardsGroup.add(this.rewardsArray[a], true);
                a++;
            }
        }
    }

    addNpc() {
        this.npcArray = this.physics.add.group({ allowGravity: false });
        if (typeof this.jigs.npcArray !== 'undefined') {
            let i = 0;
            while (i < this.jigs.npcArray.length) {
                this.NpcContainerArray[i] = this.add.container(parseInt(this.jigs.npcArray[i][1]), parseInt(this.jigs.npcArray[i][2]));
                this.SceneNpcArray[i] = this.add.sprite(0, 0, 'npc' + this.jigs.npcArray[i][3])
                    .setScale(.85)
                    .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
                    .setData("levelindex", this.jigs.npcArray[i][1])
                    .on('pointerdown', this.onNPCDown.bind(this, this.jigs.npcArray[i]));

                this.SceneNpcNameArray[i] = this.add.text(10, -10, this.jigs.npcArray[i][0], {
                    font: "12px Neutron Demo",
                    fill: 'white',
                    fontStyle: 'strong',
                    backgroundColor: 'rgba(0, 0, 0, 0.6)',
                }).setPadding({ left: 1, right: 1, top: 1, bottom: 1 });

                this.NpcContainerArray[i].add(this.SceneNpcArray[i]);
                this.NpcContainerArray[i].add(this.SceneNpcNameArray[i]);
                this.NpcContainerArray[i].setDepth(5);
                this.SceneNpcArray[i].anims.play('walkDown_npc' + this.jigs.npcArray[i][3]);
                this.npcArray.add(this.NpcContainerArray[i], true);
                i++;
            }
        }
    }

    addMobs() {
        this.mobArray = this.physics.add.group({ allowGravity: false });
        if (typeof this.jigs.mobArray !== 'undefined') {
            let i = 0;
            while (i < this.jigs.mobArray.length) {
                this.MobContainerArray[i] = this.add.container(parseInt(this.jigs.mobArray[i][2]), parseInt(this.jigs.mobArray[i][3]));
                this.add.existing(this.add.sprite(0, 0, 'mob' + this.jigs.mobArray[i][4]));
                this.SceneMobArray[i] = this.add.sprite(0, 0, 'mob' + this.jigs.mobArray[i][4])
                    .setInteractive({ cursor: 'url(/assets/images/cursors/attack.cur), pointer' })
                    .setScale(.85)
                    .setData("levelindex", this.jigs.mobArray[i][1])
                    .on('pointerdown', this.onMobDown.bind(this, this.jigs.mobArray[i]));
                this.SceneMobArray[i].anims.play('walkDown_mob' + this.jigs.mobArray[i][4]);
                this.SceneMobHealthBarArray[i] = this.add.image(0, -30, 'healthBar');
                this.SceneMobHealthBarArray[i].displayWidth = 25;
                this.MobContainerArray[i].add(this.SceneMobArray[i]);
                this.MobContainerArray[i].add(this.SceneMobHealthBarArray[i]);
                this.MobContainerArray[i].setDepth(6);
                this.mobArray.add(this.MobContainerArray[i], true);
                i++;
            }
        }
    }

    onNPCDown(npc, img) {
        if (npc[5] == 1) {
            axios
                .get("/my_mission?_wrapper_format=drupal_ajax&npc=" + npc[6])
                .then((response) => {
                    console.log("");
                    this.hydrateMission(response);
                    this.events.emit('Mission',npc);
                })
        }
        else {
            this.jigs.npc = 1;
            this.jigs.content = npc[4];
            this.events.emit('content');
        }
    }

    onMobDown(mob, img) {
        this.jigs.mobClick = mob[1];
        this.jigs.mobShoot = mob[1];
        this.jigs.playerStats.credits++;
    }

    incrementReward() { return; }

    jump() {
        axios
            .get("/mystate?_wrapper_format=drupal_ajax")
            .then((response) => {
                console.log("jump");
                this.hydrate(response,1);
                var Loader = new Load;
                Loader.load(this);
                //portalJump(this);
                this.room.leave(); // Backend
                this.scene.start('main'); //Frontend)
            })
    }

    updateState() {
        if (this.jigs.playerState == "alive") {
            this.jigs.hydrate(0);
            axios
                .get("/mystate?_wrapper_format=drupal_ajax")
                .then((response) => {
                    this.hydrate(response, 0);
                })
      }
    }

    hydrate(response, incMob) {
                this.jigs.playerStats = response.data[0].value["player"];
                this.jigs.playerId = parseInt(response.data[0].value["player"]["id"]);
                this.jigs.playerName = response.data[0].value["player"]["name"];

                this.jigs.gameState = response.data[0].value["player"]["userState"];
                this.jigs.userMapGrid = parseInt(response.data[0].value["player"]["userMG"]);

                this.jigs.tiled = parseInt(response.data[0].value["MapGrid"]["tiled"]);
                this.jigs.mapWidth = parseInt(response.data[0].value["MapGrid"]["mapWidth"]);
                this.jigs.mapHeight = parseInt(response.data[0].value["MapGrid"]["mapHeight"]);
                this.jigs.portalsArray = response.data[0].value["MapGrid"]["portalsArray"];
                this.npcArray = response.data[0].value["MapGrid"]["npcArray"];
                if (incMob) {
                    this.mobArray = response.data[0].value["MapGrid"]["mobArray"];
                }
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
        this.jigs.dialogTitle   = response.data[0].value["dialogTitle"];
        this.jigs.dialogContent = parseInt(response.data[0].value["dialogContent"]);
        this.jigs.dialogChoices = response.data[0].value["dialogChoices"];
    }

    async connect(room) {
        // add connection status text
        const connectionStatusText = this.add
            .text(0, 0, "Trying to connect with the server...")
            .setStyle({ color: "#ff0000" })
            .setPadding(4)
        try {
            this.room = await this.client.joinOrCreate(room,
                { playerId: this.jigs.playerId });
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
        }
        if (this.jigs.mobArray != undefined) {
            let i = 0;
            while (i < this.MobContainerArray.length) {
                if (this.jigs.mobArray[i] != undefined) {
                    this.MobContainerArray[i].x = this.jigs.mobArray[i][2];
                    this.MobContainerArray[i].y = this.jigs.mobArray[i][3];
                    this.SceneMobHealthBarArray[i].displayWidth = this.jigs.mobArray[i][6] / 4;
                }
                i++;
            };
        }

        for (let sessionId in this.playerEntities) {
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
