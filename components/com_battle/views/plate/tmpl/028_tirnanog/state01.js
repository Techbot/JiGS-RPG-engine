// defining a single global object (tirnanog) and adding some functions in to its prototype (eg preload, create functions)

var tirnanog = {};

tirnanog.State001 = function (game) {

};

tirnanog.State001.prototype = {

    preload: function () {

        this.load.image('starBg', 'star-bg.jpg');
        this.load.image('stonePortalMask1', 'stone-portal-mask-lg.png');
        this.load.image('stonePortalMask2', 'stone-portal-mask-med.png');
        this.load.image('stonePortal', 'stone-portal.png');
        this.load.image('roseMask1', 'rose-mask-lg.png');
        this.load.image('roseMask2', 'rose-mask-med.png');
        this.load.image('rose', 'rose.png');
        this.load.image('roseTexture', 'rose.jpg');
        this.load.image('stoneTexture', 'arizona-sandstone-formations.jpg');
        this.load.spritesheet('rain', 'rain.png', 17, 17);
    },

    create: function () {

        starBg = this.add.sprite(0, 0, 'starBg');

        // mask

        //	Create a new bitmap data the same size as our picture
        var bmdStone = this.make.bitmapData(334, 480);
        var bmdRose = this.make.bitmapData(640, 573);

        //	And create an alpha mask image by combining pic and mask from the cache
        bmdStone.alphaMask('stoneTexture', 'stonePortalMask2');
        bmdRose.alphaMask('roseTexture', 'roseMask1');

        //	A BitmapData is just a texture. You need to apply it to a sprite or image
        //	to actually display it:
        this.add.image(game.world.centerX, game.world.centerY, bmdStone).anchor.set(0.5, 0.5);
        //this.add.image(game.world.centerX, game.world.centerY, bmdRose).anchor.set(0.5, 0.5);

        // stretch to fit canvas
        bmdStone.x = 0;
        bmdStone.y = 0;
        bmdStone.height = game.height;
        bmdStone.width = game.width;
		
        bmdRose.x = 0;
        bmdRose.y = 0;
        bmdRose.height = 10;
        bmdRose.width = 10;

        // center horizontally
        stonePortal = this.add.sprite(0, 0, 'stonePortalMask1');
        stonePortal.x = (game.width / 2) - (stonePortal.width / 2);
        stonePortal.alpha = 1;

        rose = this.add.sprite(game.width / 2, game.height / 3, 'rose');
        rose.anchor.setTo(0.5, 0.5);
        rose.alpha = 1;
        rose.width = 0;
        rose.height = 0;

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



