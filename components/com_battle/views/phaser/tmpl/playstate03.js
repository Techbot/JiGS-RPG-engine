playState[3] = {
    init: function() {
    },
    preload: function() {
        game.load.image('bullet', '/images/shmup-bullet.png',4,4);
        game.load.script('HudManager', '/components/com_battle/includes/HUDManager.js');
        var number = paddy(grid,3);
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
        game.load.tilemap('world', 'components/com_battle/views/phaser/tmpl/json/grid' + number + '.json', null, Phaser.Tilemap.TILED_JSON);
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

        game.input.onDown.add(moveBall, this);

        //  In this example we'll create 4 specific keys (up, down, left, right) and monitor them in our update function

        upKey = game.input.keyboard.addKey(Phaser.Keyboard.UP);
        downKey = game.input.keyboard.addKey(Phaser.Keyboard.DOWN);
        leftKey = game.input.keyboard.addKey(Phaser.Keyboard.LEFT);
        rightKey = game.input.keyboard.addKey(Phaser.Keyboard.RIGHT);
        fireButton = game.input.keyboard.addKey(Phaser.Keyboard.SPACEBAR);
        ///////////////////////////////////////////
        addMap();
        ///////////////////////////////////////////
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
    update: function() {
        if (game.input.activePointer.isDown)
        {


            weapon.fire();
        }

        floor_halflings();
        //////////////////////////////collide obstacle layer
        game.physics.arcade.collide(sprite, layer);
        ////////////////////////////////////////////////
        this.physics.arcade.collide(sprite, portal[1],jump);
        this.physics.arcade.collide(sprite, portal[2],jump);
        this.physics.arcade.collide(sprite, portal[3],jump);

        ////////////////////////move player
        game.physics.arcade.moveToXY(sprite, x, y, 100);


        if (parseInt(sprite.x) > parseInt(x)){


            sprite.animations.play('walkLeft', 6);

        }else{

            sprite.animations.play('walkStop', 6);


        }

        if (parseInt(sprite.x) < parseInt(x)){


            sprite.animations.play('walkRight', 6);

        }else{

            sprite.animations.play('walkStop', 6);


        }





        move_players();
        stop_players();
        stop_player();
        move_monsters();
        stop_monsters();
        stop_halflings();
        move_halflings();


        /*
        if (upKey.isDown)
        {
            y--;
            sprite.animations.play('walkUp', 6);
            sprite.y =y;
            circle_core.y =y;
            circle_core.angle = -90;
        }
        else if (downKey.isDown)
        {
            y++;
            sprite.animations.play('walkDown');
            sprite.y =y;
            circle_core.y =y;
            circle_core.angle = 90;
        }
        if (upKey.isDown &&  fireButton.isDown)
        {
            console.log('fire_up');
            sprite.animations.play('hoeUp');
            // y--;
            // sprite.animations.play('walk_up', 6);
            //  sprite.y =y;
            //   circle_core.y =y;
            //   circle_core.angle = -90;
        }
        else if (downKey.isDown && game.input.activePointer.isDown)
        {
            console.log('fire_down');
            //y++;
            //sprite.y =y;
            // circle_core.y =y;
            // circle_core.angle = 90;
            sprite.animations.play('hoeDown', 30);
        }

        if (cursors.left.isDown  )
        {
            x--;
            sprite.animations.play('walkLeft', 6);
            sprite.x =x;
            circle_core.x=x;
            circle_core.angle = 180;
        }
        else if (rightKey.isDown)
        {
            x++;
            sprite.animations.play('walkRight', 6);
            sprite.x =x;
            circle_core.x =x;
            circle_core.angle = 0;
        }
        if (fireButton.isDown)
        {
            console.log('fire');
            weapon.fire();
        }

        */

        /*
        sprite.body.velocity.x = sprite.body.velocity.y = 0;
        var SPEED = 150;

        // if in hoe animation wait
        if (sprite.animations.currentAnim.name.lastIndexOf('hoe', 0) === 0 && sprite.animations.currentAnim.isPlaying) {
            // wait for animation to finish
        } else {
            // use hoe on CTRL
            sprite.direction = 'Down';

            if (this.game.input.keyboard.isDown(Phaser.Keyboard.CONTROL)) {
                sprite.animations.play('hoe' + sprite.direction);
            } else if (cursors.left.isDown) {
                sprite.direction = 'Left';
            //    sprite.body.velocity.x = -SPEED;
                sprite.animations.play('walkLeft');
            } else if (cursors.right.isDown) {
                sprite.direction = 'Right';
         //       sprite.body.velocity.x = SPEED;
                sprite.animations.play('walkRight');
            } else if (cursors.up.isDown) {
                sprite.direction = 'Up';
           //     sprite.body.velocity.y = -SPEED;
                sprite.animations.play('walkUp');
            } else if (cursors.down.isDown) {
                sprite.direction = 'Down';
          //      sprite.body.velocity.y = SPEED;
                sprite.animations.play('walkDown');
            } else {
                sprite.animations.stop();
                sprite.frameName = 'walk' + sprite.direction + '2';
            }
        }
*/
        check_for_collisions();
    },
    render: function() {
        //   game.debug.spriteCoords(sprite, 32, 32);
        // Sprite debug info
        // game.debug.spriteInfo(sprite, 32, 32);
      //  weapon.debug();
    }
};

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function load_monsters() {
    if (typeof monsters_list != 'undefined') {

        for (var index = 0; index < monsters_list.length; index++) {
            var filename = monsters_list[index].spritesheet;
            var key = monsters_list[index].name;
            var dirname = monsters_list[index].name;
            game.load.spritesheet(key, '/components/com_battle/images/assets/chars/monsters/' + dirname + '/' + filename , parseInt(monsters_list[index].cellwidth), parseInt(monsters_list[index].cellheight), 16);
        }
    }
}
function floor_halflings() {
    halflings.forEach(function (halflingsObj, index) {
        halflingsObj.body.x = parseInt(halflingsObj.body.x);
        halflingsObj.body.y = parseInt(halflingsObj.body.y);
    })
}

function load_halflings() {
    if (typeof halfling_list != 'undefined') {
        for (var index = 0; index < halfling_list.length; index++) {
            var filename = halfling_list[index].typename;
            game.load.spritesheet(filename, '/components/com_battle/images/assets/chars/halflings/'
                + filename
                + '.png', parseInt(halfling_list[index].cellwidth), parseInt(halfling_list[index].cellheight), 16);
        }
    }
}

function load_players() {
    if (players_list.length != 0) {
        for (var index = 0; index < players_list.length; index++) {
            var filename = players_list[index].avatar;
            if (filename == null) {
                filename = 'gallery/skater.gif';
            }
            var key = players_list[index].id;
            if (filename.substring(0, 7) != 'gallery') {
                game.load.image(key, '/images/comprofiler/tn' + filename);
            } else {
                game.load.image(key, '/images/comprofiler/' + filename);
            }
        }
    }
}

function load_buildings() {
    if (buildings.length != 0) {
        for (var index = 0; index < buildings.length; index++) {
            var filename = buildings[index].image;
            var key = buildings[index].id;
            game.load.image("_" + key, '/components/com_battle/images/buildings/' + filename);
        }
    }
}

function load_twines(){
    if(twines_list.length != 0) {
        for (var index = 0; index < twines_list.length; index++) {
            var filename = twines_list[index].image;
            var key = twines_list[index].id;
            game.load.image( key, '/components/com_battle/images/twines/' + filename);
        }
    }
}

function load_plates() {
    if(plates_list.length != 0) {
        for (var index = 0; index < plates_list.length; index++) {
            var filename2 = plates_list[index].image;
            var key = plates_list[index].id;
            game.load.image( key, '/components/com_battle/images/plates/' + filename2);
        }
    }
}

function load_terminals() {
    if(terminals_list.length != 0) {
        for (var index = 0; index < terminals_list.length; index++) {
            var filename = terminals_list[index].image;
            var key = terminals_list[index].image;
            game.load.image( key, '/components/com_battle/images/buildings/' + filename);
        }
    }
}

function load_chars() {
    if(npc_list.length != 0) {
        for (var index = 0; index < npc_list.length; index++) {
            var filename = npc_list[index].avatar;
            var key = npc_list[index].name;
            game.load.image(key, '/components/com_battle/images/ennemis/miniatures/' + filename);
        }
    }
}

function load_player_old() {
    if (avatar ==null) {
        game.load.image('hero', '/images/comprofiler/gallery/frog.gif');
    }
    else {
        if (avatar.substring(0, 7) != 'gallery') {
            game.load.image('hero', '/images/comprofiler/tn' + avatar);
        } else {
            game.load.image('hero', '/images/comprofiler/' + avatar);
        }
    }
}


function load_player() {
    //game.load.spritesheet('hero', '/components/com_battle/images/assets/chars/hero/hero.png', 32, 45);
  //  game.load.atlas('player', 'assets/atlases/hero.png', 'assets/atlases/hero.json');
   // game.load.atlasJSONHash('hero', '/components/com_battle/images/assets/chars/hero/hero.png', '/components/com_battle/images/assets/chars/hero/hero.json');
    game.load.atlasJSONHash('highhero',
        '/components/com_battle/images/assets/chars/highhero/hero.png',
        '/components/com_battle/views/phaser/tmpl/highhero.json');

    // game.load.spritesheet('axe_1', '/components/com_battle/images/assets/chars/hero/hero_axe_1.png', 64, 60);
  //  game.load.spritesheet('axe_2', '/components/com_battle/images/assets/chars/hero/hero_axe_2.png', 64, 60);
    //game.load.spritesheet('ship', 'assets/sprites/thrust_ship.png', 32, 45, 72);
    game.load.image('ship', 'images/pixel.gif');

}

function load_portals() {
    game.load.spritesheet('portal00001', '/components/com_battle/images/assets/tiles/portals_1.png', 64, 64, 1);
    game.load.spritesheet('portal00002', '/components/com_battle/images/assets/tiles/portals_2.png', 64, 64, 1);
    game.load.spritesheet('portal00003', '/components/com_battle/images/assets/tiles/portals_3.png', 64, 64, 1);
}

function load_tiles() {
    for (var index = 0; index < tile_names[grid].length; index++) {
        var filename = tile_names[grid][index];
        //console.log(filename);
        game.load.image(filename, '/components/com_battle/images/assets/tiles/' + filename + '.png');
    }
}

function place_buildings(){
    if(buildings.length != 0) {
        for (var index = 0; index < buildings.length; index++) {
            var key = buildings[index].id;
            add_building[index] = game.add.sprite(buildings[index].posx * 1, buildings[index].posy * 1, "_" + key);
            add_building[index].id = key;
            game.physics.enable(add_building[index], Phaser.Physics.ARCADE);
            add_building[index].body.velocity = 0;
        }
    }
}

function place_twines(){
    if(twines_list.length != 0) {
        for (var index = 0; index < twines_list.length; index++) {
            var key = twines_list[index].id;
            add_twines[index] = game.add.sprite(twines_list[index].posx * 1, twines_list[index].posy * 1, key);
            add_twines[index].id = key;
            game.physics.enable(add_twines[index], Phaser.Physics.ARCADE);
        }
    }
}

function place_plates(){
    if (plates_list.length != 0) {
        for (var index = 0; index < plates_list.length; index++) {
            var key = plates_list[index].id;
            add_plates[index] = game.add.sprite(plates_list[index].posx * 1, plates_list[index].posy * 1, key);
            add_plates[index].id = key;
            game.physics.enable(add_plates[index], Phaser.Physics.ARCADE);

        }
    }
}

function place_portals(){
    portal[1] = game.add.sprite(x1[grid],y1[grid], 'portal00001');
    portal[1]['dest']=portal_dest_1[grid];
    game.physics.enable(portal[1], Phaser.Physics.ARCADE);
    portal[2] = game.add.sprite(x2[grid], y2[grid], 'portal00002');
    game.physics.enable(portal[2], Phaser.Physics.ARCADE);
    portal[2]['dest']=portal_dest_2[grid];
    portal[3] = game.add.sprite(x3[grid], y3[grid], 'portal00003');
    game.physics.enable(portal[3], Phaser.Physics.ARCADE);
    portal[3]['dest']=portal_dest_3[grid];
}

function place_terminals() {
    if (terminals_list.length != 0) {
        terminals_list.forEach(function (terminalsObj, index) {
            var key = terminalsObj.image;
            terminals[index] = game.add.sprite(terminalsObj.posx * 1, terminalsObj.posy * 1, key);
            terminals[index].id = terminalsObj.id;
            game.physics.enable(terminals[index], Phaser.Physics.ARCADE);
        });
    }
}

function place_player_old() {
    sprite = game.add.sprite(parseInt(new_x), parseInt(new_y), 'hero');
    game.physics.enable(sprite, Phaser.Physics.ARCADE);
    sprite.body.enable = true;
    sprite.body.allowRotation = false;
    game.camera.follow(sprite, Phaser.Camera.FOLLOW_TOPDOWN_TIGHT);
}


function place_player() {
    sprite                      = game.add.sprite(parseInt(new_x), parseInt(new_y), 'highhero');
    //  sprite2                     = game.add.sprite(parseInt(new_x), parseInt(new_y), 'ship');
    circle_core = game.add.sprite(parseInt(new_x), parseInt(new_y), 'ship');
    game.physics.enable(sprite, Phaser.Physics.ARCADE);
    sprite.body.enable          = true;
    sprite.body.allowRotation   = false;

    game.physics.enable(circle_core, Phaser.Physics.ARCADE);
    circle_core.body.enable          = true;
    circle_core.body.allowRotation   = true;
    circle_core.body.offset.setTo(40, -40);

    game.camera.follow(sprite, Phaser.Camera.FOLLOW_TOPDOWN_TIGHT);



    // animations

    this.sprite.animations.add('walkUp', Phaser.Animation.generateFrameNames('walkUp', 1, 8), 5, true);
    this.sprite.animations.add('walkLeft', Phaser.Animation.generateFrameNames('walkLeft', 1, 8), 5, true);
    this.sprite.animations.add('walkRight', Phaser.Animation.generateFrameNames('walkRight', 1, 8), 5, true);
    this.sprite.animations.add('walkDown', Phaser.Animation.generateFrameNames('walkDown', 1, 8), 5, true);

    /*
    sprite.animations.add('walkDown', ['walkDown1', 'walkDown2', 'walkDown3'], 5, true);
    sprite.animations.add('walkLeft', ['walkLeft1', 'walkLeft2', 'walkLeft3'], 5, true);
    sprite.animations.add('walkRight', ['walkRight1', 'walkRight2', 'walkRight3'], 5, true);
    sprite.animations.add('walkUp', ['walkUp1', 'walkUp2', 'walkUp3'], 5, true);

    */

    //sprite.animations.add('hoeDown', ['hoeDown1', 'hoeDown2', 'hoeDown3', 'hoeDown4'], 4, false);
    //sprite.animations.add('hoeLeft', ['hoeLeft1', 'hoeLeft2', 'hoeLeft3', 'hoeLeft4'], 4, false);
    //sprite.animations.add('hoeRight', ['hoeRight1', 'hoeRight2', 'hoeRight3', 'hoeRight4'], 4, false);
    //sprite.animations.add('hoeUp', ['hoeUp1', 'hoeUp2', 'hoeUp3', 'hoeUp4'], 4, false);


    //sprite.animations.add('walk_stop',[1]);
    //sprite.animations.add('walk_down',[0,1,2]);
    //sprite.animations.add('walk_left',[12,13,14]);
    //sprite.animations.add('walk_right',[24,25,26]);
    //sprite.animations.add('walk_up',[36,37,38]);

    //sprite.animations.play('walk_stop',1,true);
}

function place_players(){
    players_group  = game.add.group();
    if (typeof players_list != 'undefined') {
        players_list.forEach(function (playersObj, index) {
            var key_id = players_list[index].id;
            var key = players_list[index].id
            players[key] = game.add.sprite(parseInt(playersObj.posx), parseInt(playersObj.posy), key);
            players[key].key_id = key_id;
            game.physics.enable(players[key], Phaser.Physics.ARCADE);
        })
    }
}

function place_chars() {
    if (npc_list.length != 0) {
        npc_list.forEach(function (npcObj, index) {
            var key = npcObj.name;
            var key_id = npcObj.id;
            npc[index] = game.add.sprite(parseInt(npcObj.posx), parseInt(npcObj.posy), key);
            npc[index].id = key;
            npc[index].key_id = key_id;
            game.physics.enable(npc[index], Phaser.Physics.ARCADE);
            npc[index].body.velocity = 0;
        })
    }
}

function place_monsters() {
    if (typeof monsters_list != 'undefined') {

        for (var loop = 0; loop < monsters_list.length - 1; loop++) {
            var key = monsters_list[loop].name;
            var index = monsters_list[loop].id;
            monsters[index]                     = game.add.sprite( monsters_list[loop].x,  monsters_list[loop].y, key);
            game.add.tween(monsters[index]).to({
                x: monsters_list[loop].x,
                y: monsters_list[loop].y
            }, 1, Phaser.Easing.Linear.None, true);
            monsters[index].animations.add('stop', [0]);
            monsters[index].animations.add('walk_down', [0, 1, 2, 3]);
            monsters[index].animations.add('walk_left', [4, 5, 6, 7]);
            monsters[index].animations.add('walk_right', [8, 9, 10, 11]);
            monsters[index].animations.add('walk_up', [12, 13, 14, 15]);
            monsters[index].animations.play('walk_stop', [1]);
            monsters[index].id                  = monsters_list[loop].id;
            monsters[index].maxHealth           = monsters_list[loop].maxHealth;
            monsters[index].health              = monsters_list[loop].health;
            monsters[index].anchor.setTo(0.5, 0.5);
            game.physics.enable(monsters[index], Phaser.Physics.ARCADE);
            monsters[index].hud                 = Phaser.Plugin.HUDManager.create(monsters[index].game, monsters[index], 'enemyhud');
            monsters[index].healthHUD           = monsters[index].hud.addBar(0, -20, 32, 2, monsters[index].maxHealth, 'health', monsters[index], Phaser.Plugin.HUDManager.HEALTHBAR, false);
            monsters[index].healthHUD.bar.anchor.setTo(0.5, 0.5);
            monsters[index].addChild(monsters[index].healthHUD.bar);
            monsters[index].body.immovable      = true;
        }
    }

}
function place_halflings(){
    if (typeof halfling_list != 'undefined') {
        for (var loop = 0; loop < halfling_list.length-1; loop++)
        {
            var key = halfling_list[loop].typename;
            var index = halfling_list[loop].id;

            halflings[index] = game.add.sprite(halfling_list[loop].x, halfling_list[loop].y, key);
            game.add.tween(halflings[index]).to({ x:parseInt(halfling_list[loop].x),y:parseInt(halfling_list[loop].y) }, 1, Phaser.Easing.Linear.None, true);
            halflings[index].animations.add('walk_stop',[0]);
            halflings[index].animations.add('walk_down',[0,1,2,3]);
            halflings[index].animations.add('walk_left',[4,5,6,7]);
            halflings[index].animations.add('walk_right',[8,9,10,11]);
            halflings[index].animations.add('walk_up',[12,13,14,15]);
            halflings[index].animations.play('walk_stop',1);
            halflings[index].id = halfling_list[loop].id;
            game.physics.enable(halflings[index], Phaser.Physics.ARCADE);
            halflings[index].body.enable =true;

        }
        group.setAll('anchor.x', 0.5);
        group.setAll('anchor.y', 0.5);
    }
}

function move_monsters(){

    monsters_list.forEach(function (monsterObj) {
        monsters.forEach(function (monster) {
            if (monsterObj.id == monster.id) {

                if (monsterObj.to_x < monster.body.x) {
                    monster.animations.play('walk_left', 3);
                    game.physics.arcade.moveToXY(monster, monsterObj.to_x,monsterObj.to_y, 100);
                }
                else if (monsterObj.to_x > monster.body.x) {
                    monster.animations.play('walk_right',3 );
                    game.physics.arcade.moveToXY(monster, monsterObj.to_x, monsterObj.to_y, 100);
                }
                else  if (monsterObj.to_y < monster.body.y) {
                    monster.animations.play('walk_up', 3);
                    game.physics.arcade.moveToXY(monster, monsterObj.to_x, monsterObj.to_y, 100);
                }
                else  if (monsterObj.to_y > monster.body.y) {
                    monster.animations.play('walk_down', 3);
                    game.physics.arcade.moveToXY(monster, monsterObj.to_x, monsterObj.to_y, 100);
                } else {
                    monster.body.velocity.x = 0;
                    monster.body.velocity.y = 0;
                    monster.animations.play('walk_stop', 1);
                }

            }
        })
    })
}

function move_halflings(){
    halfling_list.forEach(function (halflingObj) {
        halflings.forEach(function (halfling) {
            if (halflingObj.id == halfling.id) {

                if (halflingObj.x < halfling.body.x-20) {
                    halfling.animations.play('walk_left', 3);
                    game.physics.arcade.moveToXY(halfling, parseInt(halflingObj.x), parseInt(halflingObj.y), 100);
                }
                else if ((halflingObj.x) > (halfling.body.x+20)) {
                    halfling.animations.play('walk_right', 3);
                    game.physics.arcade.moveToXY(halfling, parseInt(halflingObj.x), parseInt(halflingObj.y), 100);
                }
                else if ((halflingObj.y) < (halfling.body.y-20)) {
                    halfling.animations.play('walk_up', 3);
                    game.physics.arcade.moveToXY(halfling, parseInt(halflingObj.x), parseInt(halflingObj.y), 100);
                }
                else if ((halflingObj.y) > (halfling.body.y+20)) {
                    halfling.animations.play('walk_down', 3);
                    game.physics.arcade.moveToXY(halfling, parseInt(halflingObj.x), parseInt(halflingObj.y), 100);
                } else {
                    halfling.body.velocity.x = 0;
                    halfling.body.velocity.y = 0;
                    halfling.animations.play('walk_stop', 1);
                }
            }
        })
    });
}

function stop_player(){
    if ((sprite.body.x >=x-10) &&(sprite.body.x <=x+10)){
        sprite.body.velocity.x = 0;
        circle_core.body.velocity.x = 0;
    }
    if ((sprite.body.y >=y-10) &&(sprite.body.y <=y+10)){
        sprite.body.velocity.y = 0;
        circle_core.body.velocity.y = 0;
    }
    if ((sprite.body.velocity.x == 0)&&(sprite.body.velocity.y == 0)) {
        if (send == 1) {
            doSomething();
            send = 0;
        }
    }
}

function stop_players() {
    if (typeof players != 'undefined' && typeof players_list != 'undefined') {
        players_list.forEach(function (playerObj, index) {
            var incoming_id = playerObj.id;
            if (typeof (players[incoming_id]) != 'undefined') {
                $x1     = parseInt(players[incoming_id].body.x);
                $y1     = parseInt(players[incoming_id].body.y);
                $x2     = parseInt(playerObj.posx);
                $y2     = parseInt(playerObj.posy);
                $part1  = ($x2 - $x1) * ($x2 - $x1);
                $part2  = ($y2 - $y1) * ($y2 - $y1);
                $distance = Math.sqrt(($part1) + ($part2));
                if ($distance < 3) {
                    players[incoming_id].body.velocity.x    = 0;
                    players[incoming_id].body.velocity.y    = 0;
                    players[incoming_id].body.immobile      = true;
                }
                else{
                    players[incoming_id].body.enabled = true;
                }
            }
        })
    }
}

function move_players(){
    if (typeof players != 'undefined' && players_list !='undefined') {
        players_list.forEach(function (playerObj, index) {
            var incoming_id =playerObj.id;

            if( typeof players[incoming_id] !='undefined') {

                game.physics.arcade.moveToXY(players[incoming_id], playerObj.posx, playerObj.posy, 100);
            }
        });
    }
}

function stop_monsters(){
    if (typeof monsters != 'undefined') {
        monsters.forEach(function(monsterObj,loop){
            //console.log(halfling_list);
            monsters_list.forEach(function(listObj){
                if (listObj.id == monsters.id){
                    if (parseInt(monsterObj.body.x) == listObj.x  ){
                        monstersObj.animations.play('walk_stop',1);
                    }
                    if (parseInt(monsterObj.body.y) ==listObj.y ){
                        monsterObj.animations.play('walk_stop',1);
                    }
                }
            })
        });
    }
}

function stop_halflings(){
    if (typeof halflings != 'undefined') {
        halflings.forEach(function(halflingObj,loop){
            //console.log(halfling_list);
            halfling_list.forEach(function(listObj){
                if (listObj.id == halflings.id){
                    if (parseInt(halflingObj.body.x) == listObj.x  ){
                        halflingsObj.animations.play('walk_stop',1);
                    }
                    if (parseInt(halflingObj.body.y) ==listObj.y ){
                        halflingObj.animations.play('walk_stop',1);
                    }
                }
            })
        });
    }
}

function check_for_collisions(){

    ///////////////////////collide monster list
//    for (var index = 0; index < monsters_list.length; index++)
//    {
//        game.physics.arcade.collide(sprite, monsters_list[index], collideMonster);
//    }

    monsters.forEach(function (monster, index) {
        game.physics.arcade.collide(sprite, monsters[index], collideMonster);
    });
    ///////////////////////collide npc list
    for (var index = 0; index < npc_list.length; index++)
    {
        game.physics.arcade.collide(sprite, npc[index], collideNpc);
    }
    ///////////////////////collide plate list
    for (var index = 0; index < plates_list.length; index++)
    {
        game.physics.arcade.collide(sprite, add_plates[index], plate);
    }
    ///////////////////////collide twines_list
    for (var index = 0; index < twines_list.length; index++)
    {
        game.physics.arcade.collide(sprite, add_twines[index], twine);
    }
    ///////////////////////collide terminals_list
    for (var index = 0; index < terminals_list.length; index++)
    {
        game.physics.arcade.collide(sprite, terminals[index], terminal);
    }
    /////////////////////collide players
    for (var index = 0; index < players_list.length; index++)
    {
        //console.log(key);
        game.physics.arcade.collide(sprite, players[index], player);
        //add_building[index].body.immovable = true;
    }

    ///////////////////////collide buildings/////////
    for (var index = 0; index < buildings.length; index++)
    {
        //console.log(key);
        game.physics.arcade.collide(sprite, add_building[index], enter_building);
    }

    ////////////////////////////
}

function cache(){
    cacheKey = Phaser.Plugin.Tiled.utils.cacheKey;
    /////////////////// cache json file
    game.load.tiledmap(cacheKey('world', 'tiledmap'), 'grid' + grid + '.json', null, Phaser.Tilemap.TILED_JSON);
    /////////////////// cache tiles
    for (var index = 0; index < tile_names[grid].length; index++) {
        var filename = tile_names[grid][index];
        game.load.image(cacheKey(filename, 'tileset', filename), '/components/com_battle/images/assets/tiles/' + filename + '.png');
    }
    /////////////////// cache monsters
    if (typeof monsters_list != 'undefined') {

        for (var index = 0; index < monsters_list.length; index++) {
            var filename = monsters_list[index].spritesheet;
            //console.log('filename:' + filename);
            game.load.spritesheet(cacheKey(filename, 'tileset', filename), '/components/com_battle/images/assets/chars/monsters/' + filename + '/'+ filename + '.png');
        }
    }
    /////////////////// cache halflings
    if (typeof halfling_list != 'undefined') {

        for (var index = 0; index < halfling_list.length; index++) {
            var filename = halfling_list[index].name;
            //console.log('filename:' + filename);
            game.load.spritesheet(cacheKey(filename, 'tileset', filename), '/components/com_battle/images/assets/chars/halflings/'+ filename + '.png');
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
        }else {
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
}
