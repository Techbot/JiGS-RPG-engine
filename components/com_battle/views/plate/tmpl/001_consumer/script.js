var game = new Phaser.Game(640, 480, Phaser.CANVAS, 'world', { preload: preload, create: create });
var text;
var bar;
var counter = 0;
var obj001;
var rectWidth;
var rectHeight;

function preload () {
    //  You can fill the preloader with as many assets as your game requires
    //  Here we are loading an image. The first parameter is the unique
    //  string by which we'll identify the image later in our code.
    //  The second parameter is the URL of the image (relative)
    game.load.image('bg', 'bg.jpg');
    game.load.image('tile', 'tile.jpg');
    game.load.spritesheet('fighter01',
        '/components/com_battle/images/assets/chars/halflings/001-Fighter01.png',32,48,12);
    game.load.atlas('sprite', 'sprite.png', 'sprite.json');
}
function create() {


    //  This creates a simple sprite that is using our loaded image and
    //  displays it on-screen and assign it to a variable
    var image = game.add.sprite(game.world.centerX, game.world.centerY, 'bg');
    //  This simply creates a sprite using the mushroom image we loaded above and positions it at 200 x 200
    obj001 = game.add.sprite(222, 327, 'sprite', 'object001');
    obj002 = game.add.sprite(-27, 122, 'sprite', 'object002');
    obj003 = game.add.sprite(391, 72, 'sprite', 'object003');
    tile   = game.add.sprite(421, 82, 'tile');
    obj004 = game.add.sprite(27, 390, 'fighter01');
    obj004.animations.add('left',[11,10,9],3,true);
    obj004.animations.add('right',[1,2,3,],3);
    obj004.animations.play('left');
    //  Moves the image anchor to the middle, so it centers inside the game properly
    image.anchor.set(0.5);
    ////////////////////////////////////////////////////////////////////
    //                  Input
    /////////////////////////////////////////////////////////////////
    cursors = game.input.keyboard.createCursorKeys();
    // Control Panel image click
	obj001.inputEnabled = true;
    //text = game.add.text(20, 20, '', { fill: '#ffffff', font: "14px Arial", });
    obj001.events.onInputDown.add(listener, this);
    tile.name ='tile long tooltip title';
    obj004.name ='obj004';

    tile.inputEnabled = true;
    obj004.inputEnabled = true;

    tile.events.onInputOver.add(tooltip, this);
    tile.events.onInputOut.add(killTooltip, this);

    obj004.events.onInputOver.add(tooltip, this);
    obj004.events.onInputOut.add(killTooltip, this);

   // var style = { font: "bold 32px Arial", fill: "#fff", boundsAlignH: "center", boundsAlignV: "middle" };

    //  The Text is positioned at 0, 100
    //text = game.add.text(0, 0, "phaser 2.4 text bounds", style);
}
function listener () {
  //  counter++;
   // text2.text = "You clicked " + counter + " times!";
	//changeFrame();
}
function changeFrame() {
    obj003.frameName = 'object004';
}

function tooltip(thing) {
	
	var rectWidth = tile.name.length + 40;
	
    ///////////////////////////
    //bar = game.add.graphics();
    //bar.beginFill(0x000000, 0.2);
    //bar.drawRect(thing.x-20, thing.y-20, rectWidth, rectHeight);

    console.log(thing.name, rectWidth, typeof bar);
	
    var style = { font: '14px Arial', fill: 'white', align: 'left', wordWrap: true };
    //var style = { font: '14px Arial', fill: 'white', align: 'left', backgroundColor: 'black', boundsAlignH: "center", boundsAlignV: "middle" };
    text = game.add.text(0, 0, thing.name, style);
	text.padding.set(0, 0);
    text.setShadow(3, 3, 'rgba(0,0,0,0.9)', 2);
	
    text.setTextBounds(thing.x-20, thing.y-20, rectWidth, rectHeight);
	
}

function killTooltip(thing) {
	
    text.destroy();
    //bar.destroy();
	
}