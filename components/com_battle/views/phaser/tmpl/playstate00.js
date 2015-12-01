



/**
 * Created by techbot on 17/11/14.
 */
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
var text2;
var index = 0;
var line = '';

playState[0] = {

   preload: function() {
            game.load.image('arrow', '/images/stories/thisway.png');
    },
    create: function() {
        sprite = game.add.sprite(0,0, 'arrow');
        //  Modify the world and camera bounds
        game.world.setBounds(0, 0, 600, 600);
        //game.stage.backgroundColor = '#000000';
        cursors = game.input.keyboard.createCursorKeys();
        text2 = game.add.text(32, 80, '', { font: "18pt Courier", fill: "#19cb65", stroke: "#119f4e", strokeThickness: 2 });
        nextLine();
    }
};
