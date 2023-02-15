import Phaser from 'phaser'
import { Scene } from 'phaser'
import { useCounterStore } from '@/stores/counter'
import { reactive } from 'vue'


export default class PlayScene extends Scene {
  constructor () {
    super({
       key: 'PlayScene',
      })
  }

  preload (){
    this.counter = useCounterStore()

    this.load.spritesheet('brawler', 'images/Sprites/4351.png', { frameWidth: 64, frameHeight: 64 })

    this.load.image('sky', '../images/sky.png');

    this.load.image('ship', '../images/spaceShips_001.png');
    this.load.image('otherPlayer', '../images/enemyBlack5.png');
    this.load.image('star', '../images/star_gold.png');
    this.load.tilemapTiledJSON('map', '../images/' + this.counter.userMapGrid + '.json');

    this.load.image('celianna_TileA1', '../images/Basic Tiles/celianna_TileA1.png');
    this.load.image('celianna_TileA2', '../images/Basic Tiles/celianna_TileA2.png');
    this.load.image('celianna_TileA5', '../images/Basic Tiles/celianna_TileA5.png');

    this.load.image('TileA1', '../images/System/TileA1.png');
    this.load.image('TileA2', '../images/System/TileA2.png');
    this.load.image('TileA3', '../images/System/TileA3.png');
    this.load.image('TileA4', '../images/System/TileA4.png');
    this.load.image('TileA5', '../images/System/TileA5.png');
    this.load.image('TileB', '../images/System/TileB.png');
    this.load.image('TileC', '../images/System/TileC.png');
    this.load.image('TileD', '../images/System/TileD.png');
    this.load.image('TileE', '../images/System/TileE.png');
    this.load.image('TileF', '../images/System/TileF.png');
    this.load.image('Tile001', '../images/System/001.png');

    this.load.image('doors1', '../images/Characters/!doors1.png');

}
  create () {

      /////////////////////////////////////////////////////////////////////
  this.add.image(400, 300, 'sky');
  this.socket = io.connect('https://www.eclecticmeme.com:8082');
  this.players = this.add.group();
  this.cameras.main.zoom = 1.25;

  this.blueScoreText = this.add.text(16, 16, '', { fontSize: '32px', fill: '#0000FF' });
  this.redScoreText = this.add.text(384, 16, '', { fontSize: '32px', fill: '#FF0000' });

  var self = this;

  this.socket.on('currentPlayers', function (players) {
    Object.keys(players).forEach(function (id) {
      if (players[id].playerId === self.socket.id) {
        displayPlayers(self, players[id], 'brawler');

      } else {
        displayPlayers(self, players[id], 'otherPlayer');
      }
    });
  });

  this.socket.on('newPlayer', function (playerInfo) {
    displayPlayers(self, playerInfo, 'otherPlayer');
  });

  this.socket.on('disconnect2', function (playerId) {
    self.players.getChildren().forEach(function (player) {
      if (playerId === player.playerId) {
        player.destroy();
      }
    });
  });

/*   this.input.on('pointermove', function (pointer) {
    Object.keys(self.players).forEach(function (id) {
      self.players.getChildren().forEach(function (player) {
        if (self.players[id].playerId === player.playerId) {
         this.physics.moveToObject(player, pointer, 240);

        }
      });
    });
  }); */

  this.socket.on('playerUpdates', function (players) {
    Object.keys(players).forEach(function (id) {
      self.players.getChildren().forEach(function (player) {
        if (players[id].playerId === player.playerId) {

          player.setRotation(players[id].rotation);
          player.setPosition(players[id].x, players[id].y);

          if (players[id].playerId === self.socket.id) {
            console.log('yo');
          }
        }
      });
    });
  });

  this.socket.on('updateScore', function (scores) {
    self.blueScoreText.setText('Blue: ' + scores.blue);
    self.redScoreText.setText('Red: ' + scores.red);
  });

  this.socket.on('starLocation', function (starLocation) {
    if (!self.star) {
      self.star = self.add.image(starLocation.x, starLocation.y, 'star');
    } else {
      self.star.setPosition(starLocation.x, starLocation.y);
    }
  });

  this.cursors = this.input.keyboard.createCursorKeys();
  this.leftKeyPressed = false;
  this.rightKeyPressed = false;
  this.upKeyPressed = false;
  this.downKeyPressed = false;

////////////////////////////////////////////////////////////////////////////////

   // Animation set
        this.anims.create({
            key: 'walk',
            frames: this.anims.generateFrameNumbers('brawler', { frames: [ 130, 131, 132, 133, 134, 135, 136,137,138] }),
            frameRate: 8,
            repeat: -1
        });

        this.anims.create({
            key: 'kick',
            frames: this.anims.generateFrameNumbers('brawler', { frames: [ 10, 11, 12, 13, 10 ] }),
            frameRate: 8,
            repeat: -1,
            repeatDelay: 2000
        });


////////////////////////////////////////////////////////////////////////////////
    //console.log(this.cache.tilemap.entries)
    // When loading a CSV map, make sure to specify the tileWidth and tileHeight
    var map = this.make.tilemap({ key: 'map', tileWidth: 32, tileHeight: 32 });

    var tileset1 = map.addTilesetImage('TileA1');
    var tileset2 = map.addTilesetImage('TileA2');
    var tileset3 = map.addTilesetImage('TileA3');
    var tileset4 = map.addTilesetImage('TileA4');
    var tileset5 = map.addTilesetImage('TileA5');
    var tileset6 = map.addTilesetImage('TileB');
    var tileset7 = map.addTilesetImage('TileC');
    var tileset8 = map.addTilesetImage('TileD');
    var tileset9 = map.addTilesetImage('TileE');
    var tileset10 = map.addTilesetImage('TileF');
    var tileset11 = map.addTilesetImage('celianna_TileA1');
    var tileset12 = map.addTilesetImage('celianna_TileA2');
    var tileset13 = map.addTilesetImage('celianna_TileA5');
    var tileset14 = map.addTilesetImage('doors1');

    //layer.skipCull = true;

    map.createLayer('Tile Layer 1', [ tileset1,tileset2, tileset4, tileset5, tileset11, tileset12, tileset13 ]);
    // map.createLayer('Tile Layer 2', [ tileset1,tileset2, tileset3, tileset4, tileset5  ]);
    // create the layers we want in the right order
    map.createStaticLayer('Tile Layer 2', [ tileset1,tileset2, tileset3, tileset4, tileset5  ])

    map.createLayer('Tile Layer 3', [ tileset8, tileset2, tileset9, tileset14 ]);

    this.cameras.main.setBounds(0, 0, map.widthInPixels, map.heightInPixels);

    var cursors = this.input.keyboard.createCursorKeys();

    var controlConfig = {
        camera: this.cameras.main,
        left: cursors.left,
        right: cursors.right,
        up: cursors.up,
        down: cursors.down,
        speed: 0.5
    };

    var controls = new Phaser.Cameras.Controls.FixedKeyControl(controlConfig);

    var help = this.add.text(16, 16, 'Arrow keys to scroll', {
        fontSize: '18px',
        fill: '#ffffff'
    });

    help.setScrollFactor(0);

    var gui = new dat.GUI();

    var cam = this.cameras.main;

    cam.setBounds(0, 0, 4096, 4096);

    gui.addFolder('Camera');
    gui.add(cam, 'dirty').listen();
    gui.add(cam.midPoint, 'x').listen();
    gui.add(cam.midPoint, 'y').listen();
    gui.add(cam, 'scrollX').listen();
    gui.add(cam, 'scrollY').listen();

    //this.add.image(400, 300, 'sky');

    this.blueScoreText = this.add.text(16, 16, '', { fontSize: '32px', fill: '#0000FF' });
    this.blueScoreText.setText('Blue: ' +  this.counter.Blobby + ' Building:' + this.counter.gameState + ' Map:' + this.counter.userMapGrid);

/*     const bomb = this.physics.add.image(400, 200, 'bomb')
    bomb.setCollideWorldBounds(true)
    bomb.body.onWorldBounds = true // enable worldbounds collision event
    bomb.setBounce(1)
    bomb.setVelocity(200, 20)
    this.sound.add('thud')
    this.physics.world.on('worldbounds', () => {
      this.sound.play('thud', { volume: 0.75 })
    }) */





  }

