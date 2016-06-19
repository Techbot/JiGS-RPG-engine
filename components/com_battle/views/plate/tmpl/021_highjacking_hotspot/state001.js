// defining a single global object (highjacking_hotspot) and adding some functions in to its prototype (eg preload, create functions)

var highjacking_hotspot = {};


highjacking_hotspot.State001 = function (game) {


};

highjacking_hotspot.State001.prototype = {

    preload: function () {

        //  You can fill the preloader with as many assets as your game requires

        //  Here we are loading an image. The first parameter is the unique
        //  string by which we'll identify the image later in our code.

        //  The second parameter is the URL of the image (relative)
        this.load.image('plate', 'highjacking_hotspot.jpg');

    },
    create: function () {

        //  This creates a simple sprite that is using our loaded image and
        //  displays it on-screen and assign it to a variable
        var image = this.add.sprite(game.world.centerX, game.world.centerY, 'plate');

        //  Moves the image anchor to the middle, so it centers inside the game properly
        image.anchor.set(0.5);

    }
}
