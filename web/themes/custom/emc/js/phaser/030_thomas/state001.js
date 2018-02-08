// defining a single global object (tirnanog) and adding some functions in to its prototype (eg preload, create functions)

var thomas = {};

thomas.State001 = function (game) {

};

thomas.State001.prototype = {

    preload: function () {

        this.load.image('bg', '030_thomas/thomas-livingroom.jpg');
        this.load.image('jimi', '030_thomas/jimi.jpg');
    },

    create: function () {

        bg = this.add.sprite(0, 0, 'bg');
        jimi = this.add.sprite(186, 92, 'jimi');
		jimi.anchor.setTo(0.5, 0.5);
		jimi.alpha = 0.8;
		
		
		
    //  Here we'll create a basic looped event.
    //  A looped event is like a repeat event but with no limit, it will literally repeat itself forever, or until you stop it.

    //  The first parameter is how long to wait before the event fires. In this case 1 second (you could pass in 1000 as the value as well.)
    //  The next two parameters are the function to call ('updateCounter') and the context under which that will happen.

    game.time.events.loop(Phaser.Timer.SECOND, pulse, this);

    }

}
/**
 * Returns a random number between min (inclusive) and max (exclusive)
 */
function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}
/**
 * Returns a random integer between min (inclusive) and max (inclusive)
 * Using Math.round() will give you a non-uniform distribution!
 */
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}



function pulse() {

		var i = getRandomInt(0, 6);
		var j = getRandomInt(7, 9);

		this.add.tween(jimi).to({
            width: (jimi.width + i),
            height: (jimi.height + i),
			alpha: '0.' + j
        }, 1000, Phaser.Easing.Elastic.In, true, 0, 0, false);
		
		console.log(i, '0.' + j );
}
