var game = new Phaser.Game(800, 500, Phaser.AUTO, "world", null, true, true, null);
var playState = new Array();
var upKey;
var downKey;
var leftKey;
var rightKey;
var x = 100;
var y = 100;
var fireButton;
var weapon;
var cursors;
var sprite;
var sprite2;
var circle_core;;
var anim= false;
var dest;
var bar;
var text;
var enableObstacleCollide;
var collideBuilding =[];
var collidePlate =[];
var collideTerminal=[];
var collidePortal=[];
var PI =3.14;
var directions = ["W", "NW", "N", "NE", "E", "SE", "S", "SW"], playerDirection;
var grid;
var number;
var tile_names = new Array();
var monsters = new Array();
var monsters_list = new Array();
var halflings = new Array();
var halfling_list = new Array();
var assets_name_x = new Array();
var assets_name_y = new Array();
var building = new Array();
var buildings = new Array();
var posx = new Array();
var posy = new Array();
var portal = new Array();
var add_building = new Array();
var add_assets = new Array();
var players = new Array();
var players_list = new Array();
var add_plates = new Array();
var add_pages = new Array();
var add_twines = new Array();
var boundsX1 = new Array();
var boundsY1 = new Array();
var boundsX2 = new Array();
var boundsY2 = new Array();
var new_x;
var new_y;
var portal_sourceX1 = new Array();
var portal_sourceY1 = new Array();
var portal_sourceX2 = [];
var portal_sourceY2 = [];
var portal_sourceX3 = [];
var portal_sourceY3 =[];
var portal_dest_1 = [];
var portal_dest_2 = [];
var portal_dest_3 = [];
var npc = [];
var npc_list = [];
var add_terminals = [];
var terminals_list = [];
var twines_list = [];
var plates_list = [];
var content =[];
var send = 1;
var map;
var layer;
var layer3;
var layer4;
var layer2;
var x;
var y;
var rhythmic;
var melody;
var bass;
var phaser;
var sprite;
var sprite2;
var circle_core;

var cursors;
var avatar;
var cacheKey;
var group;

collideBuilding[0]=false;
collideBuilding[1]=false;
collidePlate[0]=false;
collidePlate[1]=false;
collidePlate[2]=false;
collidePlate[3]=false;
collidePlate[4]=false;
collidePlate[5]=false;

collideTerminal[0]=false;
collideTerminal[1]=false;
collideTerminal[2]=false;
collideTerminal[3]=false;
collideTerminal[4]=false;
collideTerminal[5]=false;

collidePortal[1]=false;
collidePortal[2]=false;
collidePortal[3]=false;

//All parameters are optional but you usually want to set width and height
//Remember that the game object inherits many properties and methods!


function getGrid() {

var result=[1,1,1];

        if (result != null) {
            grid = parseInt(result[0]);
            new_x = parseFloat(result[1]);
            new_y = parseFloat(result[2]);
            avatar = result[3];
            get_everything(grid);
        } else {
            grid = 1;
            new_x = 100;
            new_y = 100;
            avatar = null;
            get_everything(grid);
        }

}

function get_everything1(dest) {

    jQuery.getJSON('index.php?option=com_battle&task=map_action&action=get_buildings&format=raw&grid=' + dest, function (result) {
        buildings = result;

        jQuery.getJSON('index.php?option=com_battle&task=map_action&action=get_chars&format=raw', function (result) {
            npc_list = result;

            jQuery.getJSON('index.php?option=com_battle&task=map_action&action=get_players&format=raw', function (result) {
                players_list = result;

                jQuery.getJSON('index.php?option=com_battle&task=map_action&action=get_twines&format=raw', function (result) {
                    twines_list = result;

                    jQuery.getJSON('index.php?option=com_battle&task=map_action&action=get_terminals&format=raw', function (result) {
                        terminals_list = result;

                        jQuery.getJSON('index.php?option=com_battle&task=map_action&action=get_plates&format=raw', function (result) {
                            plates_list = result;

                            jQuery.getJSON('index.php?option=com_battle&task=map_action&action=get_monsters&format=raw', function (result) {
                                monsters_list = result;

                                jQuery.getJSON('index.php?option=com_battle&task=map_action&action=get_halflings&format=raw', function (result) {
                                    halfling_list = result;

                                    grid = dest;
                                    game.state.start('login');

                                });
                            });
                        });
                    });
                });
            });
        });
    });
}

