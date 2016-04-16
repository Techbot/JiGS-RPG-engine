// defining a single global object (tirnanog) and adding some functions in to its prototype (eg preload, create functions)

var hobbits = {};
var rows = [
    0, 55, 110, 165, 220
];

hobbits.State001 = function (game) {

};

hobbits.State001.prototype = {

    preload: function () {

        this.load.image('bg', 'get-your-halfling.jpg');
        //this.load.image('cabinet', 'cabinet.jpg');
        this.load.spritesheet('hobbit1',
            '/var/www/html/JiGS/components/com_battle/images/assets/chars/halflings/001-Fighter01.png',32,48,12);
        this.load.spritesheet('hobbit2',
            '/var/www/html/JiGS/components/com_battle/images/assets/chars/halflings/002-Fighter02.png',32,48,12);
        this.load.spritesheet('hobbit3',
            '/var/www/html/JiGS/components/com_battle/images/assets/chars/halflings/003-Fighter03.png',32,48,12);
        this.load.spritesheet('hobbit4',
            '/var/www/html/JiGS/components/com_battle/images/assets/chars/halflings/004-Fighter04.png',32,48,12);

    },

    create: function () {

        this.add.sprite(0, 0, 'bg');
        //this.add.sprite(136, 145, 'cabinet');

        //animated sprite
        hobbit1 = this.add.sprite(27, 390, 'hobbit1');
        hobbit1.animations.add('left',[11,10,9],3,true);
        hobbit1.animations.add('right',[1,2,3,],3);
        hobbit1.animations.play('left');


        // pass game object to hobbitLoop function
        var that = this;
        //sprite generator and destroy on click
        hobbitLoop(that);

    }
}

function destroySprite (hobbits) {
    hobbits.destroy();
}


function hobbitLoop(that) {

    var cabinet = {
        width:   247,
        height:  319,
        x:  175,
        y:  161
    }

    for (var i = 1; i <= 3; i++) {

        var hobbitX =  (cabinet.x + cabinet.width) - game.cache.getImage('hobbit1').width;
        var hobbitY = rows[game.rnd.integerInRange(0, 3)] + (game.height - cabinet.height);

        var hobbits = that.add.sprite(game.rnd.integerInRange(cabinet.x, hobbitX), (cabinet.y, hobbitY), 'hobbit' + i);
        hobbits.inputEnabled = true;
        hobbits.events.onInputDown.add(destroySprite, this);

        //animated sprites
        hobbits.animations.add('left',[11,10,9],3,true);
        hobbits.animations.add('right',[1,2,3,],3);
        hobbits.animations.play('left');
    }


    console.log('hobbit1 ' + hobbit1.x, hobbit1.y);
    console.log('hobbit ' + i);
    console.log('hobbitX ' + hobbitX);
    console.log('hobbitY ' + hobbitY);

    console.log(cabinet.width);
    console.log(cabinet.height);


}

