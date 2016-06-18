var game = new Phaser.Game(640, 480, Phaser.CANVAS, 'world', { preload: preload, create: create });

function preload () {

    //  You can fill the preloader with as many assets as your game requires

    //  Here we are loading an image. The first parameter is the unique
    //  string by which we'll identify the image later in our code.

    //  The second parameter is the URL of the image (relative)
    game.load.image('plate', '019_wolfman_vampire.jpg');

}

function create() {

    //  This creates a simple sprite that is using our loaded image and
    //  displays it on-screen and assign it to a variable
    var image = game.add.sprite(game.world.centerX, game.world.centerY, 'plate');

    //  Moves the image anchor to the middle, so it centers inside the game properly
    image.anchor.set(0.5);
}
