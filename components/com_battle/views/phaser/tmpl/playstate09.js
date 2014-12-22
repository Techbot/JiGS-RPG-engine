playState[9] = {
    init: function() {
    },
    preload: function() {

        var grid = paddy(9,3);
        game.load.tilemap('world', '/components/com_battle/views/phaser/tmpl/grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.image('TileA5', '/components/com_battle/images/assets/tiles/TileA5.png');
        game.load.image('TileE', '/components/com_battle/images/assets/tiles/TileE.png');
        game.load.image('arrow', '/components/com_battle/images/assets/frog.gif');
        game.load.spritesheet('portal00001', '/components/com_battle/images/assets/tiles/Dungeon_A1.png', 32, 64, 1);
        game.load.spritesheet('portal00002', '/components/com_battle/images/assets/tiles/Dungeon_B.png', 32, 64, 1);
        game.load.spritesheet('portal00003', '/components/com_battle/images/assets/tiles/Dungeon_C.png', 32, 64, 1);
    },
    create: function() {
        game.physics.startSystem(Phaser.Physics.ARCADE);
        game.add.plugin(Phaser.Plugin.Tiled);
        game.world.setBounds(-1000, -1000, 3200, 3200);
        game.stage.backgroundColor = '#787878';
        game.input.onDown.add(moveBall, this);
        var cacheKey = Phaser.Plugin.Tiled.utils.cacheKey;
        game.load.tiledmap(cacheKey('world', 'tiledmap'), 'grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.image(cacheKey('TileE', 'tileset', 'TileE'), '/components/com_battle/images/assets/TileE.png');
        game.load.image(cacheKey('TileA5', 'tileset', 'TileA5'), '/components/com_battle/images/assets/TileA5.png');
        game.load.image(cacheKey('arrow','image','arrow'),  '/components/com_battle/views/phaser/tmpl/assets/frog.gif');
        game.input.onDown.add(moveBall, this);
        map = game.add.tilemap('world');
        layer3 = map.createLayer('ground');
        layer1 = map.createLayer('obstacles');
        layer4 = map.createLayer('ground2');
        layer2 = map.createLayer('objects');
        map.addTilesetImage('TileA5', 'TileA5');
        map.addTilesetImage('TileE', 'TileE');
        layer1.resizeWorld();
        map.setCollisionBetween(0, 10000,true,'obstacles');
        sprite = game.add.sprite(370, 300, 'arrow');
        sprite.anchor.setTo(0.5, 0.5);
        game.physics.enable(sprite, Phaser.Physics.ARCADE);
        this.camera.follow(sprite, Phaser.Camera.FOLLOW_TOPDOWN_TIGHT);
        portal00001 = game.add.sprite(2110, 256, 'portal00001');
        game.physics.enable(portal00001, Phaser.Physics.ARCADE);
        portal00002 = game.add.sprite(1396, 128, 'portal00002');
        game.physics.enable(portal00002, Phaser.Physics.ARCADE);
        portal00003 = game.add.sprite(140, 200, 'portal00003');
        game.physics.enable(portal00003, Phaser.Physics.ARCADE);
    },
    update: function() {
        this.physics.arcade.collide(sprite, layer);
        game.physics.arcade.moveToXY(sprite, x, y, 100);
        if ((sprite.body.x >=x-10) &&(sprite.body.x <=x+10)){
            sprite.body.velocity.x = 0;
        }
        if ((sprite.body.y >=y-10) &&(sprite.body.y <=y+10)){
            sprite.body.velocity.y = 0;
        }
    },
    render: function() {
       // game.debug.spriteCoords(sprite, 32, 32);
       // game.debug.cameraInfo(game.camera, 96, 64);
    }
};