var tileset;
var stage;
var mapData;

window.onload = function()
{
	// json map data at the end of this file for ease of understanding (created on Tiled map editor)
	mapData = mapDataJson;

	// uncomment this to a second example
	//mapData = mapData2;
	
	// creating EaselJS stage
	stage = new createjs.Stage("canvas");
	// create EaselJS image for tileset
	tileset = new Image();
	// getting imagefile from first tileset
	tileset.src = mapData.tilesets[0].image;
	// callback for loading layers after tileset is loaded
	tileset.onLoad = initLayers();
}

// loading layers
function initLayers() {
	// compose EaselJS tileset from image (fixed 64x64 now, but can be parametized)
	var w = mapData.tilesets[0].tilewidth;
	var h = mapData.tilesets[0].tileheight;
	var imageData = {
		images : [ tileset ],
		frames : {
			width : w,
			height : h
		}
	};
	// create spritesheet
	var tilesetSheet = new createjs.SpriteSheet(imageData);
	
	// loading each layer at a time
	for (var idx = 0; idx < mapData.layers.length; idx++) {
		var layerData = mapData.layers[idx];
		if (layerData.type == 'tilelayer')
			initLayer(layerData, tilesetSheet, mapData.tilewidth, mapData.tileheight);
	}
	// stage updates (not really used here)
	createjs.Ticker.setFPS(20);
	createjs.Ticker.addListener(stage);
}

// layer initialization
function initLayer(layerData, tilesetSheet, tilewidth, tileheight) {
	for ( var y = 0; y < layerData.height; y++) {
		for ( var x = 0; x < layerData.width; x++) {
			// create a new Bitmap for each cell
			var cellBitmap = new createjs.BitmapAnimation(tilesetSheet);
			// layer data has single dimension array
			var idx = x + y * layerData.width;
			// tilemap data uses 1 as first value, EaselJS uses 0 (sub 1 to load correct tile)
			cellBitmap.gotoAndStop(layerData.data[idx] - 1);
			// isometrix tile positioning based on X Y order from Tiled
			//cellBitmap.x = 300 + x * tilewidth/2 - y * tilewidth/2;
			//cellBitmap.y = y * tileheight/2 + x * tileheight/2;
			
			cellBitmap.x = x * tilewidth;
			cellBitmap.y = y * tileheight;
			
			
			
			// add bitmap to stage
			stage.addChild(cellBitmap);
		}
	}
}

// utility function for loading assets from server
function httpGet(theUrl) {
	var xmlHttp = null;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET", theUrl, false);
	xmlHttp.send(null);
	return xmlHttp.responseText;
}

// utility function for loading json data from server
function httpGetData(theUrl) {
	var responseText = httpGet(theUrl);
	return JSON.parse(responseText);
}


// Map data created on Tiled map editor (mapeditor.org). Use export for JSON format
var mapDataJson = { "height":10,
 "layers":[
        {
         "data":[2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 70, 70, 70, 70, 70, 70, 70, 70, 70, 2, 2, 2, 2, 2, 2, 2, 2, 2, 70, 2, 2, 2, 2, 2, 2, 2, 2, 2, 70, 2, 2, 2, 2, 2, 2, 2, 2, 2, 70, 2, 2, 2, 2, 2, 2, 2, 2, 2, 70, 2, 2, 2, 2, 2, 2, 2, 2, 2, 70, 2, 2, 2, 2, 2, 2, 2, 2, 2, 70, 2, 2, 2, 2, 2, 2, 2, 2, 2, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 2],
         "height":10,
         "name":"Tile Layer 1",
         "opacity":1,
         "type":"tilelayer",
         "visible":true,
         "width":10,
         "x":0,
         "y":0
        }],
 "orientation":"orthogonal",
 "properties":
    {

    },
 "tileheight":32,
 "tilesets":[
        {
         "firstgid":1,
         "image":"Zombie_A5.png",
         "imageheight":512,
         "imagewidth":256,
         "margin":0,
         "name":"Zombie_A5",
         "properties":
            {

            },
         "spacing":0,
         "tileheight":32,
         "tileproperties":
            {
             "1":
                {
                 "solid":"1"
                },
             "69":
                {
                 "solid":"0"
                }
            },
         "tilewidth":32
        }],
 "tilewidth":32,
 "version":1,
 "width":10
};