/**
 * -------Player ---------
 */
import Phaser from "phaser";
import Drones from "../entities/drones";
import Gun from "../entities/gun";
import Sword from "../entities/sword";
import Light from "../entities/light";

import PlayerMovement from "../entities/player_movement";
import { useJigsStore } from '../../stores/jigs';

export default class Player {

    colliderMap: any;
    light: any;
    drones: any;
    jigs: any;
    room: any;
    staticNum: number;
    walls: any;
    entity: any;
    gun: Gun;
    sword: Sword;
    playerMovement: PlayerMovement;
    keyW: any;
    keyA: any;
    keyS: any;
    keyD: any;
    x: any;
    y: any;
    scene: any;
    player: any;

    constructor(scene, room, player) {
        this.scene = scene;
        this.room = room;
        this.player = player;
        this.jigs = useJigsStore();
        this.playerMovement = new PlayerMovement(scene);
        this.staticNum = 0;

        this.entity = scene.physics.add.sprite(player.x, player.y, this.jigs.playerStats.sprite_sheet)
            .setDepth(7)
            .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
            .on('pointerdown', this.onPlayerDown.bind(scene))
            .setScale(.85)
    }

    add() {

        this.x = this.player.x;
        this.y = this.player.y;
        this.light = new Light(this.scene, this.player.x, this.player.y, null);
        this.gun = new Gun(this.scene, this.player.x, this.player.y, 'gun');
        this.sword = new Sword(this.scene, this.player.x, this.player.y, null);
        this.drones = new Drones(this.scene, this.player.x, this.player.y);

        this.scene.lights.enable().setAmbientColor(0x555555);
        this.scene.physics.add.existing(this.entity);
        this.scene.physics.world.enable([this.entity]);
        this.scene.cameras.main.startFollow(this.entity);
        this.scene.currentPlayer = this.entity;

        if (this.jigs.debug) {
            this.scene.localRef = this.scene.add.rectangle(0, 0, 32, 40).setDepth(7);
            this.scene.localRef.setStrokeStyle(1, 0x00ff00);
            this.scene.remoteRef = this.scene.add.rectangle(0, 0, 32, 40).setDepth(8);
            this.scene.remoteRef.setStrokeStyle(1, 0xff0000);
        }
        this.player.onChange(() => {
            if (this.jigs.debug) {
                this.scene.remoteRef.x = this.player.x;
                this.scene.remoteRef.y = this.player.y;
                this.scene.localRef.x = this.scene.currentPlayer.x;
                this.scene.localRef.y = this.scene.currentPlayer.y;
            }
            this.lerp(this.player);
        });

        var cam = this.scene.cameras.main;
        cam.setBounds(0, 0, this.jigs.mapWidth * 16, this.jigs.mapHeight * 16);

        this.scene.key_left = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.LEFT);
        this.scene.key_right = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.RIGHT);
        this.scene.key_up = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.UP);
        this.scene.key_down = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.DOWN);
        this.scene.keyW = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.W);
        this.scene.keyA = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.A);
        this.scene.keyS = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.S);
        this.scene.keyD = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.D);

        this.scene.input.on("pointerdown", (event) => {
            this.sword.strike(this.scene.currentPlayer);
            this.gun.shoot(this.scene, event);
            //Send Mouse Co-ordinates from World point of view
            this.scene.inputPayload.inputX = parseInt(event.worldX);
            this.scene.inputPayload.inputY = parseInt(event.worldY);
        });
    }

    onPlayerDown() {
        this.jigs.playerState = "dead";
        this.room.leave(); // Backend
        this.scene.switch("main", "DeadScene");
    }

    updatePlayer() {
        if (this.jigs.leave == 1) {
            this.jigs.leave = 0;
            this.room.leave(); // Backend
        }
        const velocity = 80;
        this.scene.inputPayload.left = this.scene.cursorKeys.left.isDown || this.scene.keyA.isDown;
        this.scene.inputPayload.right = this.scene.cursorKeys.right.isDown || this.scene.keyD.isDown;
        this.scene.inputPayload.up = this.scene.cursorKeys.up.isDown || this.scene.keyW.isDown;
        this.scene.inputPayload.down = this.scene.cursorKeys.down.isDown || this.scene.keyS.isDown;

        this.scene.inputPayload.tick = this.scene.currentTick;
        this.scene.inputPayload.mobClick = this.jigs.mobClick;

        ////////////////////////// SEND /////////////////////////////////
        if (this.scene.room.send && this.scene.room.send !== undefined) {
            if (this.jigs.playerState == "alive") {
                this.scene.room.send(0, this.scene.inputPayload);
            }
        }
        if (!this.scene.currentPlayer.anims || this.jigs.playerState != "alive") {
            return;
        }
        this.scene.physics.world.collide(this.scene.localPlayer.entity, this.scene.Walls.walls);
        this.playerMovement.move(this.scene.currentPlayer, velocity, this.scene.colliderMap);
        this.jigs.mobClick = 0;

        ///////////////////////////////////////////////////////////////////////
        //  Dispatch a Scene event
        this.scene.events.emit('position', this.scene.currentPlayer.x, this.scene.currentPlayer.y);
    }

    async lerp(player) {
        if (this.staticNum == 0) {
            this.staticNum = 1;
            if (this.scene.currentPlayer.y > this.y) {
                this.scene.currentPlayer.setVelocityY((this.scene.currentPlayer.y - player.y) * -1.9);
            }
            if (this.scene.currentPlayer.y < this.y) {
                this.scene.currentPlayer.setVelocityY((this.scene.currentPlayer.y - player.y) * -1.9);
            }
            if (this.scene.currentPlayer.x > this.x) {
                this.scene.currentPlayer.setVelocityX((this.scene.currentPlayer.x - player.x) * -1.9);
            }
            if (this.scene.currentPlayer.x < this.x) {
                this.scene.currentPlayer.setVelocityX((this.scene.currentPlayer.x - player.x) * -1.9);
            }
            await this.skip(500);
            this.staticNum = 0;
        }
    }

    skip(val) {
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve('resolved');
            }, val);
        });
    }
}
