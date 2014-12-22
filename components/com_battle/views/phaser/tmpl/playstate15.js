/**
 * Created by techbot on 17/11/14.
 */

playState[15] = {
    init: function() {
        //Called as soon as we enter this state
    },

    preload: function() {
        //  Tilemaps are split into two parts: The actual map data (usually stored in a CSV or JSON file)
		grid=15;
        //  The final one tells Phaser the foramt of the map data, in this case it's a JSON file exported from the Tiled map editor.
        //  This could be Phaser.Tilemap.CSV too.
		game.load.tilemap('world', '/components/com_battle/views/phaser/tmpl/grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);

        //  Next we load the tileset. This is just an image, loaded in via the normal way we load images:

        //game.load.image('Zombie_A5', 'assets/tiles/Zombie_A5.png');
        //game.load.image('Zombie_A4', 'assets/tiles/Zombie_A4.png');
        
        game.load.image('Zombie_TileC', '/components/com_battle/images/assets/tiles/Zombie_TileC.png');
        game.load.image('Zombie_TileD', '/components/com_battle/images/assets/tiles/Zombie_TileD.png'); 
        
    	game.load.image('TileA4', '/components/com_battle/images/assets/tiles/TileA4.png');
    	game.load.image('TileA5', '/components/com_battle/images/assets/tiles/TileA5.png');
        game.load.image('TileE', '/components/com_battle/images/assets/tiles/TileE.png');
        game.load.image('TileB', '/components/com_battle/images/assets/tiles/TileB.png');
        game.load.image('arrow', '/components/com_battle/images/assets/frog.gif');
        game.load.image('mushroom', '/components/com_battle/images/assets/sprites/mushroom2.png');
        game.load.image('sonic', '/components/com_battle/images/assets/sprites/sonic_havok_sanity.png');
        game.load.image('phaser', '/components/com_battle/images/assets/sprites/phaser1.png');

        //  37x45 is the size of each frame
        //  There are 18 frames in the PNG - you can leave this value blank if the frames fill up the entire PNG, but in this case there are some
        //  blank frames at the end, so we tell the loader how many to load
        game.load.spritesheet('ms', '/components/com_battle/images/assets/sprites/metalslug_mummy37x45.png', 37, 45, 18);
        
        game.load.spritesheet('monster', '/components/com_battle/images/assets/Monsters/Beast of Burden/Monster_BeastofBurden_FullFrame.png', 185, 165, 8);  

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
        game.load.image(cacheKey('Zombie_A5', 'tileset', 'Zombie_A5'), '/components/com_battle/images/assets/Zombie_A5.png');
        game.load.image(cacheKey('portal00001', 'tileset', 'portal00001'), '/components/com_battle/images/assets/tiles/Dungeon_A1.png');
        game.load.image(cacheKey('portal00002', 'tileset', 'portal00002'), '/components/com_battle/images/assets/tiles/Dungeon_B.png');
        game.load.image(cacheKey('portal00003', 'tileset', 'portal00003'), '/components/com_battle/images/assets/tiles/Dungeon_C.png');   

       // game.load.image(cacheKey('TileA4', 'tileset', 'TileA4'), '/components/com_battle/images/assets/TileA4.png');
        game.load.image(cacheKey('TileA5', 'tileset', 'TileA5'), '/components/com_battle/images/assets/TileA5.png');        

        // if you have image layers, be sure to load those too! Again,
        // make sure the last param is the name of your layer in the map.
        game.load.image(cacheKey('grid001optimised', 'layer', 'grid001optimised'), 'grid001optimised.png');

        phaser = game.add.sprite(0, 0, 'phaser');

        cursors = game.input.keyboard.createCursorKeys();
        game.input.onDown.add(moveBall, this);

        game.physics.arcade.enable(phaser);
        //      phaser.body.velocity.set(200, 200);
        //  phaser.body.bounce.set(1, 1);
        phaser.body.collideWorldBounds = true;

        //  The 'mario' key here is the Loader key given in game.load.tilemap
        map = game.add.tilemap('world');

        //  Creates a layer from the World1 layer in the map data.
        //  A Layer is effectively like a Phaser.Sprite, so is added to the display list.
        layer3 = map.createLayer('ground');
        layer = map.createLayer('obstacles');
        layer4 = map.createLayer('ground2');
        layer2 = map.createLayer('objects');

  //    map.addTilesetImage('TileA4', 'TileA4');
      map.addTilesetImage('TileA5', 'TileA5');
  //    map.addTilesetImage('TileB', 'TileB');       
    //   map.addTilesetImage('Zombie_TileC', 'Zombie_TileC');
    //   map.addTilesetImage('Zombie_TileD', 'Zombie_TileD');
       
        map.addTilesetImage('TileE', 'TileE');


        map.setCollisionBetween(0, 10000,true,'obstacles');
        // paddle = game.add.sprite(game.world.centerX, 500, 'breakout', 'Main_MP1_Cuthbert_FullFrame.png');
        sprite = game.add.sprite(370, 300, 'arrow');
        //  sprite.anchor.setTo(0.5, 0.5);

        //	Enable Arcade Physics for the sprite
        game.physics.enable(sprite, Phaser.Physics.ARCADE);

        //	Tell it we don't want physics to manage the rotation
        sprite.body.allowRotation = false;

        this.camera.follow(sprite, Phaser.Camera.FOLLOW_TOPDOWN_TIGHT);
        //phaser.fixedToCamera = true;

        sprite2 = game.add.sprite(40, 100, 'ms');
        game.physics.enable(sprite2, Phaser.Physics.ARCADE);

        sprite2.animations.add('walk');

        sprite2.animations.play('walk', 50, true);

        
        destination = layer.width;
        
        if (sprite2.x > 300){
        
        destination = 10;
        
        }

 //////////////////////////////////////////////
        portal = new Array();
        portal[1] = game.add.sprite(480, 40, 'portal00001');
        portal[1]['dest']=10;
        game.physics.enable(portal[1], Phaser.Physics.ARCADE);

        portal[2] = game.add.sprite(996, 190, 'portal00002');
        game.physics.enable(portal[2], Phaser.Physics.ARCADE);
        portal[2]['dest']=11;

        portal[3] = game.add.sprite(25, 190, 'portal00003');
        portal[3]['dest']=12;

        game.physics.enable(portal[3], Phaser.Physics.ARCADE);
        //    game.add.tween(monster1).to({ x: 10 }, 10000, Phaser.Easing.Linear.None, true);
///////////////////////////////////////////

    },

    update: function() {
        this.physics.arcade.collide(sprite, layer);

      //  this.physics.arcade.collide(sprite, sprite2,battle);
     //   this.physics.arcade.collide(sprite, monster1,battle2);


        this.physics.arcade.collide(sprite, portal[1],jump);
        this.physics.arcade.collide(sprite, portal[2],jump);
        this.physics.arcade.collide(sprite, portal[3],jump);
        
        
    //    this.physics.arcade.collide(sprite2, layer);


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


        if (sprite2.x >= 300) {
            //   sprite2.scale.x += 0.01;
            //    sprite2.scale.y += 0.01;
        }
    },

    render: function() {
           game.debug.spriteCoords(sprite, 32, 32);

// game.debug.cameraInfo(game.camera, 96, 64);
    }
};