function get_everything(dest) {


    game.state.start('login');

}

function stop(){
    sprite.animations.play('walkStop', 1);
}

function load_monsters() {
    if (typeof monsters_list != 'undefined') {

        for (var index = 0; index < monsters_list.length; index++) {
            var filename = monsters_list[index].spritesheet;
            var key = monsters_list[index].name;
            var dirname = monsters_list[index].name;
            game.load.spritesheet(key, '/sites/default/files/images/assets/images/assets/chars/monsters/' + dirname + '/' + filename , parseInt(monsters_list[index].cellwidth), parseInt(monsters_list[index].cellheight), 16);
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
            game.load.spritesheet(filename, '/sites/default/files/images/assets/chars/halflings/'
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
            game.load.image("_" + key, '/sites/default/files/images/buildings/' + filename);
        }
    }
}

function load_twines(){
    if(twines_list.length != 0) {
        for (var index = 0; index < twines_list.length; index++) {
            var filename = twines_list[index].image;
            var key = twines_list[index].id;
            game.load.image( key, '/sites/default/files/images/twines/' + filename);
        }
    }
}

function load_plates() {
    if(plates_list.length != 0) {
        for (var index = 0; index < plates_list.length; index++) {
            var filename2 = plates_list[index].image;
            var key = plates_list[index].id;
            game.load.image( key, '//components/com_battle/images/plates/' + filename2);
        }
    }
}

function load_terminals() {
    if(terminals_list.length != 0) {
        for (var index = 0; index < terminals_list.length; index++) {
            var filename = terminals_list[index].image;
            var key = terminals_list[index].image;
            game.load.image( key, '/sites/default/files/images/buildings/' + filename);
        }
    }
}

function load_chars() {
    if(npc_list.length != 0) {
        for (var index = 0; index < npc_list.length; index++) {
            var filename = npc_list[index].avatar;
            var key = npc_list[index].name;
            game.load.image(key, '/sites/default/files/images/ennemis/miniatures/' + filename);
        }
    }
}

function load_player() {
    game.load.atlasJSONHash('highhero',
        '/sites/default/files/images/assets/chars/highhero/hero.png',
        '/sites/default/files/highhero.json');

    game.load.atlasJSONHash('highhero_diagonal',
        '/sites/default/files/images/assets/chars/highhero/hero_diagonal.png',
        '/sites/default/files/highhero_diagonal.json');

    game.load.image('ship', 'images/pixel.gif');

}

function load_portals() {
    game.load.spritesheet('portal00001', '/sites/default/files/images/assets/tiles/portals_1.png', 64, 64, 1);
    game.load.spritesheet('portal00002', '/sites/default/files/images/assets/tiles/portals_2.png', 64, 64, 1);
    game.load.spritesheet('portal00003', '/sites/default/files/images/assets/tiles/portals_3.png', 64, 64, 1);
}

function load_tiles() {
    //  console.log(grid);


    for (var index = 0; index < tile_names[grid].length; index++) {
        var filename = tile_names[grid][index];
        //console.log(filename);
        game.load.image(filename, '/sites/default/files/images/assets/tiles/' + filename + '.png');
    }
}

function place_buildings(){
    if(buildings.length != 0) {
        for (var index = 0; index < buildings.length; index++) {
            var key = buildings[index].id;
            add_building[index] = game.add.sprite(buildings[index].posx * 1, buildings[index].posy * 1, "_" + key);
            add_building[index].id = key;
            add_building[index].name = buildings[index].name;
            add_building[index].ownername = buildings[index].ownername;

            game.physics.enable(add_building[index], Phaser.Physics.ARCADE);
            add_building[index].body.velocity = 0;
            add_building[index].index=index;
            add_building[index].type = 'buildings';
            add_building[index].inputEnabled = true;
            add_building[index].events.onInputOver.add(makeTooltip, this);
        }
    }
}

function makeTooltip(tileClicked) {
    //  alert(buildings.length);
    return function () {
        if(!bar){

            bar = game.add.graphics();
            bar.beginFill(0x000000, 0.8);
            bar.drawRect(tileClicked.x, tileClicked.y, tileClicked.width, tileClicked.height);
            bar.inputEnabled = true;
            bar.dest = tileClicked.index;
            bar.grid = tileClicked.grid;
            bar.type = tileClicked.type;
            bar.events.onInputDown.add(collisionProperty, this);
            bar.events.onInputOut.add(killTooltip, this);
        }
        if(!text) {

            var style = {font: '14px Arial', fill: 'white', align: 'left', wordWrap: true};
            text = game.add.text(tileClicked.position.x, tileClicked.position.y, 'enter ', style);
            text.padding.set(0, 0);
            text.setShadow(3, 3, 'rgba(0,0,0,0.9)', 2);
            text.setTextBounds(20, 20, tileClicked.width - 20, tileClicked.height - 20);
            text.inputEnabled = true;
            text.grid = tileClicked.grid;
            text.dest = tileClicked.index;
            text.type = tileClicked.type;
            text.events.onInputDown.add(collisionProperty, this);
            text.events.onInputOut.add(killTooltip, this);
            text.events.onInputOut.add(whatever, this);

        }
    }();
}

function place_twines(){
    if(twines_list.length != 0) {
        for (var index = 0; index < twines_list.length; index++) {
            var key = twines_list[index].id;
            add_twines[index] = game.add.sprite(twines_list[index].posx * 1, twines_list[index].posy * 1, key);
            add_twines[index].id = key;
            add_twines[index].inputEnabled = true;
            add_twines[index].index = index;
            add_twines[index].type = 'twines';
            game.physics.enable(add_twines[index], Phaser.Physics.ARCADE);
            //   add_twines[index].events.onInputOver.add(makeTooltip, this);
        }
    }
}


function place_terminals() {
    if (terminals_list.length != 0) {
        terminals_list.forEach(function (terminalsObj, index) {
            var key = terminalsObj.image;
            add_terminals[index] = game.add.sprite(terminalsObj.posx * 1, terminalsObj.posy * 1, key);
            add_terminals[index].id = terminalsObj.id;
            //add_terminals[index].id = key;
            add_terminals[index].inputEnabled = true;
            add_terminals[index].index = index;
            add_terminals[index].type = 'terminals';


            game.physics.enable(add_terminals[index], Phaser.Physics.ARCADE);
            add_terminals[index].events.onInputOver.add(makeTooltip, this);
        });
    }
}



function place_plates(){
    if (plates_list.length != 0) {
        for (var index = 0; index < plates_list.length; index++) {
            var key = plates_list[index].id;
            add_plates[index] = game.add.sprite(plates_list[index].posx * 1, plates_list[index].posy * 1, key);
            add_plates[index].id = key;
            add_plates[index].inputEnabled = true;
            add_plates[index].index = index;
            add_plates[index].type = 'plates';
            game.physics.enable(add_plates[index], Phaser.Physics.ARCADE);
            add_plates[index].events.onInputOver.add(makeTooltip, this);
        }
    }
}

function place_portals(){
    for(var index= 1;index<=3; index++)
    {
        portal[index] = game.add.sprite(x3[grid], y3[grid], 'portal0000' + index);
        // game.physics.enable(portal[3], Phaser.Physics.ARCADE);
        //  portal[index]['dest'] = portal_dest_3[grid];
        portal[index].inputEnabled = true;
        portal[index].index = index;
        portal[index].type = 'portals';
        game.physics.enable(portal[index], Phaser.Physics.ARCADE);
        portal[index].events.onInputOver.add(makeTooltip, this);
    }
    //  portal[1] = game.add.sprite(x1[grid],y1[grid], 'portal00001');
    portal[1]['grid']=portal_dest_1[grid];
    //  game.physics.enable(portal[1], Phaser.Physics.ARCADE);
    //   portal[2] = game.add.sprite(x2[grid], y2[grid], 'portal00002');
    //   game.physics.enable(portal[2], Phaser.Physics.ARCADE);
    portal[2]['grid']=portal_dest_2[grid];
    //   portal[3] = game.add.sprite(x3[grid], y3[grid], 'portal00003');
    //   game.physics.enable(portal[3], Phaser.Physics.ARCADE);
    portal[3]['grid']=portal_dest_3[grid];
}

function place_player() {
    sprite = game.add.sprite(parseInt(new_x), parseInt(new_y), 'highhero');
    circle_core = game.add.sprite(parseInt(new_x), parseInt(new_y), 'ship');
    game.physics.enable(sprite, Phaser.Physics.ARCADE);
    sprite.body.allowRotation   = false;
    sprite.anchor.setTo(0.5, 0.5);
    sprite.scale.setTo(0.75, 0.75);
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
    this.sprite.animations.add('walkStop',  ['walkStop']);
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
    if ((sprite.body.x >x-50) &&(sprite.body.x < x-50)){
        sprite.body.velocity.x = 0;
        circle_core.body.velocity.x = 0;
    }
    if ((sprite.body.y >y-45) &&(sprite.body.y <y-45)){
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

    ///////////////////////collide portal list
    for (var index = 1; index < portal.length  ; index++)
    {
        // console.log(collidePortal[index]);
        if (collidePortal[index]==true) {
            game.physics.arcade.collide(sprite, portal[index], jump);
            //      add_plates[index].events.onInputOut.add(killTooltip, this);
            //    portal[index].events.onInputOut.add(killTooltip, this);
        }

    }

    ///////////////////////collide monster list
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
        // console.log(collidePlate[index]);
        if (collidePlate[index]==true) {
            game.physics.arcade.collide(sprite, add_plates[index], plate);
            //      add_plates[index].events.onInputOut.add(killTooltip, this);
        }

    }
    ///////////////////////collide twines_list
    for (var index = 0; index < twines_list.length; ++index)
    {
        //      add_twines[index].events.onInputDown.add(function(arg1) {  this.makeTooltip(arg1,twine(sprite, add_twines[index]));}, this);
        add_twines[index].events.onInputOut.add(killTooltip, this);
    }
    ///////////////////////collide terminals_list
    for (var index = 0; index < terminals_list.length; index++)
    {
        //      add_terminals[index].events.onInputDown.add(function(arg1) {  this.makeTooltip(arg1, terminal(sprite, add_terminals[index]));}, this);
        //  tadd_erminals[index].events.onInputOut.add(killTooltip, this);
        //  console.log(collideBuilding[index]);
        if (collideTerminal[index]==true) {
            game.physics.arcade.collide(sprite, add_terminals[index], terminal);
        }


    }
    /////////////////////collide players
    for (var index = 0; index < players_list.length; index++)
    {
        game.physics.arcade.collide(sprite, players[index], player);
        //add_players[index].body.immovable = true;
    }

    ///////////////////////collide buildings/////////
    for (var index = 0; index < buildings.length; index++)
    {
        //  console.log(collideBuilding[index]);
        if (collideBuilding[index]==true) {
            game.physics.arcade.collide(sprite, add_building[index], enter_building);
        }
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
        game.load.image(cacheKey(filename, 'tileset', filename), 'sites/default/files/images/assets/tiles/' + filename + '.png');
    }
    /////////////////// cache monsters
    if (typeof monsters_list != 'undefined') {
        for (var index = 0; index < monsters_list.length; index++) {
            var filename = monsters_list[index].spritesheet;
            game.load.spritesheet(cacheKey(filename, 'tileset', filename), 'sites/default/files/images/assets/chars/monsters/' + filename + '/'+ filename + '.png');
        }
    }
    /////////////////// cache halflings
    if (typeof halfling_list != 'undefined') {
        for (var index = 0; index < halfling_list.length; index++) {
            var filename = halfling_list[index].name;
            game.load.spritesheet(cacheKey(filename, 'tileset', filename), 'sites/default/files/images/assets/chars/halflings/'+ filename + '.png');
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
        game.load.image(cacheKey("_" + key, 'tileset', "_" + key), 'sites/default/files/images/buildings/' + filename );
    }
    //////////////////// cache twines_list
    for (var index = 0; index < twines_list.length; index++) {
        var filename = twines_list[index].image;
        var key = twines_list[index].id;
        game.load.image(cacheKey(key, 'tileset', "_" + key), 'sites/default/files/images/twines/' + filename );
    }
    //////////////////// cache plates_list
    for (var index = 0; index < plates_list.length; index++) {
        var filename = plates_list[index].image;
        var key = plates_list[index].id;
        game.load.image(cacheKey(key, 'tileset', "_" + key), 'sites/default/files/images/plates/' + filename );
    }
    //////////////////// cache terminals_list
    for (var index = 0; index < terminals_list.length; index++) {
        var filename = terminals_list[index].image;
        var key = terminals_list[index].image;
        game.load.image(cacheKey(key, 'tileset', "_" + key), 'sites/default/files/images/buildings/' + filename );
    }
    //////////////////// cache chars
    for (var index = 0; index < npc_list.length; index++) {
        var filename = npc_list[index].avatar;
        var key = npc_list[index].id;
        game.load.image(cacheKey(key, 'tileset', key), 'sites/default/files/images/ennemis/miniatures/' + filename );
    }
    //////////////////// cache Portals
    game.load.image(cacheKey('portal00001', 'tileset', 'portal00001'), 'sites/default/files/images/assets/tiles/Dungeon_A1.png');
    game.load.image(cacheKey('portal00002', 'tileset', 'portal00002'), 'sites/default/files/images/assets/tiles/Dungeon_B.png');
    game.load.image(cacheKey('portal00003', 'tileset', 'portal00003'), 'sites/default/files/images/assets/tiles/Dungeon_C.png');
}


    function collisionProperty(thingy) {

   //     console.log('type: ' + thingy.type);

        if (thingy.type == 'buildings') {


            collideBuilding[thingy.dest] = true;
        }
        if (thingy.type == 'terminals') {

            collideTerminal[thingy.dest] = true;
        }

        if (thingy.type == 'portals') {

            collidePortal[thingy.dest] = true;
        }

        else {
            collidePlate[thingy.dest] = true;
        }

        //return  game.physics.arcade.collide(sprite, thingy , enter_building);
        killTooltip(thingy);
    }

    function killTooltip(thingy) {
        text.destroy();
        bar.destroy();

        text = false;
        bar = false;

    }

    function whatever(arg) {
        killTooltip(arg);
        alert(arg.name);

    }


    function moveBall(pointer) {
        collideBuilding[0] = false;
        send = 1;
        x = parseInt(pointer.worldX);
        y = parseInt(pointer.worldY);
    }

    function jump(one, two) {

        one.body.immovable = true;
        one.body.enable = false;
        two.body.immovable = true;
        two.body.enable = false;

        anim = false;
        var source = grid;

        grid = two.dest;

        if (source == portal_dest_1[grid]) {
            new_x = portal_sourceX1[grid];
            new_y = portal_sourceY1[grid];
            x = portal_sourceX1[grid];
            y = portal_sourceY1[grid];
        }
        if (source == portal_dest_2[grid]) {
            new_x = portal_sourceX2[grid];
            new_y = portal_sourceY2[grid];
            x = portal_sourceX2[grid];
            y = portal_sourceY2[grid];
        }

        if (source == portal_dest_3[grid]) {
            new_x = portal_sourceX3[grid];
            new_y = portal_sourceY3[grid];
            x = portal_sourceX3[grid];
            y = portal_sourceY3[grid];
        }
        one.body.velocity.x = 0;
        one.body.velocity.y = 0;

        get_everything(two.grid);
    }






    function battle(one, two) {
        game.state.add('next', loadState);
        game.state.start('next');
    }

    function battle1(one, two) {
        grid = 7;
        game.state.add('next', playState[7]);
        game.state.start('next');
    }

    function battle2(one, two) {
        grid = 8;
        game.state.add('next', playState[8]);
        game.state.start('next');
    }

    function enter_building(one, two) {
        if (two.id == undefined) {
            two.id = 62;
        }
        alert('enter building');
        enableObstacleCollide = false;
        one.body.immovable = true;
        one.body.enable = false;
        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&view=building&id=" + two.id,
            context: document.body,
            obj: one.body.enable,
            dataType: "json"
        }).done(function (result) {

            document.getElementById("building").innerHTML = result;
            document.getElementById("building").show();
            document.getElementById("world").hide();
            document.getElementById("npc").hide();
            document.getElementById("player").hide();
            loadUp();
            var url = "/components/com_battle/includes/building.js";
            jQuery.getScript(url, function () {
                // alert ('hi');
                success2();
            });
        });
    }

    function shop(one, two) {
        one.destroy(true);
        one.body.enable = false;
        two.body.enable = false;
        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&view=building&id=1739",
            context: document.body,
            dataType: "json"
        }).done(function (result) {
            document.getElementById("mainbody").innerHTML = result;
            //   document.getElementById('loadarea_0').src= '/components/com_battle/includes/building.js';
            var url = "/components/com_battle/includes/building.js";
            jQuery.getScript(url, function () {

                success2();
            });
            //	mything.replaces(document.id('world'));
        });
    }

    function church() {
        window.location.assign("/index.php?option=com_wrapper&view=wrapper&Itemid=404")
    }

    function collideNpc(one, two) {
        two.body.enable = false;

        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&view=character&id=" + two.key_id,
            context: document.body,
            dataType: "json"
        }).done(function (result) {
            two.body.enable = true;
            document.getElementById("npc").innerHTML = result;
            document.getElementById("npc").show();
            document.getElementById("world").hide();
            document.getElementById("building").hide();
            document.getElementById("player").hide();
            loadUp();
            var url = "/components/com_battle/includes/character.js";
            jQuery.getScript(url, function () {

            });

        });
    }

    function collideMonster(one, two) {

        monsters[two.id].body.enable = false;
        //console.log('attacked!');
        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&task=monster_action&action=attack&id=" + two.id,
            context: document.body,
            dataType: "json"
        }).done(function (result) {
            console.log('attacked!');
            monsters[two.id].health = monsters[two.id].health - 10;
            if (monsters[two.id].health < 0) {
                monsters[two.id].alpha = 0;
            }
            else {
                monsters[two.id].body.enable = true;
            }
        });
        return monsters[two.id];
    }

