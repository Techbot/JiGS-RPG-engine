// we create the global game object, an instance of Phaser.Game

var game = new Phaser.Game(800, 500, Phaser.AUTO, 'world');

// the first parameter is the key you use to jump between stated
// the key must be unique within the state manager
// the second parameter is the object that contains the state code
// these come from the js files we included in the head tag in the html file
game.state.add('State001', thomas.State001);

game.state.start('State001');
