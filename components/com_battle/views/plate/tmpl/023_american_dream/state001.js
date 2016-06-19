// defining a single global object (american_dream) and adding some functions in to its prototype (eg preload, create functions)

var american_dream = {};


american_dream.State001 = function (game) {


};

american_dream.State001.prototype = {

    preload: function () {

        //  You can fill the preloader with as many assets as your game requires

        //  Here we are loading an image. The first parameter is the unique
        //  string by which we'll identify the image later in our code.

        //  The second parameter is the URL of the image (relative)
        game.load.image('plate', 'american_dream.jpg');
        game.load.spritesheet('fighter01',
            '/components/com_battle/images/assets/chars/halflings/002-Fighter02.png',32,48,12);

    },
    create: function () {

        //  This creates a simple sprite that is using our loaded image and
        //  displays it on-screen and assign it to a variable
        var image = game.add.sprite(game.world.centerX, game.world.centerY, 'plate');

        //  Moves the image anchor to the middle, so it centers inside the game properly
        image.anchor.set(0.5);

        obj004 = game.add.sprite(27, 390, 'fighter01');

        obj004.animations.add('left', [11, 10, 9], 3, true);
        obj004.animations.add('right', [1, 2, 3,], 3);
        obj004.animations.play('left');
    }
}
