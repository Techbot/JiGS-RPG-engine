// defining a single global object (tirnanog) and adding some functions in to its prototype (eg preload, create functions)

var hobbits = {};

hobbits.State001 = function (game) {

};

hobbits.State001.prototype = {

    preload: function () {

        this.load.image('bg', 'get-your-halfling.jpg');
        this.load.spritesheet('hobbit',
            '/components/com_battle/images/assets/chars/halflings/001-Fighter01.png',32,48,12);
    },

    create: function () {

        this.add.sprite(0, 0, 'bg');

        hobbit = this.add.sprite(27, 390, 'hobbit');
        var mx = game.width - game.cache.getImage('hobbit').width;
        var my = game.height - game.cache.getImage('hobbit').height;

        hobbit.animations.add('left',[11,10,9],3,true);
        hobbit.animations.add('right',[1,2,3,],3);
        hobbit.animations.play('left');

        for (var i = 0; i < 5; i++) {

            var hobbit = this.add.sprite(game.rnd.integerInRange(0, mx), game.rnd.integerInRange(0, my), 'hobbit');

            hobbit.inputEnabled = true;
            hobbit.events.onInputDown.add(destroySprite, this);

        }


    }
}

function destroySprite (hobbit) {
    hobbit.destroy();
}

function hobbitLoop() {
}