playState[3] = {
    init: function() {
    },
    preload: function() {
        game.load.image('bullet', '/images/shmup-bullet.png',4,4);
      //  game.load.script('HudManager', '/components/com_battle/includes/HUDManager.js');
       // var number = paddy(grid,3);
        // game.load.spritesheet('ms', '/components/com_battle/images/assets/metalslug_mummy37x45.png', 37, 45, 18);
        load_monsters();
        load_player();
        load_players();
        load_buildings();
        load_twines();
        load_plates();
        load_terminals();
        load_chars();
        load_portals();
        load_tiles();
        load_halflings();
        game.load.tilemap('world', '/themes/custom/emc/js/phaser/json/grid001.json', null, Phaser.Tilemap.TILED_JSON);
    },
    create: function() {
        game.physics.startSystem(Phaser.Physics.ARCADE);
        game.add.plugin(Phaser.Plugin.Tiled);

        //  Modify the world and camera bounds
        game.world.setBounds(boundsX1[grid], boundsY1[grid], boundsX2[grid], boundsY2[grid]);
        //game.stage.backgroundColor = '#000000';

        fireButton = game.input.keyboard.addKey(Phaser.KeyCode.SPACEBAR);

        group = game.add.group();
        cache();
        // if you have image layers, be sure to load those too! Again,
        // make sure the last param is the name of your layer in the map.
        //game.load.image(cacheKey('grid001optimised', 'layer', 'grid001optimised'), 'grid001optimised.png');
        cursors = game.input.keyboard.createCursorKeys();
        //  In this example we'll create 4 specific keys (up, down, left, right) and monitor them in our update function

        upKey = game.input.keyboard.addKey(Phaser.Keyboard.UP);
        downKey = game.input.keyboard.addKey(Phaser.Keyboard.DOWN);
        leftKey = game.input.keyboard.addKey(Phaser.Keyboard.LEFT);
        rightKey = game.input.keyboard.addKey(Phaser.Keyboard.RIGHT);
        fireButton = game.input.keyboard.addKey(Phaser.Keyboard.SPACEBAR);
        ///////////////////////////////////////////
        addMap();
        ///////////////////////////////////////////
       // console.log('grid:' + grid);
        for (var index = 0; index < tile_names[grid].length; index++) {
            var filename = tile_names[grid][index];
            map.addTilesetImage(filename, filename);
        }
        /////////////////////////////////////////
        map.setCollisionBetween(0, 9000,true,'obstacles');
        /////////////////////////place player
        place_buildings();
        place_twines();
        place_plates();
        place_terminals();
        place_monsters();
        place_halflings();
        place_player();
        stop_player();
        place_players();
        place_chars();
        place_portals();
        //  Creates 30 bullets, using the 'bullet' graphic
        weapon = game.add.weapon(30, 'bullet');
        //  The bullet will be automatically killed when it leaves the world bounds
        weapon.bulletKillType = Phaser.Weapon.KILL_WORLD_BOUNDS;
        //  The speed at which the bullet is fired
        weapon.bulletSpeed = 600;
        //  Speed-up the rate of fire, allowing them to shoot 1 bullet every 60ms
        weapon.fireRate = 100;
        //  Tell the Weapon to track the 'player' Sprite
        //  With no offsets from the position
        //  But the 'true' argument tells the weapon to track sprite rotation
        weapon.trackSprite(circle_core, 0, 0, true);
    },

    getCardinal: function(angle, diagonals) {
        if (diagonals) {
            angle = Math.round((angle + Math.PI) / (Math.PI * 2) * 8) % 8;
            return (directions[angle]);
        }
        else {
            angle = Math.round((angle + Math.PI) / (Math.PI * 2) * 4) % 4;
            return (directions[angle * 2]);
        }
    },
    update: function() {

        var angle = game.physics.arcade.moveToPointer(sprite, 20);

        if (game.input.activePointer.isDown) {
            anim = true;
            playerDirection = this.getCardinal(angle, true);
            // game.input.onDown.add(moveBall, this);
        }
        else {
            sprite.body.velocity.set(0);
            playerDirection = null;
        }


        game.input.onDown.add(moveBall, this);

        floor_halflings();
        //////////////////////////////collide obstacle layer
        game.physics.arcade.collide(sprite, layer, stop);
        ////////////////////////////////////////////////
        sprite.body.x = parseInt(sprite.body.x);

        if (anim == true) {
            game.physics.arcade.moveToXY(sprite, parseInt(x), parseInt(y), 100);

            if (playerDirection == 'SW') {
                sprite.loadTexture('highhero_diagonal', 0, true);
                sprite.animations.play('walkLeftDown', 6, true);
                console.log(playerDirection);
            }

            if (playerDirection == 'NW') {
                sprite.loadTexture('highhero_diagonal', 0, true);
                sprite.animations.play('walkLeftUp', 6, true);
                console.log(playerDirection);
            }

            if (playerDirection == 'SE') {
                sprite.loadTexture('highhero_diagonal', 0, true);
                sprite.animations.play('walkRightDown', 6, true);
                console.log(playerDirection);
            }

            if (playerDirection == 'NE') {
                sprite.loadTexture('highhero_diagonal', 0, true);
                sprite.animations.play('walkUpRight', 6, true);
                console.log(playerDirection);
            }

            if (playerDirection == 'S') {
                sprite.loadTexture('highhero', 0, true);
                sprite.animations.play('walkDown', 6, true);
                console.log(playerDirection);
            }

            if (playerDirection == 'W') {
                sprite.loadTexture('highhero', 0, true);
                sprite.animations.play('walkLeft', 6, true);
                console.log(playerDirection);
            }

            if (playerDirection == 'E') {
                sprite.loadTexture('highhero', 0, true);
                sprite.animations.play('walkRight', 6, true);
                console.log(playerDirection);
            }

            if (playerDirection == 'N') {
                sprite.loadTexture('highhero', 0, true);
                sprite.animations.play('walkUp', 6, true);
                console.log(playerDirection);
            }
        }
        else {
            sprite.loadTexture('highhero', 0, true);
            sprite.animations.play('walkStop', 1);
            sprite.body.velocity.x = 0;
            sprite.body.velocity.y = 0;
        }

        move_players();
        stop_players();
        stop_player();
        move_monsters();
        stop_monsters();
        stop_halflings();
        move_halflings();
        check_for_collisions();
    },
    render: function() {
           game.debug.spriteCoords(sprite, 32, 32);
    }
};
