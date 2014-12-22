/**
 * Created by techbot on 17/11/14.
 */

playState[17] = {
    init: function() {
        //Called as soon as we enter this state
    },

    preload: function() {
        var grid = paddy(17,3);
		game.load.tilemap('world', '/components/com_battle/views/phaser/tmpl/grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);

    	game.load.image('TileA5', '/components/com_battle/images/assets/tiles/TileA5.png');
        game.load.image('TileA4', '/components/com_battle/images/assets/tiles/TileA4.png');
        game.load.image('TileA3', '/components/com_battle/images/assets/tiles/TileA3.png');

        game.load.image('Zombie_A4', '/components/com_battle/images/assets/tiles/Zombie_A4.png');
        game.load.image('arrow', '/components/com_battle/images/assets/frog.gif');

    },

    create: function() {
        game.physics.startSystem(Phaser.Physics.ARCADE);
        game.add.plugin(Phaser.Plugin.Tiled);
        //  Modify the world and camera bounds
        game.world.setBounds(-1000, -1000, 3200, 3200);
        game.stage.backgroundColor = '#787878';
        game.input.onDown.add(moveBall, this);

        // By using the built-in cache key creator, the plugin can
        // automagically find all the necessary items in the cache
        var cacheKey = Phaser.Plugin.Tiled.utils.cacheKey;

        game.load.tiledmap(cacheKey('world', 'tiledmap'), 'grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.image(cacheKey('TileA5', 'tileset', 'TileA5'), '/components/com_battle/images/assets/TileA5.png');
        game.load.image(cacheKey('TileA4', 'tileset', 'TileA4'), '/components/com_battle/images/assets/TileA4.png');
        game.load.image(cacheKey('TileA3', 'tileset', 'TileA3'), '/components/com_battle/images/assets/TileA3.png');

        game.load.image(cacheKey('Zombie_A4', 'tileset', 'Zombie_A4'), '/components/com_battle/images/assets/Zombie_A4.png');




        cursors = game.input.keyboard.createCursorKeys();
        game.input.onDown.add(moveBall, this);

        //  The 'mario' key here is the Loader key given in game.load.tilemap
        map = game.add.tilemap('world');
        layer3 = map.createLayer('ground');
        layer = map.createLayer('obstacles');
        layer4 = map.createLayer('ground2');
        layer2 = map.createLayer('objects');
        
        map.addTilesetImage('TileA5', 'TileA5');
        map.addTilesetImage('TileA4', 'TileA4');
        map.addTilesetImage('TileA3', 'TileA3');

        map.addTilesetImage('Zombie_A4', 'Zombie_A4');

        map.setCollisionBetween(0, 5000,true,'obstacles');
        // paddle = game.add.sprite(game.world.centerX, 500, 'breakout', 'Main_MP1_Cuthbert_FullFrame.png');
        sprite = game.add.sprite(370, 300, 'arrow');
        //  sprite.anchor.setTo(0.5, 0.5);

        //	Enable Arcade Physics for the sprite
        game.physics.enable(sprite, Phaser.Physics.ARCADE);

        //	Tell it we don't want physics to manage the rotation
        sprite.body.allowRotation = false;

        this.camera.follow(sprite, Phaser.Camera.FOLLOW_TOPDOWN_TIGHT);

//////////////////////////////////////////////
        portal = new Array();
        portal[1] = game.add.sprite(480, 40, 'portal00001');
        portal[1]['dest']=9;
        game.physics.enable(portal[1], Phaser.Physics.ARCADE);

        portal[2] = game.add.sprite(996, 190, 'portal00002');
        game.physics.enable(portal[2], Phaser.Physics.ARCADE);
        portal[2]['dest']=8;

        //portal[3] = game.add.sprite(25, 190, 'portal00003');
        //game.physics.enable(portal[3], Phaser.Physics.ARCADE);
        // portal[3]['dest']=5;

        //    game.add.tween(monster1).to({ x: 10 }, 10000, Phaser.Easing.Linear.None, true);

    },

    update: function() {
        this.physics.arcade.collide(sprite, layer);
        this.physics.arcade.collide(sprite, portal[1],jump);
        this.physics.arcade.collide(sprite, portal[2],jump);
        this.physics.arcade.collide(sprite, portal[3],jump);
        

        //sprite.rotation = game.physics.arcade.moveToPointer(sprite, 600);
        game.physics.arcade.moveToXY(sprite, x, y, 100);
        if ((sprite.body.x >=x-10) &&(sprite.body.x <=x+10)){
            sprite.body.velocity.x = 0;
        }

        if ((sprite.body.y >=y-10) &&(sprite.body.y <=y+10)){
            sprite.body.velocity.y = 0;
        }
        if (cursors.up.isDown) {
            //  console.log("Down");
            game.camera.y -= 4;
            phaser.y -= 40;
        }
        else if (cursors.down.isDown) {
            game.camera.y += 4;
            phaser.y += 40;
        }
        if (cursors.left.isDown) {
            game.camera.x -= 4;
        }
        else if (cursors.right.isDown) {
            game.camera.x += 4;
        }
    },
    render: function() {
           game.debug.spriteCoords(sprite, 32, 32);

// game.debug.cameraInfo(game.camera, 96, 64);
    }
};
