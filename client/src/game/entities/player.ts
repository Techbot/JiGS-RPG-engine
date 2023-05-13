/**
 * -------Sprites ---------
 */

import Phaser from "phaser";
import FlyingStar from "../entities/flyingStar";
import Bullet from "../entities/bullet";
export default class Player {

    addLocalPLayer(self,player, entity){

        entity = self.physics.add.sprite(player.x, player.y, 'brawler');
        self.currentPlayer = entity;
        self.localRef = self.add.rectangle(0, 0, entity.width, entity.height);
        self.localRef.setStrokeStyle(1, 0x00ff00);
        self.remoteRef = self.add.rectangle(0, 0, entity.width, entity.height);
        self.remoteRef.setStrokeStyle(1, 0xff0000);
        player.onChange(() => {
            self.remoteRef.x = player.x;
            self.remoteRef.y = player.y;
        });
        entity.setScale(.75);
        //    entity.setCollideWorldBounds(true);
        self.cameras.main.startFollow(entity);
        var cam = self.cameras.main;
        cam.setBounds(0, 0, 4096, 4096);

        const drones = self.physics.add.group({ allowGravity: false });
        //  x, y = center of the path
        //  width, height = size of the elliptical path
        //  speed = speed the sprite moves along the path per frame
        drones.add(new FlyingStar(self, 150, 100, 100, 100, 0.005), true);
        drones.add(new FlyingStar(self, 500, 200, 40, 100, 0.005), true);
        drones.add(new FlyingStar(self, 600, 200, 40, 100, -0.005), true);

        self.gun = self.physics.add.image(player.x, player.y, 'gun');
        self.key_left = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.LEFT);
        self.key_right = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.RIGHT);
        self.key_up = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.UP);
        self.key_down = self.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.DOWN);
        self.bullets = self.physics.add.group({
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

    updatePlayer(self ) {

        const velocity = 2;
        self.inputPayload.left = self.cursorKeys.left.isDown;
        self.inputPayload.right = self.cursorKeys.right.isDown;
        self.inputPayload.up = self.cursorKeys.up.isDown;
        self.inputPayload.down = self.cursorKeys.down.isDown;
        self.inputPayload.tick = self.currentTick;

        if (self.room.send && self.room.send !== undefined) {
            self.room.send(0, self.inputPayload);
        }

        if (!self.currentPlayer.anims){
            return;
        }
        if (!self.inputPayload.left &&
            !self.inputPayload.right &&
            !self.inputPayload.up &&
            !self.inputPayload.down &&
            self.currentPlayer.dir != 'stopped') {
            self.currentPlayer.anims.play('stop');
            self.currentPlayer.dir = 'stopped';
        }
        if (self.inputPayload.left) {
            self.currentPlayer.x -= velocity;
            if (self.currentPlayer.dir != 'left') {
                self.currentPlayer.anims.play('walkLeft');
                self.currentPlayer.dir = 'left';
            }

        }
        else if (self.inputPayload.right) {
            self.currentPlayer.x += velocity;
            if (self.currentPlayer.dir != 'right') {
                self.currentPlayer.anims.play('walkRight');
                self.currentPlayer.dir = 'right';
            }
        }
       else if (self.inputPayload.up) {
            self.currentPlayer.y -= velocity;
            if (self.currentPlayer.dir != 'up') {
                self.currentPlayer.anims.play('walkUp');
                self.currentPlayer.dir = 'up';
            }

        }
        else if (self.inputPayload.down) {
            self.currentPlayer.y += velocity;
            if (self.currentPlayer.dir != 'down') {
                self.currentPlayer.anims.play('walkDown');
                self.currentPlayer.dir = 'down';
            }
        }
        self.gun.x = self.currentPlayer.x;
        self.gun.y = self.currentPlayer.y;
        self.localRef.x = self.currentPlayer.x;
        self.localRef.y = self.currentPlayer.y;
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