///////////////////////////////////////////////////////////////////////////////////////
    function page(one, two) {
        // two.body.enable =false;
        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&view=twine&id=" + two.key,
            context: document.body,
            dataType: "json"
        }).done(function (result) {
            //   two.body.enable =true;
            document.getElementById("mainbody").innerHTML = result;
            //loadUp();//not yet

        });
    }

///////////////////////////////////////////////////////////////////////////////////////
    function plate(one, two) {

        return function () {

            //alert(two);

            one.body.immovable = true;
            one.body.enable = false;
            two.body.immovable = true;
            two.body.enable = false;

            jQuery.ajax({
                //  url: "/index.php?option=com_battle&format=json&task=plate_action$action=getplate&id="+ two.key,

                url: "/index.php?option=com_battle&format=json&view=plate&id=" + two.key,
                context: document.body,
                dataType: "json"
            }).done(function (result) {
                //   two.body.enable =true;
                document.getElementById("world").hide();
                document.getElementById("plates").innerHTML = result;
                document.getElementById("plates").show();
                //loadUp();//not yet

            });

        }();


    }

///////////////////////////////////////////////////////////////////////////////////////
    function twine(one, two) {

        one.body.immovable = true;
        one.body.enable = false;
        two.body.immovable = true;
        two.body.enable = false;
        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&view=twine&id=" + two.key,
            context: document.body,
            dataType: "json"
        }).done(function (result) {
            //   two.body.enable =true;
            document.getElementById("mainbody").innerHTML = result;
            //loadUp();//not yet

        });
    }

