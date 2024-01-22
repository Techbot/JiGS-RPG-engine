/**
 * -------Player ---------
 */
import Phaser from "phaser";
import Drones from "../entities/drones";
import Gun from "../entities/gun";
import Sword from "../entities/sword";
import PlayerMovement from "../entities/player_movement";
import { useJigsStore } from '../../stores/jigs';

export default class Player {

    colliderMap: any;
    light: any;
    drones: any;
    jigs: any;
    room: any;
    scene: any;
    staticNum: number;
    walls: any;
    entity: any;
    gun: Gun;
    sword: Sword;
    playerMovement: PlayerMovement;

    constructor(self, room, scene, player) {
        this.room = room;
        this.scene = scene;
        this.jigs = useJigsStore();
        this.playerMovement = new PlayerMovement;
        this.staticNum = 0;

        this.entity = self.physics.add.sprite(player.x, player.y, this.jigs.playerStats.sprite_sheet)
            .setDepth(7)
            .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
            .on('pointerdown', this.onPlayerDown.bind(self))
            .setScale(.85);

    }

    add(self, player, colliderMap) {
        this.colliderMap = colliderMap
        this.light = self.lights.addLight(player.x, player.y, 200);

        this.gun = new Gun(self, player.x, player.y, 'gun');
        this.sword = new Sword(self, player.x, player.y, null);
        this.drones = new Drones(self, player.x, player.y);

        self.lights.enable().setAmbientColor(0x555555);
        self.physics.add.existing(this.entity);
        self.physics.world.enable([this.entity]);
        self.cameras.main.startFollow(this.entity);
        self.currentPlayer = this.entity;

        if (this.jigs.debug) {
            self.localRef = self.add.rectangle(0, 0, 32, 40).setDepth(7);
            self.localRef.setStrokeStyle(1, 0x00ff00);
            self.remoteRef = self.add.rectangle(0, 0, 32, 40).setDepth(8);
            self.remoteRef.setStrokeStyle(1, 0xff0000);
        }
        player.onChange(() => {
            if (this.jigs.debug) {
                self.remoteRef.x = player.x;
                self.remoteRef.y = player.y;
                this.lerp(self);
            }
        });

        var cam = self.cameras.main;
        cam.setBounds(0, 0, this.jigs.mapWidth * 16, this.jigs.mapHeight * 16);

        self.key_left  = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.LEFT);
        self.key_right = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.RIGHT);
        self.key_up    = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.UP);
        self.key_down  = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.DOWN);

        self.input.on("pointerdown", (event) => {
            this.sword.strike(self);
            this.gun.shoot(self, event);
            //Send Mouse Co-ordinates from World point of view
            self.inputPayload.inputX = parseInt(event.worldX);
            self.inputPayload.inputY = parseInt(event.worldY);
        });
    }

    onPlayerDown() {
        this.jigs.playerState = "dead";
        this.room.leave(); // Backend
        this.scene.switch("main", "DeadScene");
    }

    updatePlayer(self) {
        if (this.jigs.leave == 1) {
            this.jigs.leave = 0;
            this.room.leave(); // Backend
        }
        const velocity = 80;
        self.inputPayload.left = self.cursorKeys.left.isDown;
        self.inputPayload.right = self.cursorKeys.right.isDown;
        self.inputPayload.up = self.cursorKeys.up.isDown;
        self.inputPayload.down = self.cursorKeys.down.isDown;
        self.inputPayload.tick = self.currentTick;
        self.inputPayload.mobClick = this.jigs.mobClick;

        ////////////////////////// SEND /////////////////////////////////
        if (self.room.send && self.room.send !== undefined) {
            if (this.jigs.playerState == "alive") {
                self.room.send(0, self.inputPayload);
           }
        }
        if (!self.currentPlayer.anims || this.jigs.playerState != "alive") {
            return;
        }
        self.physics.world.collide(self.localPlayer.entity, self.Walls.walls);

        this.playerMovement.move(self, velocity, this.colliderMap);

        this.jigs.mobClick = 0;
        this.gun.x = self.currentPlayer.x;
        this.gun.y = self.currentPlayer.y;

        if (this.jigs.debug) {
            self.localRef.x = self.currentPlayer.x;
            self.localRef.y = self.currentPlayer.y;
        }
        this.light.x = self.currentPlayer.x;
        this.light.y = self.currentPlayer.y;

        this.drones.dronesGroup.children.each(function (drone) {
            drone.bilbob(self.currentPlayer.x, self.currentPlayer.y);
        }, this);

        ///////////////////////////////////////////////////////////////////////
        //  Dispatch a Scene event
        self.events.emit('position', self.currentPlayer.x, self.currentPlayer.y);
    }

    async lerp(self) {
        if (this.staticNum == 0) {
            this.staticNum = 1;
            console.log('lerping');
            if (self.currentPlayer.y > self.remoteRef.y) {
                self.currentPlayer.setVelocityY((self.currentPlayer.y - self.remoteRef.y) * -1.9);
            }
            if (self.currentPlayer.y < self.remoteRef.y) {
                self.currentPlayer.setVelocityY((self.currentPlayer.y - self.remoteRef.y) * -1.9);
            }
            if (self.currentPlayer.x > self.remoteRef.x) {
                self.currentPlayer.setVelocityX((self.currentPlayer.x - self.remoteRef.x) * -1.9);
            }
            if (self.currentPlayer.x < self.remoteRef.x) {
                self.currentPlayer.setVelocityX((self.currentPlayer.x - self.remoteRef.x) * -1.9);
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
