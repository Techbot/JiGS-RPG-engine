//http://www.mapeditor.org/
/*
 * Don´t like it?
 * use jQuery, Prototype, raw XMLHttpRequest, your favorite JS library for it.
 */
var SOURCE_FROM_TILED_MAP_EDITOR = { "height":10,
		 "layers":[
		           {
		            "data":[1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
		            "height":10,
		            "name":"ground",
		            "opacity":1,
		            "type":"tilelayer",
		            "visible":true,
		            "width":10,
		            "x":0,
		            "y":0
		           }, 
		           {
		            "data":[7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 7, 7, 7, 7, 7, 0, 0, 0, 0],
		            "height":10,
		            "name":"fence",
		            "opacity":1,
		            "type":"tilelayer",
		            "visible":true,
		            "width":10,
		            "x":0,
		            "y":0
		           }, 
		           {
		            "data":[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
		            "height":10,
		            "name":"obstacles",
		            "opacity":1,
		            "type":"tilelayer",
		            "visible":true,
		            "width":10,
		            "x":0,
		            "y":0
		           }, 
		           {
		            "data":[0, 0, 0, 0, 0, 0, 0, 125, 123, 123, 0, 0, 0, 0, 0, 0, 0, 125, 123, 123, 0, 0, 0, 0, 0, 0, 0, 125, 123, 123, 0, 0, 0, 0, 0, 0, 0, 125, 123, 123, 0, 0, 0, 0, 0, 0, 0, 125, 123, 123, 0, 0, 0, 0, 0, 0, 0, 125, 123, 123, 0, 0, 0, 0, 0, 0, 0, 125, 123, 123, 0, 0, 0, 0, 0, 0, 0, 123, 123, 123, 0, 0, 0, 0, 0, 0, 0, 123, 123, 123, 0, 0, 0, 0, 0, 0, 0, 123, 123, 123],
		            "height":10,
		            "name":"water",
		            "opacity":1,
		            "type":"tilelayer",
		            "visible":true,
		            "width":10,
		            "x":0,
		            "y":0
		           }, 
		           {
		            "data":[0, 0, 0, 0, 0, 0, 117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 117, 0, 0, 0, 0, 0, 0, 0, 0, 0, 117, 0, 0, 0],
		            "height":10,
		            "name":"shore",
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
		            "image":"img\/ground.png",
		            "imageheight":32,
		            "imagewidth":96,
		            "margin":0,
		            "name":"ground",
		            "properties":
		               {

		               },
		            "spacing":0,
		            "tileheight":32,
		            "tilewidth":32
		           }, 
		           {
		            "firstgid":4,
		            "image":"img\/obstacles.png",
		            "imageheight":416,
		            "imagewidth":256,
		            "margin":0,
		            "name":"obstacles",
		            "properties":
		               {

		               },
		            "spacing":0,
		            "tileheight":32,
		            "tilewidth":32
		           }, 
		           {
		            "firstgid":108,
		            "image":"img\/water.png",
		            "imageheight":192,
		            "imagewidth":96,
		            "margin":0,
		            "name":"water",
		            "properties":
		               {

		               },
		            "spacing":0,
		            "tileheight":32,
		            "tilewidth":32
		           }],
		    "tilewidth":32,
		    "version":1,
		    "width":10
		   }