//////////////////////////////////////////////////////////////////////////////////////
    function terminal(one, two) {
        one.body.enable = false;
        one.body.immovable = true;
        two.body.static = true;

        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&view=terminal&id=" + two.id,
            context: document.body,
            dataType: "json"
        }).done(function (result) {
            //   two.body.enable = true;
            game.state.start('terminal');
            //  document.getElementById("world").hide();
            document.getElementById("terminal").innerHTML = result;
            document.getElementById("terminal").show();
            loadUp();
            var url = "/components/com_battle/includes/terminal.js";
            jQuery.getScript(url, function () {
            });
        });
    }

//////////////////////////////////////////////////////////////////////////////////////
    function player(one, two) {
        // two.body.enable = false;

        jQuery.ajax({
            url: "/index.php?option=com_battle&format=json&view=player&id=" + two.key_id,
            context: document.body,
            dataType: "json"
        }).done(function (result) {
            //   two.body.enable = true;
            document.getElementById("mainbody").innerHTML = result;
            loadUp();
            var url = "/components/com_battle/includes/player.js";
            jQuery.getScript(url, function () {
            });
        });
    }

/////////////////////////////////////////////////////////////////////////////////////

    function paddy(n, p, c) {
        var pad_char = typeof c !== 'undefined' ? c : '0';
        var pad = new Array(1 + p).join(pad_char);
        return (pad + n).slice(-pad.length);
    }

    function addMap() {

        map = game.add.tilemap('world');
        layer3 = map.createLayer('ground');
        layer = map.createLayer('obstacles');
        layer4 = map.createLayer('ground2');
        layer2 = map.createLayer('objects');
    }

    function loaded() {

    }

    function doSomething() {
        if (x != undefined) {
            jQuery.getJSON('index.php?option=com_battle&task=map_action&action=update_pos&format=raw&posx=' + sprite.body.x + '&posy=' + sprite.body.y, function (result) {

            });
        }
    }






    function updateLine() {
        //console.log(introDateTime);
        if (line.length < introDateTime[index].length) {
            line = introDateTime[index].substr(0, line.length + 1);
            // text.text = line;
            dateTime.setText(line);
        }
        else {
            //  Wait 2 seconds then start a new line
            game.time.events.add(Phaser.Timer.SECOND * 2, nextLine, this);
        }
    }

    function nextLine() {
        index++;
        if (index < introDateTime.length) {
            line = '';
            game.time.events.repeat(80, introDateTime[index].length + 1, updateLine, this);
        }
    }





    function nextLine2() {
        if (lineIndex === content.length) {
            //  We're finished
            return;
        }
        //  Split the current line on spaces, so one word per array element
        line2 = content[lineIndex].split(' ');
        //  Reset the word index to zero (the first word in the line)
        wordIndex = 0;
        //  Call the 'nextWord' function once for each word in the line (line.length)
        game.time.events.repeat(wordDelay, line2.length, nextWord, this);
        //  Advance to the next line
        lineIndex++;
    }

    function nextWord() {
        //  Add the next word onto the text string, followed by a space
        introText.text = introText.text.concat(line2[wordIndex] + " ");
        //  Advance the word index to the next word in the line
        wordIndex++;
        //  Last word?
        if (wordIndex === line2.length) {
            //  Add a carriage return
            introText.text = introText.text.concat("\n");
            //  Get the next line after the lineDelay amount of ms has elapsed
            game.time.events.add(lineDelay, nextLine2, this);
        }

    }

    function slowIntroText() {
        nextLine2();
    }

    function clearAlert() {
        window.clearTimeout(timeoutID);
    }
