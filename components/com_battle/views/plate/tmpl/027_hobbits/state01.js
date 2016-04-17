// defining a single global object (hobbits) and adding some functions in to its prototype (eg preload, create functions)

var hobbits = {};

var rows = [
    223, 271, 319, 367, 415
];

var hobbit1;
var cabinet;
var repeat = 10;

hobbits.State001 = function (game) {

};

hobbits.State001.prototype = {

    preload: function () {

        this.load.image('bg', 'get-your-halfling.jpg');
        this.load.spritesheet('hobbit1',
            '/var/www/html/JiGS/components/com_battle/images/assets/chars/halflings/001-Fighter01.png',32,48,16);
        this.load.spritesheet('hobbit2',
            '/var/www/html/JiGS/components/com_battle/images/assets/chars/halflings/002-Fighter02.png',32,48,16);
        this.load.spritesheet('hobbit3',
            '/var/www/html/JiGS/components/com_battle/images/assets/chars/halflings/003-Fighter03.png',32,48,16);
        this.load.spritesheet('hobbit4',
            '/var/www/html/JiGS/components/com_battle/images/assets/chars/halflings/004-Fighter04.png',32,48,16);

    },

    create: function () {

        bg = this.add.sprite(0, 0, 'bg');
        bg.anchor.setTo(0,0);

        hobbit1 = this.add.sprite( 0, 0, 'hobbit1' );
        hobbit1.anchor.setTo(0, 0);

        cabinet = {
            width:   247,
            height:  319,
            x:  175,
            y:  161
        }

        cabinet.boundsX = cabinet.width + cabinet.x - hobbit1.width;
        cabinet.boundsY = cabinet.height + cabinet.y - hobbit1.height;


        //animated sprite


        var cabinetRows = rows[game.rnd.integerInRange(0, 3)];
        hobbit1 = this.add.sprite(game.rnd.integerInRange(cabinet.x, cabinet.boundsX), cabinetRows, 'hobbit1');

        hobbit1.animations.add('front',[0,1,2,3], 4, true);
        hobbit1.animations.add('left',[4,5,6,7], 4, true);
        hobbit1.animations.add('right',[8,9,10,11],4, true);
        hobbit1.animations.add('back',[12,13,14,15],4);
        hobbit1.animations.play('left', 5, true);


        //var hobbit1X =  (cabinet.x + cabinet.width) - game.cache.getImage('hobbit1').width;
        //var hobbit1Y = rows[game.rnd.integerInRange(0, 3)] + (game.height - cabinet.height);

        //var hobbit1 = this.add.sprite(game.rnd.integerInRange(cabinet.x, hobbit1X), (cabinet.y, hobbit1Y));

        hobbit1.inputEnabled = true;
        this.physics.enable(hobbit1, Phaser.Physics.ARCADE);
        hobbit1.body.enable = true;
        hobbit1.events.onInputDown.add(destroySprite, this);


        console.log('hobbit1 ' + hobbit1.x, hobbit1.y);
        console.log('hobbit1 width ' + hobbit1.width);
        console.log('hobbit1 height ' + hobbit1.height);
        console.log('hobbit1 x ' + hobbit1.x);
        console.log('hobbit1 y ' + hobbit1.y);

        console.log('cabinet row ' + cabinetRows);
        console.log('cabinet width ' + cabinet.width);
        console.log('cabinet height ' + cabinet.height);
        console.log('cabinet x ' + cabinet.x);
        console.log('cabinet y ' + cabinet.y);
        console.log('cabinet bounds ' + cabinet.boundsX + ',' + cabinet.boundsY);

        // pass game object to hobbitLoop function
        //var that = this;
        //sprite generator and destroy on click
        //hobbitLoop(that);

    },

    update: function() {


        if (this.input.keyboard.isDown(Phaser.Keyboard.LEFT))
        {
            //hobbit1.x -= 4;
            hobbit1.animations.play('left', 5, true);

            //this.physics.arcade.moveToXY(
           //     hobbit1,
           //     hobbit1.body.x - 70, // target x position
           //     Phaser.Math.snapTo(hobbit1.body.y, 70), // keep y position the same as we are moving along x axis
          //      250 // velocity to move at
           // )

            var tween = this.add.tween(hobbit1).to({
                x: [cabinet.x, cabinet.boundsX]
            }, 1000, Phaser.Easing.Linear.Out, true);

            //	This tween will loop 10 times, calling this function every time it loops
            tween.onLoop.add(onLoop, this);

            console.log('hobbit x ' + hobbit1.x);
        }
        else if (this.input.keyboard.isDown(Phaser.Keyboard.RIGHT))
        {
            hobbit1.x += 4;
            hobbit1.animations.play('right', 5, true);

            console.log('hobbit x ' + hobbit1.x);
        }



    },

    render: function () {

        game.debug.text('Repeat: ' + repeat, 32, 32);

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


function onLoop() {

    repeat--;

    if (hobbit1.frame === 5)
    {
        hobbit1.frame = 0;
    }
    else
    {
        hobbit1.frame++;
    }

}