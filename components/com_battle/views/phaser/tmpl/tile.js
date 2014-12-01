var game = new Phaser.Game(636, 500, Phaser.AUTO, "world");

//All parameters are optional but you usually want to set width and height
//Remember that the game object inherits many properties and methods!

var map;
var layer;
var x;
var y;
var phaser;
var sprite;
var sprite2;
var grid = 1;


game.state.add('next', loadState);
game.state.add('play', playState);

game.state.start('play');


function moveBall(pointer)
{

    //  sprite.reset(pointer.x, pointer.y, 100)

    //   phaser.rotation = game.physics.arcade.accelerateToPointer(phaser, 60, game.input.activePointer, 1000);
    // phaser.x = pointer.x;
    //  phaser.y = pointer.y;


    x = pointer.worldX;
    y = pointer.worldY;

    console.log(x);
    console.log(y);


    //  Give a little boost to velocity
    //sprite.body.velocity.x = 1;
    //sprite.body.velocity.y = 1;

}
function onDragStop () {
    sprite.body.moves = true;
}
function onDragStart(){
    sprite.body.moves = false;
}
