

var game = new Phaser.Game(800, 500, Phaser.AUTO, "world");
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
var circle_core;
var anim= false;
var enableObstacleCollide;
game.state.add('login', playState[0]);
game.state.add('next', playState[3]);
game.state.add('terminal', playState[2]);

//All parameters are optional but you usually want to set width and height
//Remember that the game object inherits many properties and methods!

var conn = new ab.Session('ws://www.eclecticmeme.com:8080', function() {

    conn.subscribe('monstersCategory', function(topic, data) {
        data.article.forEach(function (articleObj)
        {
            var incomingId = articleObj.id;
            monsters_list.forEach(function (monsterObj, index)
            {
                if (monsterObj.id == incomingId) {
                        monsterObj.x = parseInt(articleObj.x);
                        monsterObj.y = parseInt(articleObj.y);
                    if  (monsters[incomingId]!==undefined) {

                        console.log('moved');
                        game.physics.arcade.moveToXY(monsters[incomingId], parseInt(monsterObj.x), parseInt(monsterObj.y), 100);
                    }
                }
            });
        });
    });

    conn.subscribe('monsterHealthCategory', function(topic, data) {

        console.log(data);


           //    monsters[parseInt(data.article.id)].health = parseInt(data.article.health);

     });

    conn.subscribe('halflingsCategory', function(topic, data) {
        data.article.forEach(function(articleObj) {

            var incomingId = articleObj.id;

            halfling_list.forEach(function (halflingObj, index) {

                if (halflingObj.id == incomingId) {

                    halflingObj.x = parseInt(articleObj.x);
                    halflingObj.y = parseInt(articleObj.y);
                    if  (halflings[incomingId]!==undefined) {
                        game.physics.arcade.moveToXY(halflings[incomingId], parseInt(halflingObj.x), parseInt(halflingObj.y), 100);
                    }
                }
            });
        });
    });
    conn.subscribe('playersCategory', function(topic, data) {
        for (var iterate = 0; iterate <= data.article.length - 1; iterate++) {
            var incomingId = data.article[iterate].id;
            players_list.forEach(function (playerObj, index) {
                if (playerObj.id == incomingId) {
                    playerObj.posx = parseInt(data.article[iterate].posx);
                    playerObj.posy = parseInt(data.article[iterate].posy);
                    players[incomingId].body.velocity.x = 1000;
                    players[incomingId].body.velocity.y = 1000;
                    game.physics.arcade.moveToXY(players[incomingId], parseInt(playerObj.posx), parseInt(playerObj.posy), 100);
                }
            });
        };
    });
},

function() {
   console.warn('WebSocket connection closed');
},
{'skipSubprotocolCheck': true}
);

jQuery('#world').focus().blur(function(){
    jQuery('#world').focus();
})

jQuery.getJSON('index.php?option=com_battle&task=map_action&action=get_grid&format=raw', function(result)
{
    if (result != null) {
        console.log('buildings');
        grid = parseInt(result[0]);
        new_x = parseFloat(result[1]);
        new_y = parseFloat(result[2]);
        avatar = result[3];
        get_everything(grid);
    }else{
        grid = 1;
        new_x =100;
        new_y = 100;
        avatar = null;
        get_everything(grid);
    }
});

function tooltip(thing) {

    bar = game.add.graphics();
    bar.beginFill(0x000000, 0.8);
    bar.drawRect(thing.x, thing.y, thing.width, thing.height);
   //console.log(thing.name, rectWidth, typeof bar);
    console.log(thing.position.x);

    var style = { font: '14px Arial', fill: 'white', align: 'left', wordWrap: true };
    //var style = { font: '14px Arial', fill: 'white', align: 'left', backgroundColor: 'black', boundsAlignH: "center", boundsAlignV: "middle" };

    //text = game.add.text(thing.position.x, thing.position.y, 'enter'+ ' ' + thing.ownername + ' ' + thing.name , style);
    text = game.add.text(thing.position.x, thing.position.y, 'enter'+ thing.name , style);


    text.padding.set(0, 0);
    text.setShadow(3, 3, 'rgba(0,0,0,0.9)', 2);

    text.setTextBounds(20,20,  thing.width-20, thing.height-20);

}

function killTooltip() {

    text.destroy();
    bar.destroy();

}


function moveBall(pointer)
{

    console.log(pointer.worldX);
    send = 1;
    x = parseInt(pointer.worldX);
    y = parseInt(pointer.worldY);
}

function jump(one,two) {
    anim = false;
    var source = grid;
    console.log('source:' + source);
    grid = two.dest;
    console.log('grid:' + grid);
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
    two.body.enable = false;
    //get_everything(two.dest);
}

function get_everything(dest) {

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

                                    game.state.start('next');

                                });
                            });
                        });
                    });
                });
            });
        });
    });
}

function battle(one,two) {
    game.state.add('next', loadState);
    game.state.start('next');
}

function battle1(one,two) {
    grid = 7;
    game.state.add('next', playState[7]);
    game.state.start('next');
}

function battle2(one,two) {
    grid = 8;
    game.state.add('next', playState[8]);
    game.state.start('next');
}

