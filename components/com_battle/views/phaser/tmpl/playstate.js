/**
 * Created by techbot on 17/11/14.
 */

playState = {
    init: function() {
        //Called as soon as we enter this state
    },

    preload: function() {
        //  Tilemaps are split into two parts: The actual map data (usually stored in a CSV or JSON file)
        //  and the tileset/s used to render the map.

        //  Here we'll load the tilemap data. The first parameter is a unique key for the map data.

        //  The second is a URL to the JSON file the map data is stored in. This is actually optional, you can pass the JSON object as the 3rd
        //  parameter if you already have it loaded (maybe via a 3rd party source or pre-generated). In which case pass 'null' as the URL and
        //  the JSON object as the 3rd parameter.

        //  The final one tells Phaser the foramt of the map data, in this case it's a JSON file exported from the Tiled map editor.
        //  This could be Phaser.Tilemap.CSV too.
        game.load.tilemap('ground', '/components/com_battle/views/phaser/tmpl/grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.tilemap('obstacles', '/components/com_battle/views/phaser/tmpl/grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.tilemap('ground2', '/components/com_battle/views/phaser/tmpl/grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        game.load.tilemap('objects', '/components/com_battle/views/phaser/tmpl/grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        //  Next we load the tileset. This is just an image, loaded in via the normal way we load images:


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
        game.load.image('mushroom', '/components/com_battle/views/phaser/tmpl/assets/sprites/mushroom2.png');
        game.load.image('sonic', '/components/com_battle/views/phaser/tmpl/assets/sprites/sonic_havok_sanity.png');
        game.load.image('phaser', '/components/com_battle/views/phaser/tmpl/assets/sprites/phaser1.png');

        //  37x45 is the size of each frame
        //  There are 18 frames in the PNG - you can leave this value blank if the frames fill up the entire PNG, but in this case there are some
        //  blank frames at the end, so we tell the loader how many to load
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
        // By using the built-in cache key creator, the plugin can
        // automagically find all the necessary items in the cache
        var cacheKey = Phaser.Plugin.Tiled.utils.cacheKey;
        // load the tiled map, notice it is "tiledmap" and not "tilemap"
        game.load.tiledmap(cacheKey('obstacles', 'tiledmap'), 'grid00' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
        // load the images for your tilesets, make sure the last param to "cacheKey" is
        // the name of the tileset in your map so the plugin can find it later
        game.load.image(cacheKey('Zombie_A5', 'tileset', 'Zombie_A5'), '/components/com_battle/images/assets/tiles/Zombie_A5.png');
        game.load.image(cacheKey('Zombie_A1', 'tileset', 'Zombie_A1'), '/components/com_battle/images/assets/tiles/Zombie_A1.png');
        
        game.load.image(cacheKey('Zombie_A3', 'tileset', 'Zombie_A4'), '/components/com_battle/images/assets/tiles/Zombie_A3.png'); 
        game.load.image(cacheKey('Zombie_A4', 'tileset', 'Zombie_A4'), '/components/com_battle/images/assets/tiles/Zombie_A4.png'); 
        game.load.image(cacheKey('033-Heaven02', 'tileset', '033-Heaven02'), '/components/com_battle/assets/tiles/033-Heaven02.png'); 
		game.load.image(cacheKey('032-Heaven01', 'tileset', '032-Heaven01'), '/components/com_battle/assets/tiles/032-Heaven01.png');
		game.load.image(cacheKey('035-Ruins01', 'tileset', ' 035-Ruins01'), '/components/com_battle/assets/tiles/035-Ruins01.png');

        
        
        
        game.load.image(cacheKey('TileE', 'tileset', 'TileE'), '/components/com_battle/images/assets/tiles/TileE.png');

        
        game.load.image(cacheKey('002-Woods01', 'tileset', '002-Woods01'), '/components/com_battle/images/assets/tiles/002-Woods01.png');
        game.load.image(cacheKey('TileC', 'tileset', 'TileC'), '/components/com_battle/images/assets/tiles/TileC.png');
        
        
        game.load.image(cacheKey('TileA4', 'tileset', 'TileA4'), '/components/com_battle/images/assets/tiles/TileA4.png');
        game.load.image(cacheKey('TileA5', 'tileset', 'TileA5'), '/components/com_battle/images/assets/tiles/TileA5.png');        

        
        game.load.image(cacheKey('portal00001', 'tileset', 'portal00001'), '/components/com_battle/images/assets/tiles/Dungeon_A1.png');
        game.load.image(cacheKey('portal00002', 'tileset', 'portal00002'), '/components/com_battle/images/assets/tiles/Dungeon_B.png');
        game.load.image(cacheKey('portal00003', 'tileset', 'portal00003'), '/components/com_battle/images/assets/tiles/Dungeon_C.png');        
        
        
        // if you have image layers, be sure to load those too! Again,
        // make sure the last param is the name of your layer in the map.
        game.load.image(cacheKey('grid001optimised', 'layer', 'grid001optimised'), '/components/com_battle/images/assets/grid001optimised.png');
        ////////////
        // Later after loading is complete:

        // add the tiledmap to the game
        // this method takes the key for the tiledmap which has been used in the cacheKey calls
        // earlier, and an optional group to add the tilemap to (defaults to game.world).
        //var map = game.add.tiledmap('obstacles');

        for (var i = 0; i < 200; i++)
        {
            //      game.add.sprite(game.world.randomX, game.world.randomY, 'mushroom');
        }

        //  game.add.text(0, 0, "this text scrolls\nwith the background", { font: "32px Arial", fill: "#f26c4f", align: "center" });
        phaser = game.add.sprite(0, 0, 'phaser');
		//  phaser.cameraOffset.setTo(280, 250);

        //  phaser.anchor.setTo(0.5, 0.5);
        // game.physics.startSystem(Phaser.Physics.ARCADE);
        // var t = game.add.text(0, 0, "this text is fixed to the camera", { font: "32px Arial", fill: "#ffffff", align: "center" });
        // t.fixedToCamera = true;
        // t.cameraOffset.setTo(200, 500);
        // game.add.tween(logo2.cameraOffset).to( { y: 400 }, 2000, Phaser.Easing.Back.InOut, true, 0, 2000, true);
        cursors = game.input.keyboard.createCursorKeys();
        game.input.onDown.add(moveBall, this);
        game.physics.arcade.enable(phaser);
        //      phaser.body.velocity.set(200, 200);
        //  phaser.body.bounce.set(1, 1);
        phaser.body.collideWorldBounds = true;
        //  The 'mario' key here is the Loader key given in game.load.tilemap
        map = game.add.tilemap('obstacles');
        // The first parameter is the tileset name, as specified in the Tiled map editor (and in the tilemap json file)
        // The second parameter maps this name to the Phaser.Cache key 'tiles'
        // map.addTilesetImage('obstacles', 'obstacles');
		// map.addTilesetImage('TileA4', 'TileA4');
		// map.addTilesetImage('TileA5', 'TileA5');
		// map.addTilesetImage('Zombie_A4', 'Zombie_A4');
		map.addTilesetImage('Zombie_A5', 'Zombie_A5');
		map.addTilesetImage('TileE', 'TileE');
        //  Creates a layer from the World1 layer in the map data.
        //  A Layer is effectively like a Phaser.Sprite, so is added to the display list.
        layer3 = map.createLayer('ground');
        layer = map.createLayer('obstacles');
        layer4 = map.createLayer('ground2');
        layer2 = map.createLayer('objects');
        //  This resizes the game world to match the layer dimensions
        //   layer.resizeWorld();
        map.setCollisionBetween(0, 10000,true,'obstacles');
        // paddle = game.add.sprite(game.world.centerX, 500, 'breakout', 'Main_MP1_Cuthbert_FullFrame.png');
        
//////////////////////////////////////////////////////////        
        
        sprite = game.add.sprite(840, 300, 'arrow');
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
        monster1.animations.add('upwalk',[1, 2, 3,4,5,6,7,8]);
        monster1.animations.add('leftwalk',[9, 10, 11,12,13,14,15,16]);
		monster1.animations.add('rightwalk',[9, 10, 11,12,13,14,15,16]);
		monster1.animations.add('downwalk',[9, 10, 11,12,13,14,15,16]);
        monster1.animations.play('rightwalk', 60, true);
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










//////////////////////////////////////////////
        portal00001 = game.add.sprite(14, 628, 'portal00001');
		game.physics.enable(portal00001, Phaser.Physics.ARCADE);
		
		portal00002 = game.add.sprite(1290, 1354, 'portal00002');
		game.physics.enable(portal00002, Phaser.Physics.ARCADE);

		portal00003 = game.add.sprite(31, 1365, 'portal00003');
		
		//portal00003 = game.add.sprite(840, 400, 'portal00003');
		
		
		game.physics.enable(portal00003, Phaser.Physics.ARCADE);
    //    game.add.tween(monster1).to({ x: 10 }, 10000, Phaser.Easing.Linear.None, true);
///////////////////////////////////////////












    },

    update: function() {
        this.physics.arcade.collide(sprite, layer);
        
        this.physics.arcade.collide(sprite, portal00001,jump00002);
        this.physics.arcade.collide(sprite, portal00002,jump00003); 
    	this.physics.arcade.collide(sprite, portal00003,jump00004);
         
         
             
        this.physics.arcade.collide(sprite, monster5,npc);
        this.physics.arcade.collide(sprite, monster4,church);
        this.physics.arcade.collide(sprite, monster3,shop);
        this.physics.arcade.collide(sprite, monster2,bank);
        this.physics.arcade.collide(sprite, monster1,bank);       
        this.physics.arcade.collide(monster2, layer);

        if ((parseInt(game.physics.arcade.distanceToPointer(sprite)) <= 50)) {
            console.log('cool');
           // player.body.velocity.x = 0;
          //    player.body.velocity.y = 0;
        }
        else {
            //	console.log( (parseInt(game.physics.arcade.distanceToPointer(sprite))));

        }

        //sprite.rotation = game.physics.arcade.moveToPointer(sprite, 600);
        game.physics.arcade.moveToXY(sprite, x, y, 200);

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


function battle() {
    game.state.add('next', loadState);
    game.state.start('next');
}

function battle1() {
	grid = 2;
    game.state.add('next', playState2);
    game.state.start('next');
}
function battle2() {
	grid = 3;
    game.state.add('next', playState3);
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
	
//	mything = new Element ('div',{'id':"building",html:result,'style':'border 1px solid #F00; '});			
        document.getElementById("mainbody").innerHTML=result;
    //    document.getElementById('loadarea_0').src= '/components/com_battle/includes/building.js';


/*

        jQuery.ajax({
            type: "GET",
            url: "/components/com_battle/includes/building.js",
            dataType: "script",
            success: success
        });

*/

        var url = "/components/com_battle/includes/building.js";
        jQuery.getScript( url, function() {
            alert ('hi');

            success2();

        });



function success(){
alert('one');


}














			//	mything.replaces(document.id('world'));
	});
//http://eclecticmeme.com/index.php?option=com_battle&format=json&view=building&id=11059
}

//1739
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





//	mything = new Element ('div',{'id':"building",html:result,'style':'border 1px solid #F00; '});			
 	
 			document.getElementById("mainbody").innerHTML=$(mything).val();
		 
 			 //   document.getElementById('loadarea_0').src= '/components/com_battle/includes/building.js';
		/*		jQuery.ajax({
					type: "GET",
					url: "/components/com_battle/includes/character.js",
					dataType: "script"
					});
		*/
			//	mything.replaces(document.id('world'));
	});
//http://eclecticmeme.com/index.php?option=com_battle&format=json&view=building&id=11059
}


function jump00002(){
	grid = 2;
    game.state.add('next', playState2);
    game.state.start('next');
}

function jump00003(){
	grid = 5;
    game.state.add('next', playState5);
    game.state.start('next');
}
function jump00004(){
	grid = 4;
    game.state.add('next', playState4);
    game.state.start('next');
}

