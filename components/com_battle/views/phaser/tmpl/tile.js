var game = new Phaser.Game(800, 500, Phaser.AUTO, "world");

game.state.add('login', playState[0]);
game.state.add('next', playState[1]);
game.state.add('terminal', playState[2]);
//All parameters are optional but you usually want to set width and height
//Remember that the game object inherits many properties and methods!

var conn = new ab.Session('ws://www.eclecticmeme.com:8080', function() {

    conn.subscribe('monstersCategory', function(topic, data) {
            data.article.forEach(function (articleObj) {
                var incomingId = articleObj.id;
                monsters_list.forEach(function (monsterObj, index) {
                    if (monsterObj.id == incomingId) {
                        monsterObj.x = parseInt(data.article[index].x);
                        monsterObj.y = parseInt(data.article[index].y);
                        //monsters[incomingId].body.velocity.x = 1000;
                        //monsters[incomingId].body.velocity.y = 1000;
                        game.physics.arcade.moveToXY(monsters[incomingId], parseInt(monsterObj.x), parseInt(monsterObj.y), 100);
                    }
                });
            });
        });

        conn.subscribe('halflingsCategory', function(topic, data) {
            //console.log(data.article);
            data.article.forEach(function(articleObj) {
                var incomingId = articleObj.id;

                halfling_list.forEach(function (halflingObj, index) {
                    if (halflingObj.id == incomingId) {
                        //console.log(playerObj.id + ':' + incomingId);
                        //console.log('before' + ':' + playerObj.posx);
                        halflingObj.x = parseInt(articleObj.x);
                        halflingObj.y = parseInt(articleObj.y);
                        // console.log('after' + ':' + playerObj.posx);
                        // halflings[incomingId].body.velocity.x = 1000;
                        // halflings[incomingId].body.velocity.y = 1000;
                        // game.physics.arcade.velocityFromAngle(players[incomingId].angle, 300,players[incomingId].body.velocity);

                        //console.log(incomingId);

                        if  (halflings[incomingId]!==undefined) {
                            game.physics.arcade.moveToXY(halflings[incomingId], parseInt(halflingObj.x), parseInt(halflingObj.y), 100);
                        }


                    }
                });


            });
        });

        /*
        conn.subscribe('playersCategory', function(topic, data) {
            //console.log(data.article);
            for (var iterate=0;iterate <= data.article.length-1;iterate++){

                var incomingId =  data.article[iterate].id;
                players_list[incomingId]=[];

                players_list[incomingId].posx = parseInt(data.article[iterate].posx) ;
                players_list[incomingId].posy = parseInt(data.article[iterate].posy) ;
            }
        });
*/
        conn.subscribe('playersCategory', function(topic, data) {
            //console.log(data.article);
            for (var iterate = 0; iterate <= data.article.length - 1; iterate++) {
                var incomingId = data.article[iterate].id;
                players_list.forEach(function (playerObj, index) {
                    if (playerObj.id == incomingId) {
                        //console.log(playerObj.id + ':' + incomingId);
                        //console.log('before' + ':' + playerObj.posx);
                        playerObj.posx = parseInt(data.article[iterate].posx);
                        playerObj.posy = parseInt(data.article[iterate].posy);
                        //console.log('after' + ':' + playerObj.posx);
                        players[incomingId].body.velocity.x = 1000;
                        players[incomingId].body.velocity.y = 1000;
                     //   game.physics.arcade.velocityFromAngle(players[incomingId].angle, 300,players[incomingId].body.velocity);
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

function moveBall(pointer)
{
    send = 1;
    x = parseInt(pointer.worldX);
    y = parseInt(pointer.worldY);
}




function jump(one,two) {

    var source = grid;
    console.log('source:' + source);
    grid = two.dest;
    console.log('grid:' + grid);
    if (source == portal_dest_1[grid]) {
        new_x = portal_sourceX1[grid];
        new_y = portal_sourceY1[grid];
    }
    if (source == portal_dest_2[grid]) {

        new_x = portal_sourceX2[grid];
        new_y = portal_sourceY2[grid];
    }

    if (source == portal_dest_3[grid]) {

        new_x = portal_sourceX3[grid];
        new_y = portal_sourceY3[grid];

    }
    one.body.velocity.x = 0;
    one.body.velocity.y = 0;
    two.body.enable = false;

    get_everything(two.dest);
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

    one.body.immovable = true;
    two.body.immovable = true;

    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=building&id=" + two.id,
        context: document.body,
        dataType: "json"
    }).done(function(result) {

        document.getElementById("building").innerHTML=result;
        document.getElementById("building").show();
        document.getElementById("world").hide();
        document.getElementById("npc").hide();
        document.getElementById("player").hide();
        loadUp();

        var url = "/components/com_battle/includes/building.js";
        jQuery.getScript( url, function() {
            // alert ('hi');
             success2();
        });
            //  mything.replaces(document.id('world'));
    });
//http://eclecticmeme.com/index.php?option=com_battle&format=json&view=building&id=11059
}

function shop() {
    sprite.destroy(true);

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
    two.body.enable =false;

    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&task=action&action=attackMonster&id="+ two.id,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        two.body.enable =true;
        console.log('attacked');
        //document.getElementById("npc").innerHTML=result;
        //document.getElementById("npc").show();
        //document.getElementById("world").hide();
        //document.getElementById("building").hide();
        //document.getElementById("player").hide();
        //loadUp();
        //var url = "/components/com_battle/includes/character.js";
       // jQuery.getScript( url, function() {
//
    //    });

    });
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
    // two.body.enable =false;
    jQuery.ajax({
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
        game.state.start('terminal');
        document.getElementById("world").hide();
        document.getElementById("terminal").innerHTML=result;
        document.getElementById("terminal").show();
   //     loadUp();
        var url = "/components/com_battle/includes/terminal.js";
        jQuery.getScript( url, function() {
        });
    });
}
//////////////////////////////////////////////////////////////////////////////////////

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
        //console.log('x : ' + x + " y : " + y);
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
