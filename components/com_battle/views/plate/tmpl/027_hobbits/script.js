var game = new Phaser.Game(640, 480, Phaser.CANVAS, 'world', { preload: preload, create: create });
var ctx = game.context;

function preload () {
    game.load.image('plate', 'get-your-halfling.jpg');
}

function create() {

    //  This creates a simple sprite that is using our loaded image and
    //  displays it on-screen and assign it to a variable
    var image = game.add.sprite(game.world.centerX, game.world.centerY, 'plate');

    //  Moves the image anchor to the middle, so it centers inside the game properly
    image.anchor.set(0.5);
	
}

function listener() {
	
}

function update() {

}

