//const Bridge2 = require ('./services/bridge.js');
//const drupalBridge = require('./services/bridge.js');
  console.log('-----------------------------------------');
const players = {};

const config = {
    type: Phaser.HEADLESS,
  parent: 'phaser-example',
  width: 800,
  height: 400,
  physics: {
    default: 'arcade',
    arcade: {
      debug: false,
      gravity: { y: 0 }
    }
  },
  scene: {
    preload: preload,
    create: create,
    update: update
  },
  autoFocus: false
};

  function preload() {
   //  this.load.plugin('RandomNamePlugin', './js/RandomNamePlugin.js', true);
  //this.load.image('ship', 'assets/spaceShips_001.png');
  //this.load.image('star', 'assets/star_gold.png');
}

function create() {
  window.mapJump(1,2)
  //console.log(Result);

 // let plugin = this.plugins.get('RandomNamePlugin');
 // let names = plugin.getNames(10);
 // console.log(names);

  const self = this;
  this.players = this.physics.add.group();

  this.scores = {
    blue: 0,
    red: 0
  };

  this.star = this.physics.add.image(randomPosition(600), randomPosition(400), 'star');
  this.physics.add.collider(this.players);

  this.physics.add.overlap(this.players, this.star, function (star, player) {
    if (players[player.playerId].team === 'red') {
      self.scores.red += 10;
    } else {
      self.scores.blue += 10;
    }



    self.star.setPosition(randomPosition(400), randomPosition(400));
    io.emit('updateScore', self.scores);
    io.emit('starLocation', { x: self.star.x, y: self.star.y });
  });

  io.on('connection', function (socket) {
    console.log('a user connected');
    // create a new player and add it to our players object
    players[socket.id] = {
      rotation: 0,
      x: Math.floor(Math.random() * 600) + 50,
      y: Math.floor(Math.random() * 400) + 50,
      playerId: socket.id,
      team: (Math.floor(Math.random() * 2) == 0) ? 'red' : 'blue',
      input: {
        left: false,
        right: false,
        up: false,
        down: false
      }
    };
    // add player to server
    addPlayer(self, players[socket.id]);
    // send the players object to the new player
    socket.emit('currentPlayers', players);
    // update all other players of the new player
    socket.broadcast.emit('newPlayer', players[socket.id]);
    // send the star object to the new player
    socket.emit('starLocation', { x: self.star.x, y: self.star.y });
    // send the current scores
    socket.emit('updateScore', self.scores);

    socket.on('disconnect', function () {
      console.log('user disconnected');
      // remove player from server
      removePlayer(self, socket.id);
      // remove this player from our players object
      delete players[socket.id];
      // emit a message to all players to remove this player
      io.emit('disconnect2', socket.id);
    });

    // when a player moves, update the player data
    socket.on('playerInput', function (inputData) {
      handlePlayerInput(self, socket.id, inputData);
    });
  });
}

function update() {
  this.players.getChildren().forEach((player) => {
    const input = players[player.playerId].input;
    if (input.left) {
    //  player.setAngularVelocity(-300);
    player.x = player.x - 10;
    }
    else if (input.right) {
    //  player.setAngularVelocity(300);
    player.x = player.x + 10;
    } else {
      player.setAngularVelocity(0);
    }
    if (input.up) {
    player.y = player.y - 10;
    }
    else if (input.down) {
      player.y = player.y + 10;
    }
////////////////////////////////////////////////////
   if (player.x > 1900){
          player.x  = 1900;
    }
    if (player.x < 0 ){
          player.x  = 0;
    }
   if (player.y > 1250){
          player.y  = 1250;
    }
    if (player.y < 0 ){
          player.y  = 0;
    }
////////////////////////////////////////////////////
    players[player.playerId].x = player.x;
    players[player.playerId].y = player.y;
    players[player.playerId].rotation = player.rotation;
  });
 // this.physics.world.wrap(this.players, 5);
  io.emit('playerUpdates', players);
}

function randomPosition(max) {
  return Math.floor(Math.random() * max) + 50;
}

function handlePlayerInput(self, playerId, input) {
  self.players.getChildren().forEach((player) => {
    if (playerId === player.playerId) {
      players[player.playerId].input = input;
    }
  });
}

function addPlayer(self, playerInfo) {
  const player = self.physics.add.image(playerInfo.x, playerInfo.y, 'ship').setOrigin(0.5, 0.5).setDisplaySize(53, 40);
  player.setDrag(100);
  player.setAngularDrag(100);
  player.setMaxVelocity(200);
  player.playerId = playerInfo.playerId;
  self.players.add(player);
}

function removePlayer(self, playerId) {
  self.players.getChildren().forEach((player) => {
    if (playerId === player.playerId) {
      player.destroy();
    }
  });
}
//const game = new Phaser.Game(config);
window.gameLoaded();


window.game = new Phaser.Game(config);
