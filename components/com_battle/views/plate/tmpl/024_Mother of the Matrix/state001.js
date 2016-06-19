// defining a single global object (mother_of_the_matrix) and adding some functions in to its prototype (eg preload, create functions)

var mother_of_the_matrix = {};

var text;
var counter = 0;
var renderTexture;
var renderTexture2;
var currentTexture;
var outputSprite;
var stuffContainer;
var count = 0;

mother_of_the_matrix.State001 = function (game) {

};

mother_of_the_matrix.State001.prototype = {

    preload: function () {


        //  The second parameter is the URL of the image (relative)
        game.load.image('bg', 'bg.jpg');
        game.load.image('Canoness', 'Concept_Bloody_Canoness_2.png');
        game.load.spritesheet('anti_gravitys_rainbow',  'anti_gravitys_rainbow__x1_loop_png_1354837031.png', 138, 148, 60);
        game.load.atlas('sprite', 'sprite.png', 'sprite.json');
        game.load.image('spin1', 'spinObj_01.png');
        game.load.image('spin2', 'spinObj_02.png');


        //  game.load.image('spin4', 'spinObj_04.png');
        // game.load.image('spin5', 'spinObj_05.png');
        //  game.load.image('spin6', 'spinObj_06.png');
        // game.load.image('spin7', 'spinObj_07.png');
        //game.load.image('spin8', 'spinObj_08.png');

    },
    create: function () {

        //  This creates a simple sprite that is using our loaded image and
        //  displays it on-screen and assign it to a variable
        var image = game.add.sprite(game.world.centerX, game.world.centerY, 'bg');
        var canoness= game.add.sprite(game.world.centerX, game.world.centerY-200, 'Canoness');


        //  This simply creates a sprite
        obj001 = game.add.sprite(100, 100, 'anti_gravitys_rainbow');
        obj001.animations.add('walk');
        obj001.animations.play('walk',16,true);

        obj003 = game.add.sprite(391, 72, 'sprite', 'object003');

        //  Moves the image anchor to the middle, so it centers inside the game properly
        image.anchor.set(0.5);

        //////////////////////////////////////////
        // create two render textures.. these dynamic textures will be used to draw the scene into itself
        renderTexture = game.add.renderTexture(600, 400, 'texture1');
        renderTexture2 = game.add.renderTexture(600, 400, 'texture2');
        currentTexture = renderTexture;

        // create a new sprite that uses the render texture we created above
        outputSprite = game.add.sprite(20, 20, currentTexture);

        // align the sprite
        outputSprite.anchor.x = 0.5;
        outputSprite.anchor.y = 0.5;

        stuffContainer = game.add.group();
        stuffContainer.x = 600/2;
        stuffContainer.y = 400/2;

        // now create some items and randomly position them in the stuff container
        for (var i = 0; i < 2; i++)
        {
            var item = stuffContainer.create(Math.random() * 300 - 200, Math.random() * 300 - 200, game.rnd.pick(['spin1','spin2']));
            item.anchor.setTo(0.5, 0.5);
        }
        // used for spinning!
        count = 0;

        addtext();
////////////////////////////////////////////////////////////////////
//                  Input
/////////////////////////////////////////////////////////////////

        //  cursors = game.input.keyboard.createCursorKeys();

        text1.inputEnabled = true;
        text1.events.onInputDown.add(listenerCurse, this);
        text3.inputEnabled = true;
        text3.events.onInputDown.add(listenerCharm, this);

    }
}



function addtext(){

    game.stage.setBackgroundColor(0x2d2d2d);

    //  Here we create 2 new groups
    text = game.add.group();

    text1 = game.add.text(game.world.centerX -170, game.world.centerY, ' Curse ', {/*style*/}, text);
    text2 = game.add.text(game.world.centerX, game.world.centerY, '  or  ', { fill: '#ff00ff', font: "50px Arial",strokeThickness:8, stroke:'#ff0000' }, text);
    text3 = game.add.text(game.world.centerX +190, game.world.centerY, 'Charm ? ', { fill: '#ff00ff', font: "50px Arial",strokeThickness:8, stroke:'#ff0000' }, text);

    //	Center align
    text1.anchor.set(0.5);
    text1.align = 'center';

    //	Font style
    text1.font = 'Arial Black';
    text1.fontSize = 50;
    text1.fontWeight = 'bold';

    //	Stroke color and thickness
    text1.stroke = '#000000';
    text1.strokeThickness = 8;
    text1.fill = '#43d637';

    //  And now we'll color in some of the letters
    //   text1.addColor('#ff00ff', 9);
    //  text1.addColor('#43d637', 13);

    //  This allows us to color the stroke instead of the letters
    //   text1.addStrokeColor('#ff0000', 13);
    //  text1.addStrokeColor('#000000', 20);

    //	Center align
    text2.anchor.set(0.5);
    text2.align = 'center';

    //	Font style
    text2.font = 'Arial Black';
    text2.fontSize = 50;
    text2.fontWeight = 'bold';

    //	Stroke color and thickness
    text2.stroke = '#000000';
    text2.strokeThickness = 8;
    text2.fill = '#43d637';

    //  And now we'll color in some of the letters
    //   text2.addColor('#ff00ff', 9);
    //   text2.addColor('#43d637', 13);

    //  This allows us to color the stroke instead of the letters
    //   text2.addStrokeColor('#ff0000', 13);
    //   text2.addStrokeColor('#000000', 20);

    //	Center align
    text3.anchor.set(0.5);
    text3.align = 'center';

    //	Font style
    text3.font = 'Arial Black';
    text3.fontSize = 50;
    text3.fontWeight = 'bold';

    //	Stroke color and thickness
    text3.stroke = '#000000';
    text3.strokeThickness = 8;
    text3.fill = '#43d637';

    //  And now we'll color in some of the letters
///    text3.addColor('#ff00ff', 9);
    //   text3.addColor('#43d637', 13);

    //  This allows us to color the stroke instead of the letters
    //   text3.addStrokeColor('#ff0000', 13);
    //   text3.addStrokeColor('#000000', 20);
    // Control Panel image click


}

function listenerCurse () {

    counter++;
    text1.x=350
    text1.text = "You clicked Curse!";
    text2.text="";
    text3.text="";
    text1.input.enableDrag();
    changeFrame();

}
function listenerCharm () {

    counter++;
    text1.x=350
    text1.text = "You clicked Charm!";
    text2.text="";
    text3.text="";
    text1.align = 'center';

    text1.input.enableDrag();
    changeFrame();

}







function changeFrame() {

//    obj003.frameName = 'object004';

}

function update() {

    stuffContainer.addAll('rotation', 0.1);

    count += 0.01;

    // swap the buffers..
    var temp = renderTexture;
    renderTexture = renderTexture2;
    renderTexture2 = temp;

    // set the new texture
    outputSprite.setTexture(renderTexture);

    // twist this up!
    stuffContainer.rotation -= 0.01
//	outputSprite.scale.x = outputSprite.scale.y  = 1 + Math.sin(count) * 0.2;

    // render the stage to the texture
    // the true clears the texture before content is rendered
//	renderTexture2.renderXY(game.stage, 0, 0, true);

}

