   if (this.mapJson.layers[colliderIndex]) {

        var layerData = this.mapJson.layers[colliderIndex].data;
        for (var c = 0; c < this.mapJson.width; c++) {
          var positionX = c * this.dW;
          for (var r = 0; r < this.mapJson.height; r++) {
            // position in pixels
            var positionY = -(r * this.dH);
            let tileIndex = r * this.mapJson.width + c;
            var tile = layerData[tileIndex];

            // occupy space or add the scene change points:
            if (tile !== 0) { // 0 => empty tiles without collision
              // if the tile is a change point has to be empty for every layer.
              if (this.changePoints[tile]) {
                // only create the change point on the main layer:
                if (colliderIndex == this.mainLayer) {
                  var boxShape = new p2.Box({ width: this.dW, height: this.dH });
                  boxShape.color = 17153666;
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
                  boxBody.changeScenePoint = this.changePoints[tile];
                  /*   console.log('CHANGE POINT TILE: ' + tile,
                      'TILEINDEX: ' + tileIndex,
                      'POSITION: X=' + positionX + ' - Y=' + positionY,
                      'NEXT: ' + changePoints[tile],
                      'boxBody.id: ', boxBody.id,
                      'boxBody.changeScenePoint: ', boxBody.changeScenePoint); */
                  boxBody.addShape(boxShape);
                  this.world.addBody(boxBody);
                } // that's why we don't have an else for the main layer condition here.
              } else {
                // create a box to fill the space:
                var boxShape = new p2.Box({ width: this.dW, height: this.dH });
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
                this.world.addBody(boxBody);
              }
            }
          }
        }
      }
