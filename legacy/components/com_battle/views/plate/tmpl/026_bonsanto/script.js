var game = new Phaser.Game(640, 480, Phaser.CANVAS, 'world', { preload: preload, create: create });
var videotape = document.getElementById("myVideo");
var ctx = game.context;

function preload () {

    //  You can fill the preloader with as many assets as your game requires

    //  Here we are loading an image. The first parameter is the unique
    //  string by which we'll identify the image later in our code.

    //  The second parameter is the URL of the image (relative)
    game.load.image('plate', 'bonsanto.jpg');
    game.load.image('clickMe', 'clickMe.png');
    //game.load.video('chrome', 'DNA.ogv');
    //game.load.video('Monsanto', 'Monsanto.ogv');

    //game.load.bitmapFont('shortStack', '/components/com_battle/views/plate/tmpl/026_bonsanto/shortStack.png', '/components/com_battle/views/plate/tmpl/026_bonsanto/shortStack.fnt');
}

function create() {

    //  This creates a simple sprite that is using our loaded image and
    //  displays it on-screen and assign it to a variable
    var image = game.add.sprite(game.world.centerX, game.world.centerY, 'plate');

    //  Moves the image anchor to the middle, so it centers inside the game properly
    image.anchor.set(0.5);
	
	// button
    obj001 = game.add.sprite(28, 170, 'clickMe');
    clickMeText = game.add.text(55, 195, 'Free Seeds', {font: '22px Arial', fill: 'white', align: 'center', wordWrap: true, wordWrapWidth: 250});
	
    cursors = game.input.keyboard.createCursorKeys();

    // Control Panel image click
    obj001.inputEnabled = true;
    obj001.events.onInputDown.add(listener, this);
	obj001.events.onInputDown.addOnce(updateText, this);
    //video = game.add.video('chrome');
    //video2 = game.add.video('Monsanto');

    //  See the docs for the full parameters
    //  But it goes x, y, anchor x, anchor y, scale x, scale y
    //sprite = video.addToWorld(game.world.centerX- 180 , game.world.centerY, 0.5, 0.5,.90,.10);
    //sprite2 = video2.addToWorld(game.world.centerX+ 180 , game.world.centerY, 0.5, 0.5,.990,.10);
    //  true = loop
    //video.play(true);
    //video2.play(true);
   // game.input.onDown.add(pause, this);

}

function listener() {

    jQuery.ajax({
        url: "/index.php?option=com_battle&task=action&action=get_free_seed&format=raw",
        success: function (result) {
			// Lisa - using .replace method to remove double quotes from php message string
            console.log(result.replace(/\"/g, ""));
        //  game.add.bitmapText(132, 132, 'shortStack', result, 32);
		
			// Lisa TODO add padding or a shape w bg behind text
            var style = { font: '16px Arial', fill: 'white', align: 'left', wordWrap: true, wordWrapWidth: 400, backgroundColor: 'rgba(44,123,200,0.5)' };
            var text = game.add.text(35, 85, result.replace(/\"/g, ""), style);
            //text.anchor.set(0.5);
			
			//var text = game.add.text(28, 80, result, { font: "16px Arial", fill: "#fff", align: 'left', wordWrap: true, wordWrapWidth: 400 });
			//text.lineSpacing = 1;
			//text.stroke = "#2C7BC8";
			//text.strokeThickness = 12;
			//  Apply the shadow to the Fill only
			//text.setShadow(1, 1, "#333333", 2, false, true);
			
        }
    });

    obj001.events.onInputDown.remove(listener, this);
	game.add.tween(obj001).to( { alpha: 0 }, 2000, "Linear", true);
	
}

function update() {

    //drawFrame(context, videotape);

}

function updateText() {
	
	game.add.tween(clickMeText).to( { alpha: 0 }, 2000, "Linear", true);
	clickMeText.setText("You're welcome");
}


function drawFrame(context, videotape){
    //context.drawImage(videotape, 0, 0);
}

function render() {

    game.debug.text("Video Time: " + video.currentTime, 32, 20);
    game.debug.text("Video Duration: " + video.duration, 550, 20);

    game.debug.text("Video Progress: " + Math.round(video.progress * 100) + "%", 32, 590);
    game.debug.text("Video Playing: " + video.playing, 550, 590);

}
