// defining a single global object (hobbits) and adding some functions in to its prototype (eg preload, create functions)

var hobbits = {};

var rows = [
    170, 230, 290, 350, 410
];

var cabinet;
var offset = 10;
var repeat = 10;

hobbits.State001 = function (game) {

};

hobbits.State001.prototype = {

    preload: function () {

        this.load.image('bg', 'get-your-halfling.jpg');
        this.load.image('head', 'head.png');
        this.load.image('cabinetFront', 'cabinet-front.png');
        this.load.spritesheet('hobbit1','/components/com_battle/images/assets/chars/halflings/001-Fighter01.png',32,48,16);
        //this.load.spritesheet('hobbit2','/components/com_battle/images/assets/chars/halflings/002-Fighter02.png',32,48,16);
        //this.load.spritesheet('hobbit3','/components/com_battle/images/assets/chars/halflings/003-Fighter03.png',32,48,16);
        //this.load.spritesheet('hobbit4', '/components/com_battle/images/assets/chars/halflings/004-Fighter04.png',32,48,16);
    },

    create: function () {

        bg = this.add.sprite(0, 0, 'bg');
        bg.anchor.setTo(0,0);
        head = this.add.sprite(79, 16, 'head');
        cabinet = {
            width:   249,
            height:  325,
            x:  200,
            y:  165
        }

        hobbit1 = this.add.sprite(cabinet.x + offset, cabinet.y + offset, 'hobbit1');
        hobbit1.anchor.setTo(0, 0);

        cabinet.boundsX = cabinet.width + cabinet.x - hobbit1.width;
        cabinet.boundsY = cabinet.height + cabinet.y - hobbit1.height;

        //animated sprite

        var cabinetRows = rows[game.rnd.integerInRange(0, 3)];

        hobbit1.animations.add('down',[0,1,2,3], 4, true);
        hobbit1.animations.add('left',[4,5,6,7], 4, true);
        hobbit1.animations.add('right',[8,9,10,11], 4, true);
        hobbit1.animations.add('up',[12,13,14,15], 4, true);
        hobbit1.animations.play('front', 4, true);

        var hobbit1Row = rows[game.rnd.integerInRange(0, 3)] + (game.height - cabinet.height);


        hobbit1.inputEnabled = true;
        this.physics.enable(hobbit1, Phaser.Physics.ARCADE);
        hobbit1.body.enable = true;
        hobbit1.events.onInputDown.add(destroySprite, this);

        console.log('hobbit1: ' + hobbit1.x, hobbit1.y);
        console.log('hobbit1 width: ' + hobbit1.width);
        console.log('hobbit1 height: ' + hobbit1.height);
        console.log('hobbit1 x: ' + hobbit1.x);
        console.log('hobbit1 y: ' + hobbit1.y);

        console.log('cabinet row: ' + cabinetRows);
        console.log('cabinet width: ' + cabinet.width);
        console.log('cabinet height: ' + cabinet.height);
        console.log('cabinet x: ' + cabinet.x);
        console.log('cabinet y: ' + cabinet.y);
        console.log('cabinet bounds: ' + cabinet.boundsX + ',' + cabinet.boundsY);

        // pass game object to hobbitLoop function
        //var that = this;
        //sprite generator and destroy on click
        //hobbitLoop(that);
    },

    update: function() {

        if (hobbit1.x <= cabinet.boundsX ) {

            if (this.input.keyboard.isDown(Phaser.Keyboard.LEFT)) {
                hobbit1.x -= 4;
                var hobbit1X = hobbit1.x;
                hobbit1.animations.play('left', 4, true);
            }

            else if (this.input.keyboard.isDown(Phaser.Keyboard.RIGHT)) {
                hobbit1.animations.play('right', 4, true);
                hobbit1.x += 4;
            }
        }

        if (hobbit1.x >= cabinet.x ) {

            if (this.input.keyboard.isDown(Phaser.Keyboard.LEFT)) {
                hobbit1.x -= 4;
                hobbit1.animations.play('left', 4, true);
            }

            else if (this.input.keyboard.isDown(Phaser.Keyboard.RIGHT)) {
                hobbit1.animations.play('right', 4, true);
                hobbit1.x += 4;
            }

        }
        /*
        else if (this.input.keyboard.isDown(Phaser.Keyboard.UP)) {
            hobbit1.animations.play('up', 4, true);
        }
        else if (this.input.keyboard.isDown(Phaser.Keyboard.DOWN)) {
            //hobbit1.x += 4;
            hobbit1.animations.play('down', 4, true);
        }*/
    },

    render: function () {
        game.debug.text('Repeat: ' + repeat, 32, 32);
    }

}


function destroySprite (hobbits) {
    hobbits.destroy();
}


function hobbitLoop(that) {

    cabinet = {
        width:   249,
        height:  325,
        x:  200,
        y:  165
    }

    for (var i = 1; i <= 3; i++) {

        var hobbitX =  (cabinet.x + cabinet.width) - game.cache.getImage('hobbit1').width;
        var hobbitY = rows[game.rnd.integerInRange(0, 3)] + (game.height - cabinet.height);

        var hobbits = that.add.sprite(game.rnd.integerInRange(cabinet.x, hobbitX), (cabinet.y, hobbitY), 'hobbit' + i);
        hobbits.inputEnabled = true;
        hobbits.events.onInputDown.add(destroySprite, this);

        //animated sprites
        hobbit1.animations.add('down',[0,1,2,3], 4, true);
        hobbit1.animations.add('left',[4,5,6,7], 4, true);
        hobbit1.animations.add('right',[8,9,10,11], 4, true);
        hobbit1.animations.add('up',[12,13,14,15], 4, true);
        hobbit1.animations.play('front', 4, true);
    }

    console.log('hobbit1: ' + hobbit1.x, hobbit1.y);
    console.log('hobbit: ' + i);
    console.log('hobbitX: ' + hobbitX);
    console.log('hobbitY: ' + hobbitY);

    console.log(cabinet.width);
    console.log(cabinet.height);

}


function onLoop() {

    repeat--;

    if (hobbit1.frame === 5) {
        hobbit1.frame = 0;
    }
    else {
        hobbit1.frame++;
    }

}