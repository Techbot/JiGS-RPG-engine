/**
 * Created by techbot on 17/11/14.
 */

playState[3] = {
    init: function() {
        //Called as soon as we enter this state
    },

    preload: function() {
        var grid = paddy(3,3);

       // game.load.tilemap('ground', '/components/com_battle/views/phaser/tmpl/grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.tilemap('world', '/components/com_battle/views/phaser/tmpl/grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.image('Zombie_A3', '/components/com_battle/images/assets/tiles/Zombie_A3.png');
        game.load.image('Zombie_A4', '/components/com_battle/images/assets/tiles/Zombie_A4.png');
        game.load.image('Zombie_A5', '/components/com_battle/images/assets/tiles/Zombie_A5.png');
        game.load.image('033-Heaven02', '/components/com_battle/images/assets/tiles/033-Heaven02.png');
        game.load.image('032-Heaven01', '/components/com_battle/images/assets/tiles/032-Heaven01.png');
        game.load.image('035-Ruins01', '/components/com_battle/images/assets/tiles/035-Ruins01.png'); 

        game.load.image('TileA4', '/components/com_battle/views/phaser/tmpl/assets/tiles/TileA4.png');
        game.load.image('TileA5', '/components/com_battle/views/phaser/tmpl/assets/tiles/TileA5.png');
        game.load.image('TileE', '/components/com_battle/views/phaser/tmpl/assets/tiles/TileE.png');

        game.load.image('arrow', '/components/com_battle/views/phaser/tmpl/assets/frog.gif');

        game.load.image('mushroom', '/components/com_battle/views/phaser/tmpl/assets/sprites/mushroom2.png');
        game.load.image('sonic', '/components/com_battle/views/phaser/tmpl/assets/sprites/sonic_havok_sanity.png');
        game.load.image('phaser', '/components/com_battle/views/phaser/tmpl/assets/sprites/phaser1.png');

        game.load.spritesheet('ms', '/components/com_battle/views/phaser/tmpl/assets/sprites/metalslug_mummy37x45.png', 37, 45, 18);

        game.load.spritesheet('bank', '/components/com_battle/images/buildings/bank.jpg', 48, 48, 1);  
        game.load.spritesheet('stand', '/components/com_battle/images/buildings/Au_marche_butte.jpg', 86, 86, 1);
        game.load.spritesheet('church', '/components/com_battle/images/pages/pyramid.jpg', 90, 90, 1);
        game.load.spritesheet('npc', '/components/com_battle/images/ennemis/miniatures/gurgeh.jpg', 48, 48, 1);

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

        var cacheKey = Phaser.Plugin.Tiled.utils.cacheKey;
        // load the tiled map, notice it is "tiledmap" and not "tilemap"
        game.load.tiledmap(cacheKey('world', 'tiledmap'), 'grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);

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

        // map.addTilesetImage('obstacles', 'obstacles');
        map.addTilesetImage('Zombie_A5', 'Zombie_A5');
        map.addTilesetImage('TileE', 'TileE');

        map.addTilesetImage('032-Heaven01', '032-Heaven01')
        map.addTilesetImage('033-Heaven02', '033-Heaven02')
        map.addTilesetImage('035-Ruins01','035-Ruins01');

        //  Creates a layer from the World1 layer in the map data.
        //  A Layer is effectively like a Phaser.Sprite, so is added to the display list.
        layer3 = map.createLayer('ground');
        layer = map.createLayer('obstacles');
        layer4 = map.createLayer('ground2');
        layer2 = map.createLayer('objects');
        //  This resizes the game world to match the layer dimensions
        //   layer.resizeWorld();
        map.setCollisionBetween(0, 5000,true,'obstacles');
        // paddle = game.add.sprite(game.world.centerX, 500, 'breakout', 'Main_MP1_Cuthbert_FullFrame.png');
        
//////////////////////////////////////////////////////////        
        
        sprite = game.add.sprite(860, 320, 'arrow');
        //  sprite.anchor.setTo(0.5, 0.5);
        //	Enable Arcade Physics for the sprite
        game.physics.enable(sprite, Phaser.Physics.ARCADE);
        //	Tell it we don't want physics to manage the rotation
        sprite.body.allowRotation = false;
        this.camera.follow(sprite, Phaser.Camera.FOLLOW_TOPDOWN_TIGHT);
        //phaser.fixedToCamera = true;
//////////////////////////////////////////////
        monster2 = game.add.sprite(40, 100, 'ms');
        game.physics.enable(monster2, Phaser.Physics.ARCADE);
        monster2.animations.add('walk');
        monster2.animations.play('walk', 50, true);
        destination = layer.width;
        if (monster2.x = layer.width){
        destination = 10;
       }
        game.add.tween(monster2).to({ x: destination }, 10000, Phaser.Easing.Linear.None, true);
//////////////////////////////////////////////
        monster1 = game.add.sprite(700, 70, 'bank');
        game.physics.enable(monster1, Phaser.Physics.ARCADE);




      //  monster1.animations.add('upwalk',[1, 2, 3,4,5,6,7,8]);
      //  monster1.animations.add('leftwalk',[9, 10, 11,12,13,14,15,16]);
     //   monster1.animations.add('rightwalk',[9, 10, 11,12,13,14,15,16]);
     //   monster1.animations.add('downwalk',[9, 10, 11,12,13,14,15,16]);
     //   monster1.animations.play('rightwalk', 60, true);
    //    game.add.tween(monster1).to({ x: 10 }, 10000, Phaser.Easing.Linear.None, true);
///////////////////////////////////////////

//////////////////////////////////////////////
        monster3 = game.add.sprite(980, 110, 'stand');
        game.physics.enable(monster3, Phaser.Physics.ARCADE);

        monster4 = game.add.sprite(1530, 280, 'church');
        game.physics.enable(monster4, Phaser.Physics.ARCADE);

        monster5 = game.add.sprite(980, 860, 'npc');
        game.physics.enable(monster5, Phaser.Physics.ARCADE);
    //    game.add.tween(monster1).to({ x: 10 }, 10000, Phaser.Easing.Linear.None, true);
///////////////////////////////////////////
        portal = new Array();

        portal[1] = game.add.sprite(192, 96, 'portal00001');
        game.physics.enable(portal[1], Phaser.Physics.ARCADE);
        portal[1]['dest']=1;

        portal[2] = game.add.sprite(1290, 1354, 'portal00002');
        game.physics.enable(portal[2], Phaser.Physics.ARCADE);
        portal[2]['dest']=7;

        portal[3]= game.add.sprite(20, 900, 'portal00003');
        game.physics.enable(portal[3], Phaser.Physics.ARCADE);
        portal[3]['dest']=8;

    },

    update: function() {
        this.physics.arcade.collide(sprite, layer);
        
        this.physics.arcade.collide(sprite, portal[1],jump);
        this.physics.arcade.collide(sprite, portal[2],jump);
        this.physics.arcade.collide(sprite, portal[3],jump);
         
         

        this.physics.arcade.collide(sprite, monster5,npc);
        this.physics.arcade.collide(sprite, monster4,church);
        this.physics.arcade.collide(sprite, monster3,shop);
        this.physics.arcade.collide(sprite, monster2,bank);
        this.physics.arcade.collide(sprite, monster1,bank);       
        this.physics.arcade.collide(monster2, layer);


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


        if (monster2.x >= 300) {
            //   monster2.scale.x += 0.01;
            //    monster2.scale.y += 0.01;
        }
    },

    render: function() {
           game.debug.spriteCoords(sprite, 32, 32);

// game.debug.cameraInfo(game.camera, 96, 64);
    }
};
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////




