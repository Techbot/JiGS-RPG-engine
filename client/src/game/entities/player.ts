/**
 * -------Player ---------
 */
import Phaser from "phaser";
import Drones from "../entities/drones";
import Bullet from "../entities/bullet";
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
    gun: any;

    constructor(self, room, scene, player) {
        this.room = room;
        this.scene = scene;
        this.jigs = useJigsStore();
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
        this.gun = self.physics.add.image(player.x, player.y, 'gun');
        self.lights.enable().setAmbientColor(0x555555);
        self.physics.add.existing(this.entity);
        self.physics.world.enable([this.entity]);
        self.cameras.main.startFollow(this.entity);
        self.currentPlayer = this.entity;
        this.drones = new Drones(self, player.x, player.y);
        //    this.drones.add(self, player.x, player.y);

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
                //    self.currentPlayer.x = player.x;
                //    self.currentPlayer.y = player.y;
                this.lerp(self);
            }
        });

        var cam = self.cameras.main;
        cam.setBounds(0, 0, this.jigs.mapWidth * 16, this.jigs.mapHeight * 16);

        self.key_left = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.LEFT);
        self.key_right = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.RIGHT);
        self.key_up = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.UP);
        self.key_down = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.DOWN);
        self.bullets = self.physics.add.group({
            classType: Bullet,
            maxSize: 10,
            runChildUpdate: true,
            bodyType: 'Bul'
        });

        self.input.on("pointerdown", (event) => {

            if (self.currentPlayer.dir == 'left') {
                self.currentPlayer.play('thrustLeft_' + self.jigs.playerStats.sprite_sheet + '_slash');
                if (self.currentPlayer.speed == 'go') {
                    self.currentPlayer.playAfterRepeat('walkLeft_' + self.jigs.playerStats.sprite_sheet);
                }
            }
            else if (self.currentPlayer.dir == 'right') {
                self.currentPlayer.anims.play('thrustRight_' + self.jigs.playerStats.sprite_sheet + '_slash');
                if (self.currentPlayer.speed == 'go') {
                    self.currentPlayer.playAfterRepeat('walkRight_' + self.jigs.playerStats.sprite_sheet);
                }
            }
            else if (self.currentPlayer.dir == 'up') {
                self.currentPlayer.anims.play('thrustUp_' + self.jigs.playerStats.sprite_sheet + '_slash');
                if (self.currentPlayer.speed == 'go') {
                    self.currentPlayer.playAfterRepeat('walkUp_' + self.jigs.playerStats.sprite_sheet);
                }

            }
            else if (self.currentPlayer.dir == 'down') {
                self.currentPlayer.anims.play('thrustDown_' + self.jigs.playerStats.sprite_sheet + '_slash');
                if (self.currentPlayer.speed == 'go') {
                    self.currentPlayer.playAfterRepeat('walkDown_' + self.jigs.playerStats.sprite_sheet);
                }
            }
            else {
                self.currentPlayer.anims.play('thrustDown_' + self.jigs.playerStats.sprite_sheet + '_slash');
            }

            this.gun.angle = Math.atan2(parseInt(event.worldY) - this.gun.y, parseInt(event.worldX) - this.gun.x) * 180 / Math.PI;

            if (self.jigs.mobShoot != 0) {
                let bullet = self.bullets.get();
                if (bullet) {
                    let offset = new Phaser.Geom.Point(0, -this.gun.height / 2);
                    bullet.fire(this.gun);
                    self.jigs.mobShoot = 0;
                }
                self.inputPayload.inputX = parseInt(event.worldX);
                self.inputPayload.inputY = parseInt(event.worldY);
            }
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

        if (!self.inputPayload.left && !self.inputPayload.right &&
            !self.inputPayload.up && !self.inputPayload.down &&
            self.currentPlayer.speed != 'stopped') {
            self.currentPlayer.anims.play('stop_' + this.jigs.playerStats.sprite_sheet);
            self.currentPlayer.speed = 'stopped';
            self.currentPlayer.dir = 'stopped';
            self.currentPlayer.setVelocityX(0);
            self.currentPlayer.setVelocityY(0);

        }
        if (self.inputPayload.left) {
            const tile = this.colliderMap.getTileAtWorldXY(self.currentPlayer.x - 16, self.currentPlayer.y, true);
            if (tile) {
                self.currentPlayer.setVelocityX(-velocity);
            }
            else {
                self.currentPlayer.x -= velocity;
            }
            if (self.currentPlayer.dir != 'left') {
                self.currentPlayer.anims.play('walkLeft_' + this.jigs.playerStats.sprite_sheet);
                self.currentPlayer.dir = 'left';
                self.currentPlayer.speed = 'go';
            }
        }
        else if (self.inputPayload.right) {
            const tile = this.colliderMap.getTileAtWorldXY(self.currentPlayer.x + 16, self.currentPlayer.y, true);
            if (tile) {
                self.currentPlayer.setVelocityX(velocity);
            }
            else {
                self.currentPlayer.x += velocity;
            }
            if (self.currentPlayer.dir != 'right') {
                self.currentPlayer.anims.play('walkRight_' + this.jigs.playerStats.sprite_sheet);
                self.currentPlayer.dir = 'right';
                self.currentPlayer.speed = 'go';
            }
        }
        else if (self.inputPayload.up) {
            const tile = this.colliderMap.getTileAtWorldXY(self.currentPlayer.x, self.currentPlayer.y - 16, true);
            if (tile) {
                self.currentPlayer.setVelocityY(-velocity);
            }
            else {
                self.currentPlayer.y -= velocity;
            }
            if (self.currentPlayer.dir != 'up') {
                self.currentPlayer.anims.play('walkUp_' + this.jigs.playerStats.sprite_sheet);
                self.currentPlayer.dir = 'up';
                self.currentPlayer.speed = 'go';
            }
        }
        else if (self.inputPayload.down) {
            const tile = this.colliderMap.getTileAtWorldXY(self.currentPlayer.x, self.currentPlayer.y + 16, true);
            if (tile) {
                self.currentPlayer.setVelocityY(velocity);
            }
            else {
                self.currentPlayer.y += velocity;
            }
            if (self.currentPlayer.dir != 'down') {
                self.currentPlayer.anims.play('walkDown_' + this.jigs.playerStats.sprite_sheet);
                self.currentPlayer.dir = 'down';
                self.currentPlayer.speed = 'go';
            }
        }

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

        ////////////////////////////////////////////////////////////////////////////////
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