  update () {

  const left = this.leftKeyPressed;
  const right = this.rightKeyPressed;
  const up = this.upKeyPressed;
  const down = this.downKeyPressed;

  if (this.cursors.left.isDown) {
    this.leftKeyPressed = true;
  } else if (this.cursors.right.isDown) {
    this.rightKeyPressed = true;
  } else {
    this.leftKeyPressed = false;
    this.rightKeyPressed = false;
  }

  if (this.cursors.up.isDown) {
    this.upKeyPressed = true;
  } else if (this.cursors.down.isDown){
    this.downKeyPressed = true;
  } else {
    this.upKeyPressed = false;
    this.downKeyPressed = false;
  }


  if (left !== this.leftKeyPressed || right !== this.rightKeyPressed || up !== this.upKeyPressed || down!==this.downKeyPressed) {
    this.socket.emit('playerInput', { left: this.leftKeyPressed , right: this.rightKeyPressed, up: this.upKeyPressed, down: this.downKeyPressed });
  }
    this.blueScoreText.setText('Blue: ' +  this.counter.Blobby + ' Building:' + this.counter.gameState + ' Map:' + this.counter.userMapGrid);
  }
}





  function displayPlayers(self, playerInfo, sprite) {


////////////////////////////////////////////////////////////////////////////////

    const player = self.physics.add.sprite(playerInfo.x, playerInfo.y, sprite).setOrigin(0.5, 0.5).setDisplaySize(53, 40);

    if (playerInfo.playerId === self.socket.id) {

        player.setScale(.75);
        player.play('walk');
        console.log(playerInfo.playerId );
        player.setCollideWorldBounds(true);
        self.cameras.main.startFollow(player);
      }

////////////////////////////////////////////////////////////////////////////////

/* if (playerInfo.team === 'blue') player.setTint(0x0000ff);
  else player.setTint(0xff0000); */


  player.playerId = playerInfo.playerId;
  self.players.add(player);

}
