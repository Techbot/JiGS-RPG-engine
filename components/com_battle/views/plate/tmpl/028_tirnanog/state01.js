// defining a single global object (tirnanog) and adding some functions in to its prototype (eg preload, create functions)

var tirnanog = {};

tirnanog.State001 = function (game) {

};

tirnanog.State001.prototype = {

    preload: function () {

        this.load.image('starBg', 'star-bg.jpg');
        this.load.image('stonePortal', 'stone-portal.png');
        this.load.image('stonePortalMask1', 'stone-portal-mask-lg.png');
        this.load.image('stonePortalMask2', 'stone-portal-mask-med.png');
        this.load.image('stonePortal', 'stone-portal.png');
        this.load.image('rose', 'rose.png');
        this.load.image('stone', 'arizona-sandstone-formations.jpg');
        this.load.spritesheet('rain', 'rain.png', 17, 17);
    },

    create: function () {

        starBg = this.add.sprite(0, 0, 'starBg');

        // mask

        //	Create a new bitmap data the same size as our picture
        var bmd = this.make.bitmapData(334, 480);

        //	And create an alpha mask image by combining pic and mask from the cache
        bmd.alphaMask('stone', 'stonePortalMask2');

        //	A BitmapData is just a texture. You need to apply it to a sprite or image
        //	to actually display it:
        this.add.image(game.world.centerX, game.world.centerY, bmd).anchor.set(0.5, 0.5);

        // stretch to fit canvas
        bmd.x = 0;
        bmd.y = 0;
        bmd.height = game.height;
        bmd.width = game.width;

        // center horizontally
        stonePortal = this.add.sprite(0, 0, 'stonePortalMask1');
        stonePortal.x = (game.width / 2) - (stonePortal.width / 2);
        stonePortal.alpha = 1;

        // center horizontally
        rose = this.add.sprite(game.width / 2, game.height / 3, 'rose');
        rose.anchor.setTo(0.5, 0.5);

        rose.width = 0;
        rose.height = 0;
        rose.alpha = 1;

        // to( Map<String, num> properties, [int duration = 1000, double ease (double k) = null, bool autoStart = false, num delay = 0.0, int repeat = 0, bool yoyo = true])
        this.add.tween(rose).to({
            width: (game.width * 2),
            height: (game.height * 2)
        }, 4000, Phaser.Easing.Circular.In, true, 0, 0, false);
        this.add.tween(rose).to({alpha: 0}, 1000, Phaser.Easing.Bounce.In, true, 3000, 0, false);

        var emitter = game.add.emitter(game.world.centerX, game.world.centerY, 400);

        emitter.width = game.world.width;
        emitter.height = game.world.height;

        emitter.makeParticles('rain');

        emitter.minParticleScale = 0.1;
        emitter.maxParticleScale = 0.5;

        emitter.gravity = 0;
        emitter.setYSpeed(0, 0);
        emitter.setXSpeed(0, 0);

        emitter.minRotation = 0;
        emitter.maxRotation = 0;

        emitter.start(false, 1600, 5, 0);

    }

}



