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
import Bullet from "./bullet";


export class Part4Scene extends Phaser.Scene {
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

    currentTick: number = 0;

    constructor() {
        super({ key: "part4" });

    }

    preload() {
        this.counter = useCounterStore()

        this.load.spritesheet('brawler', '/assets/images/Sprites/4351.png', { frameWidth: 64, frameHeight: 64 })

        this.load.image('sky', '/assets/images/sky.png');

        this.load.image('ship', '/assets/images/spaceShips_001.png');
        this.load.image('otherPlayer', '/assets/images/enemyBlack5.png');
        this.load.image('star', '/assets/images/star_gold.png');
        this.load.tilemapTiledJSON('map', '/assets/json/' + this.counter.userMapGrid + '.json');

        this.load.image('celianna_TileA1', '/assets/images/Basic Tiles/celianna_TileA1.png');
        this.load.image('celianna_TileA2', '/assets/images/Basic Tiles/celianna_TileA2.png');
        this.load.image('celianna_TileA5', '/assets/images/Basic Tiles/celianna_TileA5.png');

        this.load.image('TileA1', '/assets/images/System/TileA1.png');
        this.load.image('TileA2', '/assets/images/System/TileA2.png');
        this.load.image('TileA3', '/assets/images/System/TileA3.png');
        this.load.image('TileA4', '/assets/images/System/TileA4.png');
        this.load.image('TileA5', '/assets/images/System/TileA5.png');
        this.load.image('TileB', '/assets/images/System/TileB.png');
        this.load.image('TileC', '/assets/images/System/TileC.png');
        this.load.image('TileD', '/assets/images/System/TileD.png');
        this.load.image('TileE', '/assets/images/System/TileE.png');
        this.load.image('TileF', '/assets/images/System/TileF.png');
        this.load.image('Tile001', '/assets/images/System/001.png');
        this.load.image('doors1', '/assets/images/Characters/doors1.png');
        this.load.image("gun", "/assets/images/gun.png", 5, 5);
        this.load.image("bullet", "/assets/images/star_gold.png", 5, 5);

    }

