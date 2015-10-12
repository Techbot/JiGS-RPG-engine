/**
 * Created by techbot on 17/11/14.
 */

/*
jQuery.getJSON('index.php?option=com_battle&task=map_action&action=sing_song', function (result)
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
*/
var index = 0;
var line = '';

playState[2] = {

   preload: function() {
            game.load.image('arrow', '/components/com_battle/images/hacker-map.jpg');

       content = [
           " ",
           "This terminal belongs to Elle Corp",
           "",
           "Enter PIN to begin",
           "",
           "One Moment PLease",
           ".",
           "..",
           "...",
           "--Scan Complete--",

           "--Open Ports: None-",
           "- Port: 80 HTTP: Encrypted - 128 bits-",
           "- You may proceed -",
           "- You're Welcome -",
       ];



    },
    create: function() {
        background = game.add.sprite(0,0, 'arrow');
        //  Modify the world and camera bounds
        game.world.setBounds(0, 0, 600, 600);
        //game.stage.backgroundColor = '#ff0000';
        cursors = game.input.keyboard.createCursorKeys();
        text2 = game.add.text(32, 80, '', { font: "18pt Courier", fill: "#19cb65", stroke: "#119f4e", strokeThickness: 2 });
        nextLine();


    }
};

