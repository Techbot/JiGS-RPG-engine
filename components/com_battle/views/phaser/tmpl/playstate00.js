/*content = [
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
    " - Europa",
    "The Eclectic Meme Conspiracy",
];*/
var i;
var d = new Date(),
    h = (d.getHours()<10?'0':'') + d.getHours(),
    m = (d.getMinutes()<10?'0':'') + d.getMinutes();
var printedTime = h + ':' + m;

content = [
    " ",
    "In the beginning, there were no beginnings.",
    "There were no need for them.",
    "But somewhere between then and now,",
    "people started wondering...",
    "Who am I?",
    "Where do I come from?",
    "Where am I going? ",
    "",
    printedTime + ", July 23rd, 2053",
    "Somewhere outside of Pyramid City, Europa",
];
getConspiracy();
function getConspiracy() {
    jQuery.getJSON("http://emcradio.com/api/paragraph/conspiracy?_format=api_json", function (conspiracyObj) {
        //conspiracyToPrint = conspiracyObj.data[0].attributes.field_conspiracy[0].value;
    });
}

var text2;
var index = 0;
var line = '';
var grd;

//  The Google WebFont Loader will look for this object, so create it before loading the script.
WebFontConfig = {

    //  'active' means all requested fonts have finished loading
    //  We set a 1 second delay before calling 'createText'.
    //  For some reason if we don't the browser cannot render the text the first time it's created.
    active: function() { game.time.events.add(Phaser.Timer.SECOND, createText, this); },

    //  The Google Fonts we want to load (specify as many as you like in the array)
    google: {
        families: ['Roboto:300,400,700']
    }

};


playState[0] = {

    preload: function() {
        game.load.image('arrow', '/images/thisway.png');//  Load the Google WebFont Loader script
        game.load.script('webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js');
    },
    create: function() {
        sprite = game.add.sprite(0,0, 'arrow');
        sprite.inputEnabled = true;

        sprite.events.onInputDown.add( function go(){
            game.state.start('next');
        });

        //  Modify the world and camera bounds
        game.world.setBounds(0, 0, 800, 600);
        //game.stage.backgroundColor = '#000000';
        cursors = game.input.keyboard.createCursorKeys();


        text2 = game.add.text();

        text2.font = 'Roboto';
        text2.fontSize = 32;
        text2.fontWeight = 700;

        //  x0, y0 - x1, y1
        grd = text2.context.createLinearGradient(0, 0, 0, 100);
        grd.addColorStop(0, '#099');
        grd.addColorStop(1, '#000');
        text2.fill = grd;

        text2.align = 'center';
        text2.stroke = '#111';
        text2.strokeThickness = 1;
        text2.setShadow(2, 2, 'rgba(0,0,0,0.3)', 2);


        nextLine();

    }

};




