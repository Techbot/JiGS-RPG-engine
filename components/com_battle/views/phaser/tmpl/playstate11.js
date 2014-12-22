/**
 * Created by techbot on 17/11/14.
 */

playState[11] = {
    init: function() {
        //Called as soon as we enter this state
    },

    preload: function() {
        var grid = paddy(11,3);
        game.load.tilemap('world', '/components/com_battle/views/phaser/tmpl/grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.image('Zombie_A5', '/components/com_battle/views/phaser/tmpl/assets/tiles/Zombie_A5.png');
        // game.load.image('Zombie_A4', 'assets/tiles/Zombie_A4.png');
        game.load.image('TileA4', '/components/com_battle/views/phaser/tmpl/assets/tiles/TileA4.png');
        game.load.image('TileA5', '/components/com_battle/views/phaser/tmpl/assets/tiles/TileA5.png');
        game.load.image('TileE', '/components/com_battle/views/phaser/tmpl/assets/tiles/TileE.png');
        game.load.image('arrow', '/components/com_battle/views/phaser/tmpl/assets/frog.gif');
        game.load.image('mushroom', '/components/com_battle/views/phaser/tmpl/assets/sprites/mushroom2.png');
        game.load.image('sonic', '/components/com_battle/views/phaser/tmpl/assets/sprites/sonic_havok_sanity.png');
        game.load.spritesheet('ms', '/components/com_battle/views/phaser/tmpl/assets/sprites/metalslug_mummy37x45.png', 37, 45, 18);
        game.load.spritesheet('monster', '/components/com_battle/views/phaser/tmpl/assets/Monsters/Beast of Burden/Monster_BeastofBurden_FullFrame.png', 185, 165, 8);
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
        // load the tiled map, notice it is "tiledmap" and not "tilemap"
        game.load.tiledmap(cacheKey('world', 'tiledmap'), 'grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);

        // load the images for your tilesets, make sure the last param to "cacheKey" is
        // the name of the tileset in your map so the plugin can find it later
        game.load.image(cacheKey('Zombie_A5', 'tileset', 'Zombie_A5'), '/components/com_battle/views/phaser/tmpl/assets/tiles/Zombie_A5.png');
        game.load.image(cacheKey('obstacles', 'tileset', 'Zombie_A1'), '/components/com_battle/views/phaser/tmpl/assets/tiles/Zombie_A1.png');
        game.load.image(cacheKey('obstacles', 'tileset', 'Zombie_A4'), '/components/com_battle/views/phaser/tmpl/assets/tiles/Zombie_A4.png'); 
       
        game.load.image(cacheKey('002-Woods01', 'tileset', '002-Woods01'), '/components/com_battle/views/phaser/tmpl/assets/tiles/002-Woods01.png');
        game.load.image(cacheKey('TileC', 'tileset', 'TileC'), '/components/com_battle/views/phaser/tmpl/assets/tiles/tiles/TileC.png');
        game.load.image(cacheKey('032-Heaven01', 'tileset', '032-Heaven01'), '/components/com_battle/views/phaser/tmpl/assets/tiles/032-Heaven01.png');
       
              
        game.load.image(cacheKey('TileA4', 'tileset', 'TileA4'), '/components/com_battle/views/phaser/tmpl/assets/tiles/TileA4.png');
        game.load.image(cacheKey('obstacles', 'tileset', 'TileA5'), '/components/com_battle/views/phaser/tmpl/assets/tiles/TileA5.png');        

        // if you have image layers, be sure to load those too! Again,
        // make sure the last param is the name of your layer in the map.
        game.load.image(cacheKey('grid001optimised', 'layer', 'grid001optimised'), '/components/com_battle/views/phaser/tmpl/assets/grid001optimised.png');

       cursors = game.input.keyboard.createCursorKeys();
        game.input.onDown.add(moveBall, this);


        map = game.add.tilemap('world');
        // map.addTilesetImage('TileA4', 'TileA4');
        // map.addTilesetImage('TileA5', 'TileA5');
        // map.addTilesetImage('Zombie_A4', 'Zombie_A4');
        map.addTilesetImage('Zombie_A5', 'Zombie_A5');
       
        map.addTilesetImage('TileE', 'TileE');

        layer3 = map.createLayer('ground');
        layer = map.createLayer('obstacles');
        layer4 = map.createLayer('ground2');
        layer2 = map.createLayer('objects');

        map.setCollisionBetween(0, 10000,true,'obstacles');

        sprite = game.add.sprite(370, 300, 'arrow');
        sprite.anchor.setTo(0.5, 0.5);

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
        game.add.tween(sprite2).to({ x: destination }, 10000, Phaser.Easing.Linear.None, true);

     /*   monster1 = game.add.sprite(1000, 200, 'monster');
        game.physics.enable(monster1, Phaser.Physics.ARCADE);

        monster1.animations.add('upwalk',[1, 2, 3,4,5,6,7,8]);
        monster1.animations.add('leftwalk',[9, 10, 11,12,13,14,15,16]);
        monster1.animations.add('rightwalk',[9, 10, 11,12,13,14,15,16]);
        monster1.animations.add('downwalk',[9, 10, 11,12,13,14,15,16]);
        monster1.animations.play('rightwalk', 60, true);

        game.add.tween(monster1).to({ x: 10 }, 10000, Phaser.Easing.Linear.None, true);
*/
///////////////////////////////////////////
        portal = new Array();

        portal[1] = game.add.sprite(889, 0, 'portal00001');
        game.physics.enable(portal[1], Phaser.Physics.ARCADE);
        portal[1]['dest']=5;

        portal[2] = game.add.sprite(1290, 1354, 'portal00002');
        game.physics.enable(portal[2], Phaser.Physics.ARCADE);
        portal[2]['dest']=6;

        portal[3]= game.add.sprite(640, 580, 'portal00003');
        game.physics.enable(portal[3], Phaser.Physics.ARCADE);
        portal[3]['dest']=7;
///////////////////////////////////////////

    },

    update: function() {
        this.physics.arcade.collide(sprite, layer);

        this.physics.arcade.collide(sprite, sprite2,battle);
        //this.physics.arcade.collide(sprite, monster1,battle2);

        this.physics.arcade.collide(sprite, portal[1],jump);
        this.physics.arcade.collide(sprite, portal[2],jump);
        this.physics.arcade.collide(sprite, portal[3],jump);
        this.physics.arcade.collide(sprite2, layer);

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

function battle() {
    game.state.add('next', loadState);
    game.state.start('next');
}

function battle1() {
    grid = 7;
    game.state.add('next', playState7);
    game.state.start('next');
}
function battle2() {
    grid = 8;
    game.state.add('next', playState8);
    game.state.start('next');
}

function bank() {
    monster1.destroy(true);
    monster2.destroy(true);

    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=building&id=11059",
        context: document.body,
        dataType: "json"
    }).done(function(result) {


        document.getElementById("mainbody").innerHTML=result;

        var url = "/components/com_battle/includes/building.js";
        jQuery.getScript( url, function() {
            alert ('hi');

            success2();

        });
        function success(){
            alert('one');


        }

    });

}
function shop() {
    monster1.destroy(true);
    monster2.destroy(true);
    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=building&id=1739",
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        document.getElementById("mainbody").innerHTML=result;
        //   document.getElementById('loadarea_0').src= '/components/com_battle/includes/building.js';
        jQuery.ajax({
            type: "GET",
            url: "/components/com_battle/includes/building.js",
            dataType: "script"
        });
        //	mything.replaces(document.id('world'));
    });
}
function church() {
    monster3.destroy(true);
    monster4.destroy(true);
    window.location.assign("/index.php?option=com_wrapper&view=wrapper&Itemid=404")


}
function npc() {
    monster4.destroy(true);
    monster5.destroy(true);

    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=character&id=3002",
        context: document.body,
        dataType: "json"
    }).done(function(result) {


        mything = new Element ('div',{'id':"NPC",
            html:result,
            'style':'border 1px solid #F00; '});





//  mything = new Element ('div',{'id':"building",html:result,'style':'border 1px solid #F00; '});

        document.getElementById("mainbody").innerHTML=$(mything).val();

        //   document.getElementById('loadarea_0').src= '/components/com_battle/includes/building.js';
        /*      jQuery.ajax({
         type: "GET",
         url: "/components/com_battle/includes/character.js",
         dataType: "script"
         });
         */
        //  mything.replaces(document.id('world'));
    });
//http://eclecticmeme.com/index.php?option=com_battle&format=json&view=building&id=11059
}


function jump00002(){
    grid = 2;
    console.log("grid : " + grid);
    game.state.add('next', playState2);
    game.state.start('next');
}

function jump00003(){
    grid = 3;
    console.log("grid : " + grid);
    game.state.add('next', playState3);
    game.state.start('next');
}
function jump00004(){
    grid = 4;
    console.log("grid : " + grid);
    game.state.add('next', playState4);
    game.state.start('next');
}

