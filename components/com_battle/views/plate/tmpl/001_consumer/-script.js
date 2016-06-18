var text;
var counter = 0;
var game = new Phaser.Game(640, 480, Phaser.CANVAS, 'world', { preload: preload, create: create, update: update, render: render });
var obj001;

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
	
	game.input.addMoveCallback(p, this);
	
// Control Panel image click
	obj001.inputEnabled = true;
    text = game.add.text(20, 20, '', { fill: '#ffffff', font: "14px Arial", });
    obj001.events.onInputDown.add(listener, this);
    tile.name='tile';
    obj004.name='obj004';
    tile.inputEnabled = true;
    obj004.inputEnabled = true;
	
		tile.events.onInputOver.add(tooltip, this);
		obj004.events.onInputOver.add(tooltip, this);
}

function p(pointer) {
    console.log(pointer.event);
}

function listener () {
    counter++;
    text.text = "You clicked " + counter + " times!";
	changeFrame();
}

function changeFrame() {
    obj003.frameName = 'object004';
}

function tooltip(thing) {
    //console.log(thing.name);
	//console.log("run tooltip");
	//var bar = game.add.graphics();
    //bar.beginFill(0x000000, 0.2);
    //bar.drawRect(thing.x - 20, thing.y - 20, 100, 30);
	
    var style = {
        font: 'bold 12px Arial', fill: 'white', align: "center", boundsAlignH: 'center', boundsAlignV: 'middle' };
		
    var text = game.add.text(thing.x - 20, thing.y - 20, thing.name, style);

	//text.setShadow(1, 1, 'rgba(0,0,0,0.5)', 2);
    //  We'll set the bounds to be relative to thing x and y and be 100px wide by 30px high
    //text.setTextBounds(thing.x - 20, thing.y - 20, 100, 30);

}

function tooltipClear() {
	text.destroy(tooltip, this);
	//console.log("destroy tooltip");
}

function update() {

    if (tile.input.pointerOver())
    {
    }
    else
    {
		tooltipClear();
    }

}


function render() {

    game.debug.text("Over: " + tile.input.pointerOver(), 32, 32);
    game.debug.text(game.input.mouse.locked, 320, 32);

}

    /*
    jQuery.ajax({
		
        url: "/index.php?option=com_battle&format=raw&task=action&action=get_property",
        success: function (result) {
			alert("success");
			var obj = JSON.parse(result);

            var style = { font: '14px Arial', fill: 'white', align: 'left', wordWrap: true, wordWrapWidth: 400//, backgroundColor: 'rgba(44,123,200,0.5)'
			};

			for (var i = 0; i < obj.length; ++i) {
                console.log(obj[i].name);
				var text = game.add.text(20, 20*i, obj[i].name, style);
            }
        }
    });
    */
