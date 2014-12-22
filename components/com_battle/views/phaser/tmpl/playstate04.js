/**
 * Created by techbot on 17/11/14.
 */

playState[4] = {
    init: function() {
        //Called as soon as we enter this state
    },

    preload: function() {
        //  Tilemaps are split into two parts: The actual map data (usually stored in a CSV or JSON file)
		grid=4;
        //  The final one tells Phaser the foramt of the map data, in this case it's a JSON file exported from the Tiled map editor.
        //  This could be Phaser.Tilemap.CSV too.
		//game.load.tilemap('ground', '/components/com_battle/views/phaser/tmpl/grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.tilemap('world', '/components/com_battle/views/phaser/tmpl/grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);

        game.load.image('Zombie_A3', '/components/com_battle/images/assets/tiles/Zombie_A3.png');
        game.load.image('Zombie_A4', '/components/com_battle/images/assets/tiles/Zombie_A4.png');
        game.load.image('Zombie_A5', '/components/com_battle/images/assets/tiles/Zombie_A5.png');
        game.load.image('033-Heaven02', '/components/com_battle/images/assets/tiles/033-Heaven02.png');
        game.load.image('032-Heaven01', '/components/com_battle/images/assets/tiles/032-Heaven01.png');
        game.load.image('035-Ruins01', '/components/com_battle/images/assets/tiles/035-Ruins01.png');

        //  game.load.image('Zombie_A4', 'assets/tiles/Zombie_A4.png');
        game.load.image('TileA4', '/components/com_battle/views/phaser/tmpl/assets/tiles/TileA4.png');
        game.load.image('TileA5', '/components/com_battle/views/phaser/tmpl/assets/tiles/TileA5.png');
        game.load.image('TileE', '/components/com_battle/views/phaser/tmpl/assets/tiles/TileE.png');

        game.load.image('arrow', '/components/com_battle/views/phaser/tmpl/assets/frog.gif');

        game.load.spritesheet('portal00001', '/components/com_battle/images/assets/tiles/Dungeon_A1.png', 32, 64, 1);  
        game.load.spritesheet('portal00002', '/components/com_battle/images/assets/tiles/Dungeon_B.png', 32, 64, 1); 
        game.load.spritesheet('portal00003', '/components/com_battle/images/assets/tiles/Dungeon_C.png', 32, 64, 1);
        
             
        
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


        // load the images for your tilesets, make sure the last param to "cacheKey" is
        // the name of the tileset in your map so the plugin can find it later
        game.load.image(cacheKey('Zombie_A5', 'tileset', 'Zombie_A5'), '/components/com_battle/images/assets/tiles/Zombie_A5.png');
        game.load.image(cacheKey('Zombie_A1', 'tileset', 'Zombie_A1'), '/components/com_battle/images/assets/tiles/Zombie_A1.png');

        game.load.image(cacheKey('Zombie_A3', 'tileset', 'Zombie_A4'), '/components/com_battle/images/assets/tiles/Zombie_A3.png');
        game.load.image(cacheKey('Zombie_A4', 'tileset', 'Zombie_A4'), '/components/com_battle/images/assets/tiles/Zombie_A4.png');
        game.load.image(cacheKey('033-Heaven02', 'tileset', '033-Heaven02'), '/components/com_battle/assets/tiles/033-Heaven02.png');
        game.load.image(cacheKey('032-Heaven01', 'tileset', '032-Heaven01'), '/components/com_battle/assets/tiles/032-Heaven01.png');
        game.load.image(cacheKey('035-Ruins01', 'tileset', ' 035-Ruins01'), '/components/com_battle/assets/tiles/035-Ruins01.png');
        game.load.image(cacheKey('arrow','image','arrow'),  '/components/com_battle/views/phaser/tmpl/assets/frog.gif');

        game.load.image(cacheKey('TileE', 'tileset', 'TileE'), '/components/com_battle/images/assets/tiles/TileE.png');


        game.load.image(cacheKey('002-Woods01', 'tileset', '002-Woods01'), '/components/com_battle/images/assets/tiles/002-Woods01.png');
        game.load.image(cacheKey('TileC', 'tileset', 'TileC'), '/components/com_battle/images/assets/tiles/TileC.png');


        game.load.image(cacheKey('TileA4', 'tileset', 'TileA4'), '/components/com_battle/images/assets/tiles/TileA4.png');
        game.load.image(cacheKey('TileA5', 'tileset', 'TileA5'), '/components/com_battle/images/assets/tiles/TileA5.png');

        game.load.image(cacheKey('portal00001', 'tileset', 'portal00001'), '/components/com_battle/images/assets/tiles/Dungeon_B.png');
        game.load.image(cacheKey('portal00002', 'tileset', 'portal00002'), '/components/com_battle/images/assets/tiles/Dungeon_B.png');
        game.load.image(cacheKey('portal00003', 'tileset', 'portal00003'), '/components/com_battle/images/assets/tiles/Dungeon_C.png');

        //game.load.image(cacheKey('grid001optimised', 'layer', 'grid001optimised'), '/components/com_battle/images/assets/grid001optimised.png');
        ////////////
        cursors = game.input.keyboard.createCursorKeys();
        game.input.onDown.add(moveBall, this);

        map = game.add.tilemap('world');
        
        layer3 = map.createLayer('ground');
        layer = map.createLayer('obstacles');
        layer4 = map.createLayer('ground2');
        layer2 = map.createLayer('objects');

        map.addTilesetImage('Zombie_A5', 'Zombie_A5');
        map.addTilesetImage('TileE', 'TileE');

        map.addTilesetImage('032-Heaven01', '032-Heaven01')
        map.addTilesetImage('033-Heaven02', '033-Heaven02')
        map.addTilesetImage('035-Ruins01','035-Ruins01');

        map.addTilesetImage('001-Grassland01', '001-Grassland01');

        map.setCollisionBetween(0, 10000,true,'obstacles');

        sprite = game.add.sprite(370, 300, 'arrow');
        //  sprite.anchor.setTo(0.5, 0.5);

        //	Enable Arcade Physics for the sprite
        game.physics.enable(sprite, Phaser.Physics.ARCADE);

        //	Tell it we don't want physics to manage the rotation
        sprite.body.allowRotation = false;

        this.camera.follow(sprite, Phaser.Camera.FOLLOW_TOPDOWN_TIGHT);
///////////////////////////////////////////
        portal = new Array();

        portal[1] = game.add.sprite(889, 0, 'portal00001');
        game.physics.enable(portal[1], Phaser.Physics.ARCADE);
        portal[1]['dest']=8;

        portal[2] = game.add.sprite(1290, 1354, 'portal00002');
        game.physics.enable(portal[2], Phaser.Physics.ARCADE);
        portal[2]['dest']=9;

        portal[3]= game.add.sprite(640, 580, 'portal00003');
        game.physics.enable(portal[3], Phaser.Physics.ARCADE);
        portal[3]['dest']=10;
///////////////////////////////////////////
    },

    update: function() {
        this.physics.arcade.collide(sprite, layer);

   //     this.physics.arcade.collide(sprite, sprite2,battle);
      //  this.physics.arcade.collide(sprite, monster1,battle2);

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
        // phaser.body.allowRotation = false;

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



