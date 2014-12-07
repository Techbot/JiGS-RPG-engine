onmessage = function(e) {
	MockModule.init(e.data.startRow, e.data.startColumn, e.data.viewWidth, e.data.viewHeight, e.data.renderMethod, e.data.source);		
	postMessage(MockModule.createMockEntities());   
};

/**
* Create mock entities for TiledMapBuilder
* 
* @class MockModule
* @author Tomas Jurman (tomasjurman@gmail.com)
* @see TiledMapBuilder (https://github.com/Kibo/TiledMapBuilder)
*/
MockModule = {
	_startRow:null,
	_startColumn:null,
	_viewWidth:null,
	_viewHeight:null,
	_renderMethod:null,
	_source:null,
		
	settings: {
		ISOMETRIC_DIAMOND	:'isometric',
		ISOMETRIC_STAGGERED	:'staggered',
		ORTHOGONAL			:'orthogonal',		
	},
		
	/**
	 * Constructor for module
	 * 	
	 * @param {Integer} startRow - start row, start from 0 to N
	 * @param {Integer} startColumn - start column, start from 0 to N
	 * @param {Integer} viewWidth - view width in tiles 
	 * @param {Integer} viewHeight - view height in tiles
	 * @param {String} renderMethod, [ DOM | Canvas ]
	 * @param {Object} source - object from JSON file exported by Tiled Map Editor
	 * @return {Object} this 
	 */
	init: function( startRow, startColumn, viewWidth, viewHeight, renderMethod, source ) { 
		this._startRow = startRow;
		this._startColumn = startColumn;
		this._viewWidth = viewWidth;
		this._viewHeight = viewHeight;
		this._renderMethod = renderMethod;
		this._source = source;
		
	    return this;
	},
	
	/**
	 * Create MockEntities
	 *  
	 * @return {Object} layers, {layer1name:[entities], layer1name:[entities], ...}		
	 */
	createMockEntities: function(){
		var layers = {};
		for(var layer = 0; layer < this._source.layers.length; layer++){
			var entities = this.createMockEntitiesInLayer( this._source.layers[layer] );
			layers[this._source.layers[layer].name] = entities;			
		}	
		
		return layers;		
	},
	
	/*
	 * Create MockEntities in layer
	 *	 
	 * @param {Object} layer
	 * @return {Array} entities		
	 */
	createMockEntitiesInLayer: function( layer ){			
		var indexes = this.getIndexes( layer );
		
		var entities = [];
		for(var i = 0; i < indexes.length; i++){	
			
			if( layer.data[indexes[i]] == 0 ){
				entities.push(0);
			}else{											
				entities.push( this.createMockEntity( layer, indexes[i] ) );
			}						
		}				
		return entities;
	},
	
    /*
	* Return index of every tile in source data
	* 		
	* @param {Object} layer
	* @return {Array} indexes - [0,1,10,11,12,15,20,21,22,23,24,25,26]	
	*/
    getIndexes:function( layer ){    	
    	var idxs = [];
    	
    	for(var row = this._startRow ; row < (this._startRow + this._viewHeight); row++ ){
    		var indexOfStartTile = this.getTileIndex(row, this._startColumn, layer);     		
    		idxs = idxs.concat(  this.makeSequence(indexOfStartTile, indexOfStartTile + this._viewWidth));    		
    	}    	   
    	return idxs;
    },
    
    /*
	 * Create MockEntity
	 * 	
	 * @param {Object} layer
	 * @param {Integer} dataIndex	
	 * @return {Object} mock, {head:String, x:number, y:number} 
	 */
	createMockEntity:function( layer, dataIndex){			
		var column = dataIndex % layer.width;
		var row = Math.floor((dataIndex / layer.width));								
		var mock = {head:"2D," + this._renderMethod + ",Tile" + layer.data[dataIndex] + "," + layer.name};	
		this.setPosition( column, row, mock );				
		return mock;
	},
	
	/*
	 * Set position of entity
	 * 	
	 * @param {Integer} column
	 * @param {Integer} row	 	
	 * @param {Object} mockEntity 
	 */
	setPosition:function( column, row, mockEntity){
		
		switch( this._source.orientation ){
			
			case this.settings.ORTHOGONAL:
				mockEntity.x = column * this._source.tilewidth;
				mockEntity.y = row * this._source.tileheight;
				break;
			
			case this.settings.ISOMETRIC_DIAMOND:				
				var left = (column - row) * (this._source.tilewidth/2);
				var top = (column + row) * (this._source.tileheight/2);												
				var position = this.px2pos(left, top, this._source);
				mockEntity.x = position.x;
				mockEntity.y = position.y;				
				break;
				
			case this.settings.ISOMETRIC_STAGGERED:
				mockEntity.x = column;	
				mockEntity.y = row;
				break;
											
			default:
				throw new Error("Orientation of map " + this._source.orientation + "is not supported.");
		}
	},
    
    /*
	* Create sequence of numbers
	* from is in
	* to is out
	* 
	* @param {Integer} from
	* @param {Integer} to
	* @return {Array} indexes - [0,1,2,3,4,5,6,7,8,9,..]	
	*/
    makeSequence:function(from, to){       	    
    	var numbers = [];       
    	for(var idx = from; idx < to; idx++){
    		numbers.push(idx);
    	}    	      
    	return numbers;	
    }, 
    
    /*
	 * Get index of tile from layer
	 * 	 
	 * @param {Integer} row, start from 0 to N
	 * @param {Integer} column, start from 0 to N
	 * @param {Object} layer	
	 * @return {Integer} index
	 */
	getTileIndex:function( row, column, layer){			
		return ((layer.width) * row) + column;	
	},
	
	/*
	 * Convert px to position in staggered map
	 * 	
	 * @param {Integer} left
	 * @param {Integer} top 
	 * @return {Object} position {x:number, y:number}
	 */
	px2pos:function( left, top, source){
		return{
			x:-Math.ceil(-left / source.tilewidth - (top%2) * 0.5),
            y:top / source.tileheight * 2
		};
	},
};
