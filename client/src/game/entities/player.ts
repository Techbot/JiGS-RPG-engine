/**
 * -------Sprites ---------
 */
import Phaser from "phaser";
import FlyingStar from "../entities/flyingStar";
import Bullet from "../entities/bullet";
export default class Player {
    colliderMap: any;
    light: any;
    drones: any;
    addLocalPLayer(self, player, entity, colliderMap) {
        this.colliderMap = colliderMap
        entity = self.physics.add.sprite(player.x, player.y, 'brawler').setDepth(3);
        this.light = self.lights.addLight(player.x, player.y, 200);
        self.lights.enable().setAmbientColor(0x555555);
        //self.game.physics.enable(entity, Phaser.Physics.ARCADE);
        self.physics.world.enable([entity]);
        //self.physics.collide(entity, colliderMap);
        self.currentPlayer = entity;
        self.localRef = self.add.rectangle(0, 0, 32, 40).setDepth(7);
        self.localRef.setStrokeStyle(1, 0x00ff00);
        self.remoteRef = self.add.rectangle(0, 0, 32, 40).setDepth(8);
        self.remoteRef.setStrokeStyle(1, 0xff0000);
        player.onChange(() => {
            self.remoteRef.x = player.x;
            self.remoteRef.y = player.y;
        });
        entity.setScale(.75);
        //    entity.setCollideWorldBounds(true);
        self.cameras.main.startFollow(entity);
        var cam = self.cameras.main;
        cam.setBounds(0, 0, 1896, 1896);
        this.drones = self.physics.add.group({ allowGravity: false });
        //  x, y = center of the path
        //  width, height = size of the elliptical path
        //  speed = speed the sprite moves along the path per frame
        this.drones.add(new FlyingStar(self, player.x, player.y, 100, 100, 0.005), true);
        this.drones.add(new FlyingStar(self, player.x, player.y, 40, 100, 0.005), true);
        this.drones.add(new FlyingStar(self, player.x, player.y, 40, 100, -0.005), true);
        self.gun       = self.physics.add.image(player.x, player.y, 'gun');
        self.key_left  = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.LEFT);
        self.key_right = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.RIGHT);
        self.key_up    = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.UP);
        self.key_down  = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.DOWN);
        self.bullets   = self.physics.add.group({
            classType: Bullet,
            maxSize: 10,
            runChildUpdate: true
        });
        self.input.on("pointerdown", (event) => {
            let bullet = self.bullets.get();
            if (bullet) {
                let offset = new Phaser.Geom.Point(0, -self.gun.height / 2);
                Phaser.Math.Rotate(offset, self.gun.rotation);
                bullet.fire(self.gun);
            }
        });
    }
    updatePlayer(self) {
        const velocity = 2;
        self.inputPayload.left = self.cursorKeys.left.isDown;
        self.inputPayload.right = self.cursorKeys.right.isDown;
        self.inputPayload.up = self.cursorKeys.up.isDown;
        self.inputPayload.down = self.cursorKeys.down.isDown;
        self.inputPayload.tick = self.currentTick;
        if (self.room.send && self.room.send !== undefined) {
            self.room.send(0, self.inputPayload);
        }
        if (!self.currentPlayer.anims) {
            return;
        }
        if (!self.inputPayload.left &&
            !self.inputPayload.right &&
            !self.inputPayload.up &&
            !self.inputPayload.down &&
            self.currentPlayer.dir != 'stopped') {
            self.currentPlayer.anims.play('stop_brawler');
            self.currentPlayer.dir = 'stopped';
        }
        if (self.inputPayload.left) {
            const tile = this.colliderMap.getTileAtWorldXY(self.currentPlayer.x - 16, self.currentPlayer.y, true);
            if (tile.index > 0) {
                self.currentPlayer.x += 32;
                self.currentPlayer.y = self.remoteRef.y;
                self.currentPlayer.x = self.remoteRef.x;
            }
            else {
                self.currentPlayer.x -= velocity;
            }
            if (self.currentPlayer.dir != 'left') {
                self.currentPlayer.anims.play('walkLeft_brawler');
                self.currentPlayer.dir = 'left';
            }
        }
        else if (self.inputPayload.right) {
            const tile = this.colliderMap.getTileAtWorldXY(self.currentPlayer.x + 16, self.currentPlayer.y, true);
            if (tile.index > 0) {
                self.currentPlayer.x -= 32;
                self.currentPlayer.y = self.remoteRef.y;
                self.currentPlayer.x = self.remoteRef.x;
            }
            else {
                self.currentPlayer.x += velocity;
            }
            if (self.currentPlayer.dir != 'right') {
                self.currentPlayer.anims.play('walkRight_brawler');
                self.currentPlayer.dir = 'right';
            }
        }
        else if (self.inputPayload.up) {
            const tile = this.colliderMap.getTileAtWorldXY(self.currentPlayer.x, self.currentPlayer.y - 16, true);
            if (tile.index > 0) {
                self.currentPlayer.y += 32;
                self.currentPlayer.y = self.remoteRef.y;
                self.currentPlayer.x = self.remoteRef.x;
            }
            else {
                self.currentPlayer.y -= velocity;
            }
            if (self.currentPlayer.dir != 'up') {
                self.currentPlayer.anims.play('walkUp_brawler');
                self.currentPlayer.dir = 'up';
            }
        }
        else if (self.inputPayload.down) {
            const tile = this.colliderMap.getTileAtWorldXY(self.currentPlayer.x, self.currentPlayer.y + 16, true);
            if (tile.index > 0) {
                self.currentPlayer.y -= 32;

                self.currentPlayer.y = self.remoteRef.y;
                self.currentPlayer.x = self.remoteRef.x;
            }
            else {
                self.currentPlayer.y += velocity;
            }
            if (self.currentPlayer.dir != 'down') {
                self.currentPlayer.anims.play('walkDown_brawler');
                self.currentPlayer.dir = 'down';
            }
        }
        self.gun.x      = self.currentPlayer.x;
        self.gun.y      = self.currentPlayer.y;
        self.localRef.x = self.currentPlayer.x;
        self.localRef.y = self.currentPlayer.y;
        this.light.x    = self.currentPlayer.x;
        this.light.y    = self.currentPlayer.y;
        this.drones.x   = self.currentPlayer.x;
        this.drones.y   = self.currentPlayer.y;
        //  Dispatch a Scene event
        self.events.emit('position', self.currentPlayer.x, self.currentPlayer.y);
        if (self.key_left.isDown) {
            self.gun.angle = 180;
        } else if (self.key_right.isDown) {
            self.gun.angle = 0;
        }
        if (self.key_up.isDown) {
            self.gun.angle = 270;
        } else if (self.key_down.isDown) {
            self.gun.angle = 90;
        }
    }
}
