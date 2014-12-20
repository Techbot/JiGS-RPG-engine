var game = new Phaser.Game(636, 500, Phaser.AUTO, "world");

//All parameters are optional but you usually want to set width and height
//Remember that the game object inherits many properties and methods!

var map;
var layer;
var x;
var y;
var phaser;
var sprite;
var sprite2;
var grid = 9;



game.state.add('next', playState[grid]);
game.state.add('play', playState[grid]);

game.state.start('play');


function moveBall(pointer)
{
    //  sprite.reset(pointer.x, pointer.y, 100)
    //   phaser.rotation = game.physics.arcade.accelerateToPointer(phaser, 60, game.input.activePointer, 1000);
    // phaser.x = pointer.x;
    //  phaser.y = pointer.y;

    x = pointer.worldX;
    y = pointer.worldY;

    //console.log(x);
   // console.log(y);
    //  Give a little boost to velocity
    //sprite.body.velocity.x = 1;
    //sprite.body.velocity.y = 1;
}
/*
function onDragStop () {
    sprite.body.moves = true;
}
function onDragStart(){
    sprite.body.moves = false;
}
*/


function jump(){



    game.state.add('next', playState[portal00003.id]);
    game.state.start('next');
}


/*
 function jump00003(){
 grid = 4;
 console.log("grid : " + grid);
 game.state.add('next', playState4);
 game.state.start('next');
 }
 function jump00004(){
 grid = 4;
 console.log("grid : " + grid);
 game.state.add('next', playState4);
 game.state.start('next');
 }
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function battle() {
    game.state.add('next', loadState);
    game.state.start('next');
}

function battle1() {
    grid = 7;
    game.state.add('next', playState[7]);
    game.state.start('next');
}
function battle2() {
    grid = 8;
    game.state.add('next', playState[8]);
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


        //  mything.replaces(document.id('world'));
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

