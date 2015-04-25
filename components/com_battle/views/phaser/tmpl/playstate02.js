/**
 * Created by techbot on 17/11/14.
 */

var content;


jQuery.getJSON('index.php?options=com_battle&task=map_action&action=sing_song', function (result)
{

    //grid = result;
    //console.log("buildings : " + buildings.length);
    // console.log("buildings2 : " + buildings.length);
    // load buildings

    //game.state.add('next', playState[1]);
    //game.state.add('play', playState[1]);
    //game.state.start('play');

    //game.state.start('next');
    content = [
        " ",
        "Everything you read on the 'Net is true",
        "",
        "Register to begin",
        "Upload an Avatar to your profile",
        "Login to Enter",
        " ",
        "    ",
        " Be a soldier   ",
        "  or a hacker,  ",
        "  a tradesman,  ",
        "  or an explorer  ",
        " Be all that you can be   ",
        "    ",
        "    ",
        " or be Batman   ",
        " Always be Batman ",

        "03:45, July 23rd,  2053",
        "somewhere outside of Pyramid City ",
        " - Europe",
        "The Eclectic Meme Conspiracy",
    ];

});

var index = 0;
var line = '';

playState[2] = {

   preload: function() {
            game.load.image('arrow', '/components/com_battle/images/hacker-map.jpg');
    },
    create: function() {
        background = game.add.sprite(0,0, 'arrow');
        //  Modify the world and camera bounds
        game.world.setBounds(0, 0, 600, 600);
        //game.stage.backgroundColor = '#000000';
        cursors = game.input.keyboard.createCursorKeys();
        text2 = game.add.text(32, 80, '', { font: "18pt Courier", fill: "#19cb65", stroke: "#119f4e", strokeThickness: 2 });
        nextLine();
    }
};

