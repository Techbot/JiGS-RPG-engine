///////////////////////////////////////////////////////////////////////////////
//
// https://github.com/damian-pastorini/p2js-tiledmap-demo/blob/master/test-town.html
//
//////////////////////////////////////////////////////////////////////////////
var Bridge = require('../services/bridge.ts');
var p2 = require('p2');

export  async function addLayers(nodeName: any) {
  this.mapJson = loadMaps(nodeName);
  var layerData = this.mapJson.layers[0].data;
  console.log('activated');
  var self = this;
  // world collisions:
  console.log('----------');
  for (var c = 0; c < this.mapJson.width; c++) {
    var positionX = c * 16;
    for (var r = 0; r < this.mapJson.height; r++) {
      // position in pixels
      var positionY = (r * 16);
      let tileIndex = r * this.mapJson.width + c;
      var tile = layerData[tileIndex];
      // occupy space or add the scene change points:
      if (tile !== 0) { // 0 => empty tiles without collision
        // if the tile is a change point has to be empty for every layer.
        // only create the change point on the main layer:
        // create a box to fill the space:
        var boxShape = new p2.Box({ width: 16, height: 16 });
        //boxShape.color = this.colors[colliderIndex];
        boxShape.collisionGroup = this.share.COL_GROUND;
        boxShape.collisionMask = this.share.COL_PLAYER | this.share.COL_ENEMY;
        var bodyConfig = {
          position: [positionX, positionY],
          mass: 1,
          type: p2.Body.STATIC,
          fixedRotation: true
        };
        var boxBody = new p2.Body(bodyConfig);
        boxBody.tile = tile;
        boxBody.tileIndex = tileIndex;
        boxBody.isWall = true;
        boxBody.addShape(boxShape);
      }
    }
  }
}

function loadMaps(nodeName: string) {
  var cityName = nodeName.split("-")[0];
  var cityNumber = nodeName.split("-")[1];
  try {
    const data = require(`../../../../../assets/cities/` + cityName + `/json/` + cityNumber + `.json`);
    return data;
  } catch (err) {
    console.log(err);
    console.log('shit');
  }
}
