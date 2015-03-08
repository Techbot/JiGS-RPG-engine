var game = new Phaser.Game(636, 500, Phaser.AUTO, "world");

//All parameters are optional but you usually want to set width and height
//Remember that the game object inherits many properties and methods!
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
var grid;
var cursors;
var players_list=0;
var avatar;

jQuery.getJSON('index.php?options=com_battle&task=map_action&action=get_grid&format=raw', function(result)
{
    grid = result[0];
    new_x = parseFloat(result[1]);
    new_y = parseFloat(result[2]);
    avatar = result[3];
    //console.log("buildings : " + buildings.length);
    // console.log("buildings2 : " + buildings.length);
    // load buildings

    game.state.add('next', playState[1]);
    //game.state.add('play', playState[1]);
    //game.state.start('play');

    get_everything(grid);

});

/*
blip.sampleLoader()
    .samples({
        'uke': 'http://www.eclecticmeme.com/components/com_battle/includes/ukeC.wav'
        ,
        'drumloop': 'http://www.eclecticmeme.com/components/com_battle/includes/513_cook.wav'
        ,
        'bass_note': 'http://www.eclecticmeme.com/components/com_battle/includes/C.wav'

    })
    .done(loaded)
    .load();
*/


function moveBall(pointer)
{
    //  sprite.reset(pointer.x, pointer.y, 100)
    //  phaser.rotation = game.physics.arcade.accelerateToPointer(phaser, 60, game.input.activePointer, 1000);
    //  phaser.x = pointer.x;
    //  phaser.y = pointer.y;
    send = 1;
    x = pointer.worldX;
    y = pointer.worldY;
}
/*
function onDragStop () {
    sprite.body.moves = true;
}
function onDragStart(){
    sprite.body.moves = false;
}
*/

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
    //game.state.add('next', playState[1]);
    //
    // game.state.add('next', playState[two.dest]);

}

function get_everything(dest){

    jQuery.getJSON('index.php?options=com_battle&task=map_action&action=get_buildings&format=raw&grid=' + dest, function(result)
    {
        buildings = result;
        //console.log("buildings : " + buildings.length);
        // console.log("buildings2 : " + buildings.length);
        // load buildings
        jQuery.getJSON('index.php?options=com_battle&task=map_action&action=get_chars&format=raw', function(result)
        {
            npc_list = result;

            jQuery.getJSON('index.php?options=com_battle&task=map_action&action=get_players&format=raw', function(result)
            {

                players_list = result;

            //console.log("buildings : " + buildings.length);
            // console.log("buildings2 : " + buildings.length);
            // load buildings
            game.state.start('next');
            });
        });
    });
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function enter_building(one,two) {

    //one.body.velocity.x = 0;
    //one.body.velocity.y = 0;
    //two.body.velocity.x = 0;
    //two.body.velocity.y = 0;
    one.body.immovable = true;
    two.body.immovable = true;

    //one.destroy(true);
    //two.destroy(true);

    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=building&id=" + two.id,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        document.getElementById("mainbody").innerHTML=result;
        var url = "/components/com_battle/includes/building.js";
        jQuery.getScript( url, function() {
            // alert ('hi');
             success2();
        });
            //  mything.replaces(document.id('world'));
    });
//http://eclecticmeme.com/index.php?option=com_battle&format=json&view=building&id=11059
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function shop() {
  //  monster1.destroy(true);
  //  monster2.destroy(true);
    monster3.body.velocity.x = 0;
    monster3.body.velocity.y = 0;
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
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function church() {
    monster3.destroy(true);
    monster4.destroy(true);
    window.location.assign("/index.php?option=com_wrapper&view=wrapper&Itemid=404")


}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function npc(one,two) {

    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=character&id="+ two.key_id,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        document.getElementById("mainbody").innerHTML=result;
    });
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function player(one,two) {
    two.body.enable = false;
    one.body.enable = false;
    jQuery.ajax({
        url: "/index.php?option=com_battle&format=json&view=player&id="+ two.key_id,
        context: document.body,
        dataType: "json"
    }).done(function(result) {
        document.getElementById("mainbody").innerHTML=result;
        var url = "/components/com_battle/includes/jigs.js";
        jQuery.getScript( url, function() {
            // alert ('hi');
          //  success2();
        });
    });
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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

        // set base tempo var
        var TEMPO = 125;

        // create clips
        var uke1 = blip.clip().sample('bass_note');
        var uke2 = blip.clip().sample('uke');
        var bassDrum = blip.clip().sample('drumloop');

        /* ====================== LOOPS ====================== */

        bass = blip.loop()
            .tempo(TEMPO)
            .data([1, 1/2])
            .tick(function (t, d) {
                if (blip.chance(1)) uke1.play(t, {
                    rate: d,
                    gain: 0.5 / Math.sqrt(d)
                });
            });


        rhythmic = blip.loop()
            .tempo(TEMPO)
            .data([1,0,0,0])
            .tick(function(t,d) {
                if (d) {
                    bassDrum.play(t)
                }
            });

        melody = blip.loop()
            .tempo(TEMPO * 2)
            .data([3 / 2, 2, 3, 5 / 4, 5 / 2, 5 / 8])
            .tick(function (t, d) {
                if (blip.chance(1 / 3)) uke2.play(t, {
                    rate: d,
                    gain: 0.4
                })
                if (blip.chance(1 / 6)) uke2.play(t, {
                    rate: d * 3 / 2,
                    gain: 0.4
                })
            });

        /* click events */
      //  document.getElementById('play').addEventListener('click', function () {
        //    bass.start();
       //     melody.start();
     //   rhythmic.start();
      //  });
   /*     document.getElementById('pause').addEventListener('click', function () {
            bass.stop();
            melody.stop();
        });
*/


}

function doSomething() {


    if (x != undefined)
    {
        //console.log('x : ' + x + " y : " + y);
        jQuery.getJSON('index.php?options=com_battle&task=map_action&action=update_pos&format=raw&posx=' + x + '&posy=' + y, function (result)
        {

        //grid = result;
        //console.log("buildings : " + buildings.length);
        // console.log("buildings2 : " + buildings.length);
        // load buildings

        //game.state.add('next', playState[1]);
        //game.state.add('play', playState[1]);
        //game.state.start('play');

        //game.state.start('next');

        });
    }
}