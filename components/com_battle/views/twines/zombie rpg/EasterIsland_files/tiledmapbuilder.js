/**@
* #TiledMapBuilder
* @category Graphics
* A Tiled map (http://mapeditor.org) importer for Crafty.js ( http://craftyjs.com)
* It creates a tiled world or view on the basis of exported JSON file from Tiled Map Editor.
* It also provides methods to access to tiles, layers, tilesets, rendering views of map, lazy loading,...
*
* @see http://www.mapeditor.org/ - Tiled Map Editor
* @author Tomas Jurman (tomasjurman@gmail.com)
*/
Crafty.c("TiledMapBuilder", {  	  				
		
	tileMapBuilderSetting: {
		 USE_WEB_WORKERS		:false,
		 PATH_TO_WORKER_SCRIPT	:'../../modules/create_mocks_module.js',		
		 RENDER_METHOD_CANVAS	:'Canvas',
	     RENDER_METHOD_DOM		:'DOM',	    
	 },
	
	_renderMethod: null,
	_isometric:null,
	_layers: null,	
    init: function() {    			    	  			    
    	this._renderMethod = this.has(this.tileMapBuilderSetting.RENDER_METHOD_CANVAS) ? 
    			this.tileMapBuilderSetting.RENDER_METHOD_CANVAS : 
    			this.tileMapBuilderSetting.RENDER_METHOD_DOM;	
    			    	
    	return this;
    },
        
    /**@
	 * #TiledMapBuilder.setMapDataSource
	 * Set a data source for tiled map.
	 * 
	 * @param {Object} source - object from JSON file exported by Tiled Map Editor		
	 * @throws {Error} - when source is not valid 	
	 * @return {Object} this
	 *   
	 * @see http://www.mapeditor.org/ - Tiled Map Editor, export to JSON			 
	 */
    setMapDataSource:function( source ){
    	if(!this.isValid(source)){    	
    		throw new Error("Source is not valid.");    		
    	}
    	
    	this._source = source;
    	
    	if( this.isIsometric() ){
    		this.setIsometric( source );
    	}
    	
    	this.createTiles( source );
    	
    	return this;
    },
    
    /**@
	 * #TiledMapBuilder.createWorld
	 * Renders a tiled world based on the source file.
	 * 	
	 * @param {Function} callback - callback function call when world is done 	
	 * @return {Object} this   	 	
	 */
    createWorld: function( callback ) {     	    	       	
    	return this.createView( 0, 0, this._source.width, this._source.height, callback );
	},
	
	/**@
	 * #TiledMapBuilder.createView
	 * Renders a tiled view based on the source file.
	 * 	
	 * @param {Integer} startRow - start row, start from 0 to N
	 * @param {Integer} startColumn - start column, start from 0 to N
	 * @param {Integer} viewWidth - view width in tiles 
	 * @param {Integer} viewHeight - view height in tiles
	 * @param {Function} callback - callback function call when world is done	
	 * @return {Object} this   			
	 */
	createView: function( startRow, startColumn, viewWidth, viewHeight, callback ){
				
		if( this.tileMapBuilderSetting.USE_WEB_WORKERS && typeof(Worker)!=="undefined"){								
			this.doInBackground({startRow:startRow, startColumn:startColumn, viewWidth:viewWidth, viewHeight:viewHeight, renderMethod:this._renderMethod, source:this._source}, callback );
			
		}else{		
			// Do not forget attach module: <script src="path/to/create_mocks_module.js"></script>
			MockModule.init( startRow, startColumn, viewWidth, viewHeight, this._renderMethod, this._source );										
			this.saveResult( MockModule.createMockEntities(), callback );			
		}
		
    	return this;    	
    },
    
	/**@
	 * #TiledMapBuilder.getLayer
	 * Contains all tiles as Crafty.entity in layer
	 * 
	 * @param	{String} layerName - name of layer, The name will be defined in the Tiled Map Editor
	 * @return	{Array} entities
	 *
	 * @see http://www.mapeditor.org/ - Tiled Map Editor		
	 */
	getEntitiesInLayer:function( layerName ){ 	
		if(!this.isLayer( layerName )){
			return null;
		}
				
		var entities = [];		
		for( var idx = 0; idx < this._layers[layerName].length; idx++){
			if( this._layers[layerName][idx] != 0 ){
				entities.push( this._layers[layerName][idx] );
			};					
		}
		
		return entities;
	},
	
	/**@
	 * #TiledMapBuilder.getTile	
	 *
	 * @param	String layerName - number of layer
	 * @param	Integer row - number of row from tiled matrix, range: 0-n	
	 * @param	Integer column - number of column from tiled matrix, range: 0-n	
	 * @return	Object<Crafty.e> tile 
	 */
	getTile: function( row, column, layerName ){		
		if(!this.isLayer( layerName )){
			return null;
		}
		
		return this._layers[layerName][MockModule.getTileIndex( row, column, this.getLayerFromSource(layerName))];
	},
		
	/**@
	 * #TiledMapBuilder.getLayers	
	 * Object with layerNames as key and Array of loaded Entities as value
	 * Key - layerName
	 * Value - Array<Etities>
	 * 
	 * @return {Object} layers		
	 */
    getLayers: function(){
    	return this._layers;
    },
		
	 /**@
	 * #TiledMapBuilder.getRenderMethod 	
	 *
	 * @example
	 * RenderMethod depends on parent Entity:
	 * ~~~	
	 * Crafty.e("2D, Canvas, TiledMapBuilder")
	 * return -> Canvas	 
	 * 	 
	 * Crafty.e("2D, DOM, TiledMapBuilder")
	 * return -> DOM	 
	 * ~~~
	 * 
	 * @return	String renderMethod - DOM or Canvas				
	 */
    getRenderMethod: function(){
    	return this._renderMethod;
    },
    
    /**@
	 * #TiledMapBuilder.getSource	
	 * 
	 * @return	Object source	
	 * @see TiledMap.load 			
	 */
    getSource: function(){
    	return this._source;
    },
        
    /**@
	 * #TiledMapBuilder.getIsometric
	 * 
	 * @return Object Crafty.isometric or null if map is not isometric
	 * 
	 * @see http://craftyjs.com/api/Crafty-isometric.html		
	 */
    getIsometric:function(){
    	return this._isometric;
    },
    
    /**@
	 * #TiledMapBuilder.isIsometric
	 * 
	 * @return	boolean true or false		
	 */
    isIsometric:function(){
    	return this._source.orientation == MockModule.settings.ISOMETRIC_DIAMOND || 
    		this._source.orientation == MockModule.settings.ISOMETRIC_STAGGERED;
    },
    
    /**@
	 * #TiledMapBuilder.getOrientation
	 * Map orientation.
	 * 
	 * @return {String} (orthogonal || isometric || staggered)		
	 */
    getOrientation:function(){
    	return this._source.orientation;
    },
           
	/*
	 * Validate source object
	 * 
	 * @param {Object} source - object from JSON file exported by Tiled Map Editor	
	 * @return {boolean} true or false
	 */
	isValid: function( source ){
		var isValid = true;
				
		if(!source || 											// is not undefined
		   !(source.width && source.height) ||					// has width and height property
		   !(source.layers && source.layers.length >=1) ||		// has no empty layer property
		   !(source.tilesets && source.tilesets.length >=1)){	// has no empty tilesets property
			isValid = false;
		}
		
		return isValid;
	},
	
	/*
	 * Create Crafty.sprite() for each source image	
	 * 
	 * @param {Object} source - object from JSON file exported by Tiled Map Editor	
	 * @return {Object} this
	 */
	createTiles: function( source ){		
		for(var idx = 0; idx < source.tilesets.length; idx++ ){
			this.createSprite( source.tilesets[idx] );			
		};		
	},
	
	/*
	 * Create Crafty.sprite() from tileset	
	 * 
	 * @param {Object} tileset	
	 * @return {Object} Crafty.sprite()
	 * 	
	 * @see http://craftyjs.com/api/Crafty-sprite.html - Crafty.sprite() documentation
	 */
	createSprite:function( tileset ){		
		return Crafty.sprite(tileset.tilewidth, tileset.tileheight, tileset.image, this.arrangeTiles( tileset ), tileset.margin, tileset.margin);										
	},
	
	/*
	 * Create tiles map from tileset
	 * Every tile´s name is: 'Tile' + index
	 *  
	 * @param {Object} tileset	
	 * @return {Object} map - {tile1:[posX, posY], tile2:[posX, posY], ...}	
	 */
	arrangeTiles:function(tileset){	
			
		var numberOfColumns = Math.round(tileset.imagewidth / (tileset.tilewidth+tileset.margin));
	    var numberOfRows = Math.round(tileset.imageheight / (tileset.tileheight+tileset.margin));
		
		var tilesMap = {};		
		for(var row = 0; row < numberOfRows; row++ ){
			
			for( var column = 0; column < numberOfColumns; column++ ){								
				var name = "Tile" + ((parseInt(tileset.firstgid) + column) + (numberOfColumns * row ));								
				tilesMap[name] = [column, row];
			};			
		}	
				
		return tilesMap;
	},
	
	 /*
	 * #TiledMapBuilder.setIsometric
	 * Create Crafty.isometric object and set it as private field.
	 * 
	 * @param {Object} source - object from JSON file exported by Tiled Map Editor			
	 */
    setIsometric:function( source ){
    	this._isometric = Crafty.isometric.size(source.tilewidth, source.tileheight);
    },
			
	/*
	 * Create Crafty.entities from mock
	 *  
	 * @param {Object} mockEntities, keys are layerName, contains MockObject or 0	
	 * @return {Object} entities, {layer1Name:entities, layer2Name: entities, ...}
	 */
    createEntitiesFromMock:function( mockEntities ){ //TODO - refactor method
    	var layers = {};
    	
    	var isIsometric = this.isIsometric();
    	var isometric = this.getIsometric();
    	for (var layer in mockEntities) { 
    		layers[layer] = [];
    		 for(var idx = 0; idx < mockEntities[layer].length; idx++ ){
    			 var mockEntity = mockEntities[layer][idx];
    			 if( mockEntity == 0 ){
    				 layers[layer].push(0);
				}else{    					    				
					var entity = Crafty.e( mockEntity.head ).attr({ x:mockEntity.x, y:mockEntity.y });
	    			if( isIsometric ){
	    				isometric.place( entity.x, entity.y, 0, entity);	
	    			}    			     			
	    			layers[layer].push( entity );
				}    			     			     			     			     
    		 }    		
    	}    	    	   
    	return layers;
    },
			
	/*
	 * Determine if layer with layerName exists
	 * 
	 * @param String layerName	
	 * @return boolean
	 */
	isLayer: function( layerName){
		return this._layers[layerName] ? true : false;
	},
	
	/*
	 * Get Layer object from source object
	 * Source object is object from JSON file exported by Tiled Map Editor
	 * 
	 * @param {String} layerName		
	 * @return {Object} layer
	 */
	getLayerFromSource:function(layerName){
		for(var idx = 0; idx < this._source.layers.length; idx++){
			if(this._source.layers[idx].name == layerName){
				return this._source.layers[idx];
				break;
			}
		}
		return null;				
	},	
	
	  /*
     * Do task in background thread
     * 
     * @param {Object} data, {startRow:startRow, startColumn:startColumn, viewWidth:viewWidth, viewHeight:viewHeight, renderMethod:renderMethod, source:source}
     * @param {Function} callback - callback function call when world is done 
     */
    doInBackground:function( data, callback){
    	var self = this;
		var worker = new Worker(this.tileMapBuilderSetting.PATH_TO_WORKER_SCRIPT);				
		worker.postMessage(data);
		worker.onmessage = function (e) {					
			self.saveResult( e.data, callback );							
		};
    },
    
    /*
     * Save entities to private field
     * 
     * @param {Object} mockEntities
     * @param {Function} callback - callback function call when world is done	
     */
    saveResult: function( mockEntities, callback){
    	this._layers = this.createEntitiesFromMock( mockEntities );			
		if(typeof callback != 'undefined'){
    		callback.call(this, this);
    	}
    },
});
