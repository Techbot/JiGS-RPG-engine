// defining a single global object (zombies_from_outer_space) and adding some functions in to its prototype (eg preload, create functions)

var zombies_from_outer_space = {};
var cursors;
var player;
var fire;
var text;
var counter = 0;
var x = 27;
var y = 390;
var bob;
var bobhead;
var bobbody;
var result = 'Click a body';
var title;
var arm;

zombies_from_outer_space.State001 = function (game) {


};

zombies_from_outer_space.State001.prototype = {

    preload: function () {
        //  The second parameter is the URL of the image (relative)
        game.load.image('bg', 'zombies_from_space-bg.jpg');
        game.load.spritesheet('fighter01',
            '/components/com_battle/images/assets/chars/halflings/001-Fighter01-Noble.png', 32, 48, 16);

        game.load.spritesheet('light7',
            '/components/com_battle/images/assets/animations/Light7.png', 192, 160, 30);

        game.load.atlas('spritesheet', 'zombies_from_space-sprite-min.png', 'sprite.json');
        game.load.atlas('spritesheet2', 'cityand-arm.png', 'sprite2.json');

        game.load.atlas('hand', 'hand.png', 'hand.json');
        // this creates the sprite object  ('myObjectName','/path/to/file.png')
        game.load.image('bob', 'bob-head.png');

        //this creates the json object and loads the json file respctively ('myObjectName','json file')
        // in our case, our object has the same name as the json file eg ('bob-head', 'bob-head.json')
        //game.load.physics('physicsData', 'bob-head.json');
    },


    create: function () {

        cursors = game.input.keyboard.createCursorKeys();
        //  Enable p2 physics
        game.physics.startSystem(Phaser.Physics.P2JS);

        //  This creates a simple sprite that is using our loaded image and
        //  displays it on-screen and assign it to a variable
        var image = game.add.sprite(0, 0, 'bg');
        //game.add.sprite(14, 8, 'spritesheet', 'title');

        //title.scale.x = 40;
        //title.scale.y = 40;

        game.add.sprite(440, 20, 'spritesheet', 'pyramid');
        game.add.sprite(14, 164, 'spritesheet', 'couple');
        game.add.sprite(314, 8, 'spritesheet', 'metropolis');
        game.add.sprite(381, 11, 'spritesheet', 'hand');
        game.add.sprite(160, 320, 'spritesheet', 'dave');

        arm = game.add.sprite(305, 240, 'spritesheet2', 'arm');

        bobbody = game.add.sprite(396, 285, 'spritesheet', 'bobbody');
        // this is using bob's head from the spritesheet (like all above)

        bobhead = game.add.sprite(412, 237, 'spritesheet', 'bobhead');

        // this refers to the sprite object created above (alternative to using spritesheet)
        bob = game.add.sprite(412, 237, 'bob');

        // game.add.sprite(381, 11, 'hand', 'hand-whole.png');

        player = game.add.sprite(x, y, 'fighter01');
        // this enables physics on the sprite objects

        game.physics.p2.enable([player, bob], false);
        var constraint = game.physics.p2.createRevoluteConstraint(bob, [200, 0], player, [0, 0]);

        // this relates the shape to the object ('jsonShapeObject','jsonObject')
        //bobbody.body.clearShapes();
        //bobbody.body.loadPolygon('physicsData','bob-body');
        // this relates the shape to the object ('jsonShapeObject','jsonObject')
        //bobhead.body.clearShapes();
        //bobhead.body.loadPolygon('physicsData','bob-head');

        game.physics.p2.gravity.y = 20;
        game.physics.p2.gravity.x = 1;
        //game.physics.p2.restitution = 1.6;

        //player.body.enable = true;
        //obj003 = game.add.sprite(391, 72, 'spritesheet', 'couple');
        //  Moves the image anchor to the middle, so it centers inside the game properly
        //image.anchor.set(0.5);
        //  Enables all kind of input actions on this image (click, etc)
        arm.inputEnabled = true;
        text = game.add.text(250, 16, '', {fill: '#ffffff'});
        arm.events.onInputDown.add(listener, this);
        fire = game.add.sprite(279, 11, 'light7');

        fire.animations.add('warm', [0, 1, 2, 3], 4, true);
        fire.animations.play('warm', 4, true);

        player.animations.add('left', [4, 5, 6, 7], 4, true);
        player.animations.add('up', [12, 13, 14, 15], 4, true);
        player.animations.add('down', [0, 1, 2, 3], 4, true);
        player.animations.add('right', [8, 9, 10, 11], 4, true);

        //player.body.fixedRotation = true;
        //player.body.damping = 0.5;
    },
    render: function () {
        game.debug.text(result, 32, 32);
    },
    update: function () {
        if (game.input.activePointer.isDown) {
            arm.angle += 1;
        }
        if (cursors.left.isDown) {
            arm.angle += 1;
            player.animations.play('left', 4, true);
            player.body.moveLeft(300);
            x--;
        }
        if (cursors.right.isDown) {
            player.animations.play('right', 4, true);
            player.body.moveRight(300);
            x++;
        }
        if (cursors.up.isDown) {
            player.animations.play('up', 4, true);
            //  player.body.moveUp(300);
            //  y--;
        }
        if (cursors.down.isDown) {
            player.body.moveDown(300);
            player.animations.play('down', 4, true);
            y++;
        }
        //  player.body.velocity.x = 0;
        //  player.body.velocity.y = 0;
        player.animations.stop();
    }
}
/*
 var game = new Phaser.Game(640, 480, Phaser.CANVAS, 'world', {
 preload: preload, create: create , update:update, render:render
 });
 */

function listener () {

    game.input.onDown.add(wobble, this);

}

function wobble(){
    arm.angle += 1;
}

function jump(){
    console.log('hi');

    alert ('jump');
}

function click(pointer) {

    //	You can hitTest against an array of Sprites, an array of Phaser.Physics.P2.Body objects, or don't give anything
    //	in which case it will check every Body in the whole world.

    var bodies = game.physics.p2.hitTest(pointer.position, [ bobhead, bobbody, player ]);

    if (bodies.length === 0)
    {
        result = "You didn't click a Body";
    }
    else
    {
        result = "You clicked: ";

        for (var i = 0; i < bodies.length; i++)
        {
            //	The bodies that come back are p2.Body objects.
            //	The parent property is a Phaser.Physics.P2.Body which has a property called 'sprite'
            //	This relates to the sprites we created earlier.
            //	The 'key' property is just the texture name, which works well for this demo but you probably need something more robust for an actual game.
            result = result + bodies[i].parent.sprite.key;

            if (i < bodies.length - 1)
            {
                result = result + ', ';
            }
        }
    }
}
