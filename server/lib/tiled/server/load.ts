var p2 = require('p2');

//const Bridge = require("../services/bridge.js");

export default class LoadMap  {
  speed: number;
  yo: any;



  constructor(yo:any) {
    this.speed = 200;
    console.log(yo);
//this.yo = yo;

  }


loadTiles(fuck:any){

console.log(fuck);


/*   const world = new p2.World({ gravity: [0, 0] });
  //this.setWorld(world);
  var colors = { '6': 14153173, '7': 15153173, '8': 12153173, '9': 16701904 };
  var squareSize = 1; // 32;
  var speedMultiplier = 1; // 20;

  var share = {
    SPEED: (10 * speedMultiplier),
    // collisions:
    COL_PLAYER: Math.pow(2, 0),
    COL_ENEMY: Math.pow(2, 1),
    COL_GROUND: Math.pow(2, 2)
  };

  var tileW = 1 * squareSize, tileH = 1 * squareSize;
  let playerShape = new p2.Box({ width: tileW, height: tileH });
  playerShape.collisionGroup = share.COL_PLAYER;
  playerShape.collisionMask = share.COL_ENEMY | share.COL_GROUND;

  let playerBody = new p2.Body({
    mass: 1,
    position: [9 * squareSize, -9 * squareSize],
    type: p2.Body.DYNAMIC,
    fixedRotation: true
  });

  playerBody.isPlayer = true;
  playerBody.collideWorldBounds = true;
  playerBody.addShape(playerShape);
  world.addBody(playerBody); */

  // Key controls
  var keys = {
    '37': 0, // left
    '39': 0, // right
    '38': 0, // up
    '40': 0 // down
  };

/*   this.on('keydown', function (evt) {
  // console.log(evt.keyCode);
    playerBody.velocity = [0, 0];
    if (evt.keyCode == 37) {
      playerBody.velocity[0] = -share.SPEED;
    }
    if (evt.keyCode == 39) {
      playerBody.velocity[0] = share.SPEED;
    }
    if (evt.keyCode == 38) {
      playerBody.velocity[1] = share.SPEED;
    }
    if (evt.keyCode == 40) {
      playerBody.velocity[1] = -share.SPEED;
    }
  }); */

/*   this.on('keyup', function (evt) {
    playerBody.velocity = [0, 0];
  }); */


/*   world.on('endContact', function (evt:any) {
    var bodyA = evt.bodyA, bodyB = evt.bodyB;

    if (bodyA.isPlayer) {
      console.log('endContact! --------------------------------------------------------------');
      console.log('BODY A is the player!', bodyA.isPlayer, bodyA.id);
      console.log('BODY B is the wall!', bodyB.isWall, bodyB.id, (bodyB.changeScenePoint ? ' > ' + bodyB.changeScenePoint : 'NCP'), bodyB.position);
      console.log('BODY B TILE / TILEINDEX: ', bodyB.tile, bodyB.tileIndex);
      bodyA.velocity = [0, 0];
    } else {
      console.log('endContact! --------------------------------------------------------------');
      console.log('BODY A is the wall!', bodyA.isWall, bodyA.id, (bodyA.changeScenePoint ? ' > ' + bodyA.changeScenePoint : 'NCP'), bodyA.position);
      console.log('BODY B is the player!', bodyB.isPlayer, bodyB.id);
      console.log('BODY A TILE / TILEINDEX: ', bodyA.tile, bodyA.tileIndex);
      bodyB.velocity = [0, 0];
    }
    console.log('----- endContact END.');
  }); */






















 }
}
