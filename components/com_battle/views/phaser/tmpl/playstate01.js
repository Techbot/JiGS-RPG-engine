/**
 * Created by techbot on 17/11/14.
 */
playState[1] = {
    init: function() {
        //Called as soon as we enter this state
        console.log('hi');
    },
    preload: function() {

        var number = paddy(grid,3);
        // game.load.spritesheet('ms', '/components/com_battle/images/assets/metalslug_mummy37x45.png', 37, 45, 18);
        //
        // //////////// load monsters
        if (typeof monsters_list != 'undefined') {

            //load assets
            for (var index = 0; index < monsters_list.length; index++) {
                var filename = monsters_list[index].spritesheet;
      //        game.load.spritesheet(filename, '/components/com_battle/images/assets/chars/monsters/' + filename + '/'+ filename + '.png', monsters_list[index].cellwidth, monsters_list[index].cellheight, 16);
                console.log ('cellwidth:' + monsters_list[index].cellwidth);
                game.load.spritesheet(filename, '/components/com_battle/images/assets/chars/monsters/' + filename + '/'+ filename + '.png', parseInt(monsters_list[index].cellwidth),  parseInt(monsters_list[index].cellheight), 16);
            }
        }

        ///////////////////// load players
        if(players_list.length != 0) {
            for (var index = 0; index < players_list.length; index++) {
                var filename = players_list[index].avatar;
                if (filename==null){
                    filename= 'gallery/skater.gif';
                }
                var key = players_list[index].id;
                console.log("filename : " + filename);

                if (filename.substring(0,7)!= 'gallery') {
                    game.load.image(key, '/images/comprofiler/tn' + filename);
                }else
                {
                    game.load.image(key, '/images/comprofiler/' + filename);
                }
            }
        }

        ///////////////////// load buildings
        if(buildings.length != 0) {

            for (var index = 0; index < buildings.length; index++) {
                var filename = buildings[index].image;
                var key = buildings[index].id;
                //  console.log("filename : " + filename);
                game.load.image("_" + key, '/components/com_battle/images/buildings/' + filename);
            }
        }

        ///////////////////// load twines
        if(twines_list.length != 0) {

            for (var index = 0; index < twines_list.length; index++) {
                var filename = twines_list[index].image;
                var key = twines_list[index].id;
                //  console.log("filename : " + filename);
                game.load.image( key, '/components/com_battle/images/twines/' + filename);
            }
        }

        ///////////////////// load plate
        if(plates_list.length != 0) {

            for (var index = 0; index < plates_list.length; index++) {
                var filename2 = plates_list[index].image;
                var key = plates_list[index].id;
                //  console.log("filename : " + filename);
                game.load.image( key, '/components/com_battle/images/plates/' + filename2);
            }
        }

        ///////////////////// load terminals
        if(terminals_list.length != 0) {

            for (var index = 0; index < terminals_list.length; index++) {
                var filename = terminals_list[index].image;
                var key = terminals_list[index].image;
                //  console.log("filename : " + filename);
                game.load.image( key, '/components/com_battle/images/buildings/' + filename);
            }
        }

        ///////////////////// load chars
        if(npc_list.length != 0) {
            for (var index = 0; index < npc_list.length; index++) {
                var filename = npc_list[index].avatar;
                var key = npc_list[index].name;
                //    console.log("key : " + key);
                // console.log("filename : " + filename);
                game.load.image(key, '/components/com_battle/images/ennemis/miniatures/' + filename);
            }
        }
        if (avatar ==null) {
            ////////////////// load guest
            game.load.image('arrow', '/images/comprofiler/gallery/frog.gif');
        }
        else {
            ////////////////// load player
            if (avatar.substring(0, 7) != 'gallery') {
                game.load.image('arrow', '/images/comprofiler/tn' + avatar);
            } else {
                game.load.image('arrow', '/images/comprofiler/' + avatar);
            }
        }
        ////////////////// load portals
        game.load.spritesheet('portal00001', '/components/com_battle/images/assets/tiles/portals_1.png', 64, 64, 1);
        game.load.spritesheet('portal00002', '/components/com_battle/images/assets/tiles/portals_2.png', 64, 64, 1);
        game.load.spritesheet('portal00003', '/components/com_battle/images/assets/tiles/portals_3.png', 64, 64, 1);

        //load tiles
        for	(var index = 0; index < tile_names[grid].length; index++) {
            var filename = tile_names[grid][index];
            console.log(filename);
            game.load.image(filename, '/components/com_battle/images/assets/tiles/' + filename +'.png');
        }
        ////////

        game.load.tilemap('world', 'components/com_battle/views/phaser/tmpl/grid' + number + '.json', null, Phaser.Tilemap.TILED_JSON);

    },
    create: function() {
        game.physics.startSystem(Phaser.Physics.ARCADE);
        game.add.plugin(Phaser.Plugin.Tiled);
        //  Modify the world and camera bounds
        game.world.setBounds(boundsX1[grid], boundsY1[grid], boundsX2[grid], boundsY2[grid]);
        //game.stage.backgroundColor = '#000000';
        var cacheKey = Phaser.Plugin.Tiled.utils.cacheKey;


        /////////////////// cache json file
        game.load.tiledmap(cacheKey('world', 'tiledmap'), 'grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);

        /////////////////// cache tiles
        for (var index = 0; index < tile_names[grid].length; index++) {
            var filename = tile_names[grid][index];
            game.load.image(cacheKey(filename, 'tileset', filename), '/components/com_battle/images/assets/tiles/' + filename + '.png');
        }

        /////////////////// cache monsters
        if (typeof monsters_list != 'undefined') {
            ///////////////////// cache assets
            for (var index = 0; index < monsters_list.length; index++) {
                var filename = monsters_list[index].spritesheet;
                console.log('filename:' + filename);
                game.load.spritesheet(cacheKey(filename, 'tileset', filename), '/components/com_battle/images/assets/char/monsters/' + filename + '/'+ filename + '.png');
            }
        }
        //////////////////// cache players
        for (var index = 0; index < players_list.length; index++) {
            var filename =players_list[index].avatar;
            if (filename==null){
                filename= 'gallery/skater.gif';
            }
            var key = players_list[index].id;

            if (filename.substring(0,7)!= 'gallery') {
                game.load.image(cacheKey(key, 'tileset', key), '/images/comprofiler/tn' + filename );
            }else
            {
                game.load.image(cacheKey(key, 'tileset', key), '/images/comprofiler/' + filename );
            }
        }
        //////////////////// cache buildings
        for (var index = 0; index < buildings.length; index++) {
            var filename = buildings[index].image;
            var key = buildings[index].id;
            game.load.image(cacheKey("_" + key, 'tileset', "_" + key), '/components/com_battle/images/buildings/' + filename );
        }
        //////////////////// cache twines_list
        for (var index = 0; index < twines_list.length; index++) {
            var filename = twines_list[index].image;
            var key = twines_list[index].id;
            game.load.image(cacheKey(key, 'tileset', "_" + key), '/components/com_battle/images/twines/' + filename );
        }
        //////////////////// cache plates_list
        for (var index = 0; index < plates_list.length; index++) {
            var filename = plates_list[index].image;
            var key = plates_list[index].id;
            game.load.image(cacheKey(key, 'tileset', "_" + key), '/components/com_battle/images/plates/' + filename );
        }
        //////////////////// cache terminals_list
        for (var index = 0; index < terminals_list.length; index++) {
            var filename = terminals_list[index].image;
            var key = terminals_list[index].image;
            game.load.image(cacheKey(key, 'tileset', "_" + key), '/components/com_battle/images/buildings/' + filename );
        }
        //////////////////// cache chars
        for (var index = 0; index < npc_list.length; index++) {
            var filename = npc_list[index].avatar;
            var key = npc_list[index].id;
            game.load.image(cacheKey(key, 'tileset', key), '/components/com_battle/images/ennemis/miniatures/' + filename );
        }

        //////////////////// cache Portals
        game.load.image(cacheKey('portal00001', 'tileset', 'portal00001'), '/components/com_battle/images/assets/tiles/Dungeon_A1.png');
        game.load.image(cacheKey('portal00002', 'tileset', 'portal00002'), '/components/com_battle/images/assets/tiles/Dungeon_B.png');
        game.load.image(cacheKey('portal00003', 'tileset', 'portal00003'), '/components/com_battle/images/assets/tiles/Dungeon_C.png');

        // if you have image layers, be sure to load those too! Again,
        // make sure the last param is the name of your layer in the map.
        game.load.image(cacheKey('grid001optimised', 'layer', 'grid001optimised'), 'grid001optimised.png');
        cursors = game.input.keyboard.createCursorKeys();
        game.input.onDown.add
       (moveBall, this);
        ///////////////////////////////////////////
        addMap();
        ///////////////////////////////////////////
        for (var index = 0; index < tile_names[grid].length; index++) {
            var filename = tile_names[grid][index];
            map.addTilesetImage(filename, filename);
        }
        /////////////////////////////////////////
        map.setCollisionBetween(0, 9000,true,'obstacles');
        /////////////////////////place player ///////////
        sprite = game.add.sprite(parseInt(new_x),parseInt(new_y), 'arrow');
        game.physics.enable(sprite, Phaser.Physics.ARCADE);
        sprite.body.enable =true;
        sprite.body.allowRotation = false;
        x = sprite.body.x;
        y = sprite.body.y;
        this.camera.follow(sprite, Phaser.Camera.FOLLOW_TOPDOWN_TIGHT);
        ///////////////////////place buildings//////
        if(buildings.length != 0) {
            for (var index = 0; index < buildings.length; index++) {
                var key = buildings[index].id;
                //console.log("_" + key);
                add_building[index] = game.add.sprite(buildings[index].posx * 1, buildings[index].posy * 1, "_" + key);
                add_building[index].id = key;
                game.physics.enable(add_building[index], Phaser.Physics.ARCADE);
                add_building[index].body.velocity = 0;
            }
        }
        ///////////////////////place twines//////
        if(twines_list.length != 0) {
            for (var index = 0; index < twines_list.length; index++) {
                var key = twines_list[index].id;
                //console.log("_" + key);
                add_twines[index] = game.add.sprite(twines_list[index].posx * 1, twines_list[index].posy * 1, key);
                add_twines[index].id = key;
                game.physics.enable(add_twines[index], Phaser.Physics.ARCADE);
                //add_pages[index].body.velocity = 0;
            }
        }
        ///////////////////////place plates//////
        if(plates_list.length != 0) {
            for (var index = 0; index < plates_list.length; index++) {
                var key = plates_list[index].id;
                //console.log("_" + key);
                add_plates[index] = game.add.sprite(plates_list[index].posx * 1, plates_list[index].posy * 1, key);
                add_plates[index].id = key;
                game.physics.enable(add_plates[index], Phaser.Physics.ARCADE);
                //add_plates[index].body.velocity = 0;
            }
        }
        ///////////////////////place terminals//////
        if(terminals_list.length != 0) {
            for (var index = 0; index < terminals_list.length; index++) {

                var key = terminals_list[index].image;
                //console.log("_" + key);
                add_terminals[index] = game.add.sprite(terminals_list[index].posx * 1, terminals_list[index].posy * 1, key);
                add_terminals[index].id = terminals_list[index].id;
                game.physics.enable(add_terminals[index], Phaser.Physics.ARCADE);
                //add_pages[index].body.velocity = 0;
            }
        }
        ////////////////////////place monsters//////
        if (typeof monsters_list != 'undefined') {
            for (var index = 0; index < monsters_list.length; index++)
            {
                var key = monsters_list[index].spritesheet;
                //console.log('key:' + key );
                monsters[index] = game.add.sprite(monsters_list[index].x, monsters_list[index].y, key);
                monsters[index].animations.add('stop',[0]);
                monsters[index].animations.add('walk_down',[0,1,2,3]);
                monsters[index].animations.add('walk_left',[4,5,6,7]);
                monsters[index].animations.add('walk_right',[8,9,10,11]);
                monsters[index].animations.add('walk_up',[12,13,14,15]);

                monsters[index].animations.play('walk_stop',1,true);
                monsters[index].id = key;
                //       monster[index].body.enable =true;
               game.physics.arcade.enable(monsters[index]);
            }
        }
        ////////////////////////place players//////
        players_group  = game.add.group();
        if (typeof players_list != 'undefined') {
            for (var index = 0; index < players_list.length; index++) {
                var key_id =players_list[index].id;
                var key = players_list[index].id
                add_players[index] = game.add.sprite(parseInt(players_list[index].posx),parseInt( players_list[index].posy), key);
                add_players[index].key_id = key_id;
                game.physics.enable(add_players[index], Phaser.Physics.ARCADE);
            }
        }
        ////////////////////place chars//////
        if(npc_list.length !=0 ) {
            for (var index = 0; index < npc_list.length; index++) {
                var key = npc_list[index].name;
                var key_id = npc_list[index].id;
                //console.log(key);
                add_npc[index] = game.add.sprite(parseInt(npc_list[index].posx) ,parseInt( npc_list[index].posy) , key);
                add_npc[index].id = key;
                add_npc[index].key_id = key_id;

                game.physics.enable(add_npc[index], Phaser.Physics.ARCADE);
                add_npc[index].body.velocity = 0;
            }
        }
        /////////////////////////////////////////////////////////////////
        portal[1] = game.add.sprite(x1[grid],y1[grid], 'portal00001');
        portal[1]['dest']=portal_dest_1[grid];
        game.physics.enable(portal[1], Phaser.Physics.ARCADE);
        portal[2] = game.add.sprite(x2[grid], y2[grid], 'portal00002');
        game.physics.enable(portal[2], Phaser.Physics.ARCADE);
        portal[2]['dest']=portal_dest_2[grid];
        portal[3] = game.add.sprite(x3[grid], y3[grid], 'portal00003');
        game.physics.enable(portal[3], Phaser.Physics.ARCADE);
        portal[3]['dest']=portal_dest_3[grid];
        game.add.tween(monsters[1]).to({ x: 100,y:101 }, 10000, Phaser.Easing.Linear.None, true);
        game.add.tween(monsters[0]).to({ x: 100,y:201 }, 10000, Phaser.Easing.Linear.None, true);

        ///////////////////////////////////////////
    },
    update: function() {
        //////////////////////////////collide obstacle layer
        this.physics.arcade.collide(sprite, layer);
        ////////////////////////////////////////////////
        this.physics.arcade.collide(sprite, portal[1],jump);
        this.physics.arcade.collide(sprite, portal[2],jump);
        this.physics.arcade.collide(sprite, portal[3],jump);
        ////////////////////////move player
        game.physics.arcade.moveToXY(sprite, x, y, 100);

        ////////////////////////move players
        if (typeof add_players != 'undefined' && players_list !='undefined') {
            for (var index = 0; index < add_players.length; index++) {
                if (typeof add_players[index] != 'undefined' && typeof players_list[index] !='undefined') {
                    game.physics.arcade.moveToXY(add_players[index], parseInt(players_list[index].posx), parseInt(players_list[index].posy), 100);
                }
            }
        }
        ////////////////////////move monsters
        if (typeof monsters != 'undefined') {
            for (var index = 0; index < monsters.length; index++) {
                if (typeof monsters[index] != 'undefined') {

                    if (monsters[index].to_x != monsters[index].body.x) {
                        monsters[index].body.velocity.x = 1;
                        monsters[index].body.velocity.y = 1;
                        game.physics.arcade.moveToXY(monsters[index], parseInt(monsters[index].to_x), parseInt(monsters[index].to_y), 100);

                    }

                }
            }
        }
        ////////////////////////stop players
        if (typeof add_players != 'undefined' && typeof players_list !='undefined') {
            for (var index = 0; index < add_players.length; index++) {
                if (typeof players_list[index] != 'undefined') {
                    if ((add_players[index].body.x >= players_list[index].posx - 20) || (add_players[index].body.x <= players_list[index].posx + 20)) {
                        add_players[index].body.velocity.x = 0;
                    }
                    if ((add_players[index].body.posy >=players_list[index].posy-20) ||(add_players[index].body.posy <=players_list[index].posy+20)){
                        add_players[index].body.velocity.y = 0;
                    }
                }
            }
        }
        ////////////////////////stop monsters
        if (typeof monsters != 'undefined') {
            for (var index = 0; index < monsters.length +1; index++) {
                if (typeof monsters[index] != 'undefined') {

                    //console.log(monsters[index].body.x + ':' + monsters_list[index].x )


                    if ((parseInt(monsters[index].body.x) == parseInt(monsters_list[index].x) )) {
                        monsters[index].body.velocity.x = 0;
                    }
                    if ((monsters[index].body.y >=monsters[index].y-20) ||(monsters[index].body.y < monsters[index].y + 20)){
                        monsters[index].body.velocity.y = 0;
                    }
                }
            }
        }
        ///////////////////////collide npc list
        for (var index = 0; index < npc_list.length; index++)
        {
            this.physics.arcade.collide(sprite, add_npc[index], npc);
        }
        ///////////////////////collide plate list
        for (var index = 0; index < plates_list.length; index++)
        {
            this.physics.arcade.collide(sprite, add_plates[index], plate);
        }
        ///////////////////////collide twines_list
        for (var index = 0; index < twines_list.length; index++)
        {
            this.physics.arcade.collide(sprite, add_twines[index], twine);
        }
        ///////////////////////collide terminals_list
        for (var index = 0; index < terminals_list.length; index++)
        {
            this.physics.arcade.collide(sprite, add_terminals[index], terminal);
        }
        /////////////////////collide players
        for (var index = 0; index < players_list.length; index++)
        {
            //console.log(key);
            this.physics.arcade.collide(sprite, add_players[index], player);
            //add_building[index].body.immovable = true;
        }
        ///////////////////////collide buildings/////////
        for (var index = 0; index < buildings.length; index++)
        {
            //console.log(key);
            this.physics.arcade.collide(sprite, add_building[index], enter_building);
        }
        ///////////////////// Stop Player
        if ((sprite.body.x >=x-10) &&(sprite.body.x <=x+10)){
            sprite.body.velocity.x = 0;
            //console.log('x:' +sprite.body.velocity.x);
        }
        if ((sprite.body.y >=y-10) &&(sprite.body.y <=y+10)){
            sprite.body.velocity.y = 0;
        }
        if ((sprite.body.velocity.x == 0)&&(sprite.body.velocity.y == 0)) {
            if (send == 1) {
                doSomething();
                send = 0;
            }
        }
/////////////////////////////////////////////
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
    },
    render: function() {
        game.debug.spriteCoords(sprite, 32, 32);
    }
};
