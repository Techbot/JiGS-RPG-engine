/**
 * Created by techbot on 17/11/14.
 */

playState[21] = {
    init: function() {
        //Called as soon as we enter this state
    },

    preload: function() {
        var grid = paddy(21,3);
        game.load.tilemap('world', '/components/com_battle/views/phaser/tmpl/grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
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
        game.load.image('sonic', '/components/com_battle/images/assets//sprites/sonic_havok_sanity.png');
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
        var cacheKey = Phaser.Plugin.Tiled.utils.cacheKey;
        game.load.tiledmap(cacheKey('world', 'tiledmap'), 'grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.image(cacheKey('Zombie_A5', 'tileset', 'Zombie_A5'), '/components/com_battle/images/assets/Zombie_A5.png');
        game.load.image(cacheKey('Zombie_TileD', 'tileset', 'Zombie_TileD'), '/components/com_battle/images/assets/Zombie_TileD.png');
        game.load.image(cacheKey('Zombie_TileC', 'tileset', 'Zombie_TileC'), '/components/com_battle/images/assets/Zombie_TileC.png');
        game.load.image(cacheKey('TileE', 'tileset', 'TileE'), '/components/com_battle/images/assets/TileE.png'); 
        game.load.image(cacheKey('TileB', 'tileset', 'TileB'), '/components/com_battle//images/assets/TileB.png');        
       
        ///game.load.image(cacheKey('002-Woods01', 'tileset', '002-Woods01'), ' assets/tiles/002-Woods01.png');
        //game.load.image(cacheKey('TileC', 'tileset', 'TileC'), 'assets/tiles/TileC.png');
        //game.load.image(cacheKey('032-Heaven01', 'tileset', '032-Heaven01'), '  assets/tiles/032-Heaven01.png');

        game.load.image(cacheKey('portal00001', 'tileset', 'portal00001'), '/components/com_battle/images/assets/tiles/Dungeon_A1.png');
        game.load.image(cacheKey('portal00002', 'tileset', 'portal00002'), '/components/com_battle/images/assets/tiles/Dungeon_B.png');
        game.load.image(cacheKey('portal00003', 'tileset', 'portal00003'), '/components/com_battle/images/assets/tiles/Dungeon_C.png');   

         
        game.load.image(cacheKey('TileA4', 'tileset', 'TileA4'), '/components/com_battle/images/assets/TileA4.png');
        game.load.image(cacheKey('TileA5', 'tileset', 'TileA5'), '/components/com_battle/images/assets/TileA5.png');        

        // if you have image layers, be sure to load those too! Again,
        // make sure the last param is the name of your layer in the map.
        game.load.image(cacheKey('grid001optimised', 'layer', 'grid001optimised'), 'grid001optimised.png');

        cursors = game.input.keyboard.createCursorKeys();
        game.input.onDown.add(moveBall, this);

        map = game.add.tilemap('world');
        layer3 = map.createLayer('ground');
        layer = map.createLayer('obstacles');
        layer4 = map.createLayer('ground2');
        layer2 = map.createLayer('objects');

        map.addTilesetImage('TileA4', 'TileA4');
        map.addTilesetImage('TileA5', 'TileA5');
        map.addTilesetImage('TileB', 'TileB');
    //   map.addTilesetImage('Zombie_TileC', 'Zombie_TileC');
    //   map.addTilesetImage('Zombie_TileD', 'Zombie_TileD');
        map.addTilesetImage('TileE', 'TileE');

        map.setCollisionBetween(0, 10000,true,'obstacles');
        sprite = game.add.sprite(370, 300, 'arrow');
        game.physics.enable(sprite, Phaser.Physics.ARCADE);
        sprite.body.allowRotation = false;
        this.camera.follow(sprite, Phaser.Camera.FOLLOW_TOPDOWN_TIGHT);
        sprite2 = game.add.sprite(40, 100, 'ms');
        game.physics.enable(sprite2, Phaser.Physics.ARCADE);
        sprite2.animations.add('walk');
        sprite2.animations.play('walk', 50, true);
        destination = layer.width;
        
        if (sprite2.x > 300){
            destination = 10;
        }
        game.add.tween(sprite2).to({ x: destination }, 10000, Phaser.Easing.Linear.None, true);
//////////////////////////////////////////////
        portal = new Array();
        portal[1] = game.add.sprite(480, 40, 'portal00001');
        portal[1]['dest']=2;
        game.physics.enable(portal[1], Phaser.Physics.ARCADE);
        portal[2] = game.add.sprite(996, 190, 'portal00002');
        game.physics.enable(portal[2], Phaser.Physics.ARCADE);
        portal[2]['dest']=3;

        portal[3] = game.add.sprite(25, 190, 'portal00003');
        game.physics.enable(portal[3], Phaser.Physics.ARCADE);
        portal[3]['dest']=4;
    //    game.add.tween(monster1).to({ x: 10 }, 10000, Phaser.Easing.Linear.None, true);
///////////////////////////////////////////
    },
    update: function() {
        this.physics.arcade.collide(sprite, layer);
        this.physics.arcade.collide(sprite2, layer);
        this.physics.arcade.collide(sprite, portal[1],jump);
        this.physics.arcade.collide(sprite, portal[2],jump);
        this.physics.arcade.collide(sprite, portal[3],jump);

        if ((parseInt(game.physics.arcade.distanceToPointer(sprite)) <= 50)) {
            console.log('cool');
        }
        else {
        }
        game.physics.arcade.moveToXY(sprite, x, y, 100);
        if ((sprite.body.x >=x-10) &&(sprite.body.x <=x+10)){
            sprite.body.velocity.x = 0;
        }

        if ((sprite.body.y >=y-10) &&(sprite.body.y <=y+10)){
            sprite.body.velocity.y = 0;
        }
        if (cursors.up.isDown) {
            game.camera.y -= 4;
        }
        else if (cursors.down.isDown) {
            game.camera.y += 4;
        }

        if (cursors.left.isDown) {
            game.camera.x -= 4;
        }
        else if (cursors.right.isDown) {
            game.camera.x += 4;
        }
        if (sprite2.x >= 300) {
        }
    },

    render: function() {
           game.debug.spriteCoords(sprite, 32, 32);

// game.debug.cameraInfo(game.camera, 96, 64);
    }
};