    async create() {




        this.cursorKeys = this.input.keyboard.createCursorKeys();
        this.debugFPS = this.add.text(4, 4, "", { color: "#ff0000", });



/////////////////////////////////////////////////////////////
        // Animation set
        this.anims.create({
            key: 'walkLeft',
            frames: this.anims.generateFrameNumbers('brawler', { frames: [117, 118, 119, 120, 121, 122, 123, 124, 125] }),
            frameRate: 8,
            repeat: -1
        });


        this.anims.create({
            key: 'walkRight',
            frames: this.anims.generateFrameNumbers('brawler', { frames: [143, 144, 145, 146, 147, 148, 149, 150, 151] }),
            frameRate: 8,
            repeat: -1
        });


        this.anims.create({
            key: 'walkUp',
            frames: this.anims.generateFrameNumbers('brawler', { frames: [104, 105, 106, 107, 108, 109, 110, 110, 112] }),
            frameRate: 8,
            repeat: -1
        });


        this.anims.create({
            key: 'walkDown',
            frames: this.anims.generateFrameNumbers('brawler', { frames: [130, 131, 132, 133, 134, 135, 136, 137, 138] }),
            frameRate: 8,
            repeat: -1
        });


        this.anims.create({
            key: 'walk',
            frames: this.anims.generateFrameNumbers('brawler', { frames: [130, 131, 132, 133, 134, 135, 136, 137, 138] }),
            frameRate: 8,
            repeat: -1
        });

        this.anims.create({
            key: 'kick',
            frames: this.anims.generateFrameNumbers('brawler', { frames: [10, 11, 12, 13, 10] }),
            frameRate: 8,
            repeat: -1,
            repeatDelay: 2000
        });


        ///////////////////////////////////////////////////////////////////////////
        //console.log(this.cache.tilemap.entries)
        // When loading a CSV map, make sure to specify the tileWidth and tileHeight
        var map = this.make.tilemap({ key: 'map', tileWidth: 32, tileHeight: 32 });

        var tileset1 = map.addTilesetImage('TileA1');
        var tileset2 = map.addTilesetImage('TileA2');
        var tileset3 = map.addTilesetImage('TileA3');
        var tileset4 = map.addTilesetImage('TileA4');
        var tileset5 = map.addTilesetImage('TileA5');
        var tileset6 = map.addTilesetImage('TileB');
        var tileset7 = map.addTilesetImage('TileC');
        var tileset8 = map.addTilesetImage('TileD');
        var tileset9 = map.addTilesetImage('TileE');
        var tileset10 = map.addTilesetImage('TileF');
        var tileset11 = map.addTilesetImage('celianna_TileA1');
        var tileset12 = map.addTilesetImage('celianna_TileA2');
        var tileset13 = map.addTilesetImage('celianna_TileA5');
        var tileset14 = map.addTilesetImage('doors1');

        //layer.skipCull = true;

        map.createLayer('Tile Layer 1', [tileset1, tileset2, tileset4, tileset5, tileset11, tileset12, tileset13]);
        // map.createLayer('Tile Layer 2', [ tileset1,tileset2, tileset3, tileset4, tileset5  ]);
        // create the layers we want in the right order
        map.createLayer('Tile Layer 2', [tileset1, tileset2, tileset3, tileset4, tileset5])
        map.createLayer('Tile Layer 3', [tileset8, tileset2, tileset9, tileset14]);

        // connect with the room
        await this.connect();

        this.room.state.players.onAdd((player, sessionId) => {
            const entity = this.physics.add.sprite(player.x, player.y, 'brawler');
            this.playerEntities[sessionId] = entity;

            this.gun = this.physics.add.image(player.x, player.y, 'gun');

            this.key_left = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.LEFT);
            this.key_right = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.RIGHT);
            this.key_up = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.UP);
            this.key_down = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.DOWN);




            this.bullets = this.physics.add.group({
                classType: Bullet,
                maxSize: 10,
                runChildUpdate: true
            });

            this.input.on("pointerdown", (event) => {
                let bullet = this.bullets.get();

                if (bullet) {
                    let offset = new Phaser.Geom.Point(0, -this.gun.height / 2);
                    Phaser.Math.Rotate(offset, this.gun.rotation);
                    bullet.fire(this.gun);
                }
            });


            // is current player
            if (sessionId === this.room.sessionId) {
                this.currentPlayer = entity;

                this.localRef = this.add.rectangle(0, 0, entity.width, entity.height);
                this.localRef.setStrokeStyle(1, 0x00ff00);

                this.remoteRef = this.add.rectangle(0, 0, entity.width, entity.height);
                this.remoteRef.setStrokeStyle(1, 0xff0000);

                player.onChange(() => {
                    this.remoteRef.x = player.x;
                    this.remoteRef.y = player.y;
                });

                if  (this.currentPlayer.dir == 'left'){
                    entity.play('walkLeft');
                    this.currentPlayer.dir = 'done';
                }

                if (this.currentPlayer.dir == 'right') {
                    entity.play('walkRight');
                    this.currentPlayer.dir = 'done';
                }

                if (this.currentPlayer.dir == 'up') {
                    entity.play('walkUp');
                    this.currentPlayer.dir = 'done';
                }

                if (this.currentPlayer.dir == 'down') {
                    entity.play('walkDown');
                    this.currentPlayer.dir = 'done';
                }

                //  entity.setScale(.75);
                // entity.play('walk');
                //    entity.setCollideWorldBounds(true);
                this.cameras.main.startFollow(entity);
                var cam = this.cameras.main;
                cam.setBounds(0, 0, 4096, 4096);


            } else {
                // listening for server updates
                player.onChange(() => {
                    //
                    // we're going to LERP the positions during the render loop.
                    //
                    entity.setData('serverX', player.x);
                    entity.setData('serverY', player.y);
                });

            }

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
        //this.cameras.main.setBounds(0, 0, 4096, 4096);
    }

    async connect() {
        // add connection status text
        const connectionStatusText = this.add
            .text(0, 0, "Trying to connect with the server...")
            .setStyle({ color: "#ff0000" })
            .setPadding(4)

        const client = new Client(BACKEND_URL);

        try {
            this.room = await client.joinOrCreate("part4_room", {});

            // connection successful!
            connectionStatusText.destroy();

        } catch (e) {
            // couldn't connect
            connectionStatusText.text = "Could not connect with the server.";
        }

    }

    update(time: number, delta: number): void {
        // skip loop if not connected yet.
        if (!this.currentPlayer) { return; }

        this.elapsedTime += delta;
        while (this.elapsedTime >= this.fixedTimeStep) {
            this.elapsedTime -= this.fixedTimeStep;
            this.fixedTick(time, this.fixedTimeStep);
        }

        this.debugFPS.text = `Frame rate: ${this.game.loop.actualFps}`;
    }

    fixedTick(time, delta) {
        this.currentTick++;


        if (this.key_left.isDown) {
            this.gun.angle = 180;
        } else if (this.key_right.isDown) {
            this.gun.angle = 0;
        }
        if (this.key_up.isDown) {
            this.gun.angle = 270;
        } else if (this.key_down.isDown) {
            this.gun.angle = 90;
        }
/*         this.gun.x = this.currentPlayer.x;
        this.gun.y = this.currentPlayer.y; */
        // const currentPlayerRemote = this.room.state.players.get(this.room.sessionId);
        // const ticksBehind = this.currentTick - currentPlayerRemote.tick;
        // console.log({ ticksBehind });

        const velocity = 2;
        this.inputPayload.left = this.cursorKeys.left.isDown;
        this.inputPayload.right = this.cursorKeys.right.isDown;
        this.inputPayload.up = this.cursorKeys.up.isDown;
        this.inputPayload.down = this.cursorKeys.down.isDown;
        this.inputPayload.tick = this.currentTick;
        this.room.send(0, this.inputPayload);

        if (this.inputPayload.left) {
            this.currentPlayer.x -= velocity;

            //this.playerEntities[this.room.sessionId].play('walkLeft');
            if (this.currentPlayer.dir != 'left') {
                this.currentPlayer.play('walkLeft');
                this.currentPlayer.dir = 'left';
            }

        } else if (this.inputPayload.right) {
            this.currentPlayer.x += velocity;
            //this.playerEntities[this.room.sessionId].play('walkRight');
            if (this.currentPlayer.dir != 'right') {
                this.currentPlayer.play('walkRight');
                this.currentPlayer.dir = 'right';
            }
        }

        if (this.inputPayload.up) {
            this.currentPlayer.y -= velocity;
            //this.playerEntities[this.room.sessionId].play('walkUp');
            if (this.currentPlayer.dir != 'up') {
                this.currentPlayer.play('walkUp');
                this.currentPlayer.dir = 'up';
            }

        } else if (this.inputPayload.down) {
            this.currentPlayer.y += velocity;
            //this.playerEntities[this.room.sessionId].play('walkDown');
            if (this.currentPlayer.dir != 'down') {
                this.currentPlayer.play('walkDown');
                this.currentPlayer.dir = 'down';
            }
        }

        this.gun.x = this.currentPlayer.x;
        this.gun.y = this.currentPlayer.y;


        this.localRef.x = this.currentPlayer.x;
        this.localRef.y = this.currentPlayer.y;

        for (let sessionId in this.playerEntities) {
            // interpolate all player entities
            // (except the current player)
            if (sessionId === this.room.sessionId) {
                continue;
            }

            const entity = this.playerEntities[sessionId];
            const { serverX, serverY } = entity.data.values;

            entity.x = Phaser.Math.Linear(entity.x, serverX, 0.2);
            entity.y = Phaser.Math.Linear(entity.y, serverY, 0.2);
        }



    }

}