function enter_building(one,two) {
  //  alert(one.body.enable);
  //  alert('fck');
    enableObstacleCollide = false;
    one.body.immovable = true;
    one.body.enable =false;
    two.body.immovable = true;
    two.body.enable =false;
  //  alert(one.body.enable);






    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=building&id=" + two.id,
        context: document.body,
        obj: one.body.enable,
        dataType: "json"
    }).done(function(result){

   //     alert('n: ' + this.obj);

        document.getElementById("building").innerHTML=result;
        document.getElementById("building").show();
        document.getElementById("world").hide();
        document.getElementById("npc").hide();
        document.getElementById("player").hide();
        loadUp();
        //alert('y: ' + this.obj);
        var url = "/components/com_battle/includes/building.js";
        jQuery.getScript( url, function() {
            // alert ('hi');
             success2();
        });
    });
}

function shop(one,two) {
    one.destroy(true);
    one.body.enable =false;
    two.body.enable =false;
    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=building&id=1739",
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        document.getElementById("mainbody").innerHTML=result;
        //   document.getElementById('loadarea_0').src= '/components/com_battle/includes/building.js';
        var url = "/components/com_battle/includes/building.js";
        jQuery.getScript( url, function() {
            alert ('hi');
            success2();
        });
        //	mything.replaces(document.id('world'));
    });
}

function church() {
    window.location.assign("/index.php?option=com_wrapper&view=wrapper&Itemid=404")
}

function collideNpc(one,two) {
    two.body.enable =false;

    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=character&id="+ two.key_id,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        two.body.enable =true;
        document.getElementById("npc").innerHTML=result;
        document.getElementById("npc").show();
        document.getElementById("world").hide();
        document.getElementById("building").hide();
        document.getElementById("player").hide();
        loadUp();
        var url = "/components/com_battle/includes/character.js";
        jQuery.getScript( url, function() {

        });

    });
}

function collideMonster(one,two) {

    monsters[two.id].body.enable = false;
    //console.log('attacked!');
    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&task=monster_action&action=attack&id=" + two.id,
        context: document.body,
        dataType: "json"
    }).done(function (result) {
        console.log('attacked!');
        monsters[two.id].health = monsters[two.id].health-10;
        if  (monsters[two.id].health<0){
            monsters[two.id].alpha = 0;
           // monsters[two.id].destroy(true);
        }
        else {
            //console.log(two.health);
            monsters[two.id].body.enable = true;
        }
    });
    return monsters[two.id];
}

///////////////////////////////////////////////////////////////////////////////////////
function page(one,two) {
   // two.body.enable =false;
    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=twine&id="+ two.key,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
     //   two.body.enable =true;
        document.getElementById("mainbody").innerHTML=result;
        //loadUp();//not yet

    });
}
///////////////////////////////////////////////////////////////////////////////////////
function plate(one,two) {

     two.body.enable =false;

    jQuery.ajax({
      //  url: "/index.php?option=com_battle&format=json&task=plate_action$action=getplate&id="+ two.key,

        url: "/index.php?option=com_battle&format=json&view=plate&id="+ two.key,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        //   two.body.enable =true;
        document.getElementById("world").hide();
        document.getElementById("plates").innerHTML=result;
        document.getElementById("plates").show();
        //loadUp();//not yet

    });
}
///////////////////////////////////////////////////////////////////////////////////////
function twine(one,two) {
    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=twine&id="+ two.key,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        //   two.body.enable =true;
        document.getElementById("mainbody").innerHTML=result;
        //loadUp();//not yet

    });
}

//////////////////////////////////////////////////////////////////////////////////////
function terminal(one,two) {
    one.body.enable = false;
    one.body.immovable = true;
    two.body.static = true;

    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=terminal&id="+ two.id,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        //   two.body.enable = true;
       // game.state.start('terminal');
       // document.getElementById("world").hide();
       // document.getElementById("terminal").innerHTML=result;
      //  document.getElementById("terminal").show();
        loadUp();
        var url = "/components/com_battle/includes/terminal.js";
        jQuery.getScript( url, function() {
        });
    });
}
//////////////////////////////////////////////////////////////////////////////////////
function player(one,two) {
    two.body.enable = false;

    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=player&id="+ two.key_id,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
     //   two.body.enable = true;
        document.getElementById("mainbody").innerHTML=result;
        loadUp();
        var url = "/components/com_battle/includes/player.js";
        jQuery.getScript( url, function() {
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
    if (x != undefined)
    {
        jQuery.getJSON('index.php?option=com_battle&task=map_action&action=update_pos&format=raw&posx=' + sprite.body.x + '&posy=' + sprite.body.y, function (result)
        {

        });
    }
}

function updateLine() {
    if (line.length < content[index].length)
    {
        line = content[index].substr(0, line.length + 1);
        // text.text = line;
        text2.setText(line);
    }
    else
    {
        //  Wait 2 seconds then start a new line
        game.time.events.add(Phaser.Timer.SECOND * 2, nextLine, this);
    }
}

function nextLine() {
    index++;
    if (index < content.length)
    {
        line = '';
        game.time.events.repeat(80, content[index].length + 1, updateLine, this);
    }
}
