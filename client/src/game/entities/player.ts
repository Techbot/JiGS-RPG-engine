/**
 * -------Sprites ---------
 */
import Phaser from "phaser";
import FlyingStar from "../entities/flyingStar";
import Bullet from "../entities/bullet";
import { useJigsStore } from '../../stores/jigs';

export default class Player {

    colliderMap: any;
    light: any;
    drones: any;
    jigs: any;
    room: any;
    scene: any;

    constructor(room, scene) {
        this.room = room;
        this.scene = scene;
        this.jigs = useJigsStore();
    }

    addLocalPlayer(self, player, entity, colliderMap) {
        this.colliderMap = colliderMap

        entity = self.physics.add.sprite(player.x, player.y, this.jigs.playerStats.sprite_sheet)
            .setDepth(7)
            .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
            .on('pointerdown', this.onPlayerDown.bind(self));
        this.light = self.lights.addLight(player.x, player.y, 200);
        self.lights.enable().setAmbientColor(0x555555);
        self.physics.world.enable([entity]);
        self.currentPlayer = entity;

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
            }
        });
        entity.setScale(.85);
        self.cameras.main.startFollow(entity);
        var cam = self.cameras.main;


        console.log("mapWidth" + this.jigs.mapWidth);

        //cam.setBounds(0, 0, 1896, 1896);
        cam.setBounds(0, 0, this.jigs.mapWidth * 16, this.jigs.mapHeight * 16);

        this.drones = self.physics.add.group({ allowGravity: false });

        this.drones.add(new FlyingStar(self, player.x, player.y, 100, 100, 0.005), true);
        this.drones.add(new FlyingStar(self, player.x, player.y, 40, 100, 0.005), true);
        this.drones.add(new FlyingStar(self, player.x, player.y, 40, 100, -0.005), true);

        self.gun = self.physics.add.image(player.x, player.y, 'gun');
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

            //   if (this.jigs.playerState == "alive") {

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

            self.gun.angle = Math.atan2(parseInt(event.worldY) - self.gun.y, parseInt(event.worldX) - self.gun.x) * 180 / Math.PI;

            if (self.jigs.mobShoot != 0) {
                let bullet = self.bullets.get();
                if (bullet) {
                    let offset = new Phaser.Geom.Point(0, -self.gun.height / 2);
                    bullet.fire(self.gun);
                }
                self.inputPayload.inputX = parseInt(event.worldX);
                self.inputPayload.inputY = parseInt(event.worldY);
            }
            //    }
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
        const velocity = 2;
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
        if (!self.inputPayload.left &&
            !self.inputPayload.right &&
            !self.inputPayload.up &&
            !self.inputPayload.down &&
            self.currentPlayer.speed != 'stopped') {
            self.currentPlayer.anims.play('stop_' + this.jigs.playerStats.sprite_sheet);
            self.currentPlayer.speed = 'stopped';
            self.currentPlayer.dir = 'stopped';
        }
        if (self.inputPayload.left) {
            const tile = this.colliderMap.getTileAtWorldXY(self.currentPlayer.x - 16, self.currentPlayer.y, true);
            if (tile.index > 0) {
                self.currentPlayer.x += 32;
                if (this.jigs.debug) {
                    self.currentPlayer.y = self.remoteRef.y;
                    self.currentPlayer.x = self.remoteRef.x;
                }
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
            if (tile.index > 0) {
                self.currentPlayer.x -= 32;
                if (this.jigs.debug) {
                    self.currentPlayer.y = self.remoteRef.y;
                    self.currentPlayer.x = self.remoteRef.x;
                }
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
            if (tile.index > 0) {
                self.currentPlayer.y += 32;
                if (this.jigs.debug) {
                    self.currentPlayer.y = self.remoteRef.y;
                    self.currentPlayer.x = self.remoteRef.x;
                }
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
            if (tile.index > 0) {
                self.currentPlayer.y -= 32;
                if (this.jigs.debug) {
                    self.currentPlayer.y = self.remoteRef.y;
                    self.currentPlayer.x = self.remoteRef.x;
                }
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
        self.gun.x = self.currentPlayer.x;
        self.gun.y = self.currentPlayer.y;
        if (this.jigs.debug) {
            self.localRef.x = self.currentPlayer.x;
            self.localRef.y = self.currentPlayer.y;
        }
        this.light.x = self.currentPlayer.x;
        this.light.y = self.currentPlayer.y;

        this.drones.children.iterate(drone => {
            drone.bilbob(self.currentPlayer.x, self.currentPlayer.y);
        });

        ////////////////////////////////////////////////////////////////////////////////
        //  Dispatch a Scene event
        self.events.emit('position', self.currentPlayer.x, self.currentPlayer.y);
    }
}
