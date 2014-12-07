// The Grid component allows an element to be located
//  on a grid of tiles
//      var number=1;


function pad(num, size)
{
    var s = "000000000" + num;
    return s.substr(s.length-size);
}

Crafty.c('Grid',
{
	init: function() 
	{
    	this.attr({
		w: Game.map_grid.tile.width,
		h: Game.map_grid.tile.height
    })
  },
  // Locate this entity at the given position on the grid
  at: function(x, y)
  {
    if (x === undefined && y === undefined) 
    {
      return { x: this.x/Game.map_grid.tile.width, y: this.y/Game.map_grid.tile.height }
    } else 
    {
      this.attr({ x: x * Game.map_grid.tile.width, y: y * Game.map_grid.tile.height });
   //   this.attr({ x: x , y: y  });
      return this;
    }
  }
});

//////////////////////////////////////////////////////////

Crafty.c('Actor', {
  init: function() {
    this.requires('2D, Grid,Canvas');
  },
});

/////////////////////////////////////////////////////////
Crafty.c('Zombie', 
{
    init: function() 
    {
        var Zombie      = this;
        var Hero        = Crafty("Hero");

	Hero.bind("Moved", function(oldPos)
	{
		if (oldPos.x < Zombie.x)
			Zombie.flip();
		else
		Zombie.unflip();
	});
      
	this.requires('Actor, Solid,2D,Canvas, Player,spr_zombie,Tween, Fourway,Collision,SpriteAnimation')
        .stopOnSolids()
        .onHit('ball', this.killZombie)
        .onHit('Solid', this.change_direction)
        .attr({ h: 64, w:32 })
        
        .reel('ZombieMovingUp'   , 600, 0, 0, 3)
        .reel('ZombieMovingLeft' , 600, 0, 1, 3)
        .reel('ZombieMovingRight', 600, 0, 2, 3)
        .reel('ZombieMovingDown' , 600, 0, 3, 3)

        .bind('EnterFrame', function (data) 
        { 
            if (Zombie.y > Hero.y)
            {
            
				//  Zombie.flip;
				var animation_speed = 8;
                d_Zombie_y = -1;
                Zombie.animate('ZombieMovingUp',8, -1);
            }
            if (Zombie.y < Hero.y)
            {
				var animation_speed = 8;
				d_Zombie_y = 1;
				Zombie.animate('ZombieMovingDown',8, -1);
            }      
            if (Zombie.x > Hero.x)
            {
            
				// Zombie.flip;
				var animation_speed = 8;
				d_Zombie_x = -1;
				Zombie.animate('ZombieMovingRight', -1);
            }    

            if (Zombie.x < Hero.x)
            {
				var animation_speed = 8;
                d_Zombie_x = +1;
				Zombie.animate('ZombieMovingLeft', -1);
            }  
            this.x = this.x + d_Zombie_x;
            this.y = this.y + d_Zombie_y;
        })
        var animation_speed = 8;
       
        this.bind('NewDirection', function(data) 
        {
            if (data.x > 0) 
            {
        		// Zombie.flip();
            	console.log('up');
				//   Zombie.animate('ZombieMovingLeft', 8,-1);
            }
			else if (data.x < 0) 
            {
				// Zombie.animate('ZombieMovingRight', animation_speed, -1);
				// Zombie.unflip();
           		console.log('up');
            } 
            else if (data.y > 0)
            {
				// Zombie.animate('ZombieMovingDown',8, -1);
				// Zombie.flip();
				// console.log('up');
            } 
            else if (data.y < 0) 
            {
        //   Zombie.reel('PlayerRunningu', 1000, [[3, 0], [4, 0], [5, 0], [3, 3]]);
                Zombie.animate('ZombieMovingUp', animation_speed, -1);
           
            console.log('up');
      //      Zombie.flip();
           
            } 
            
            else {
           // this.pauseAnimation();
            }
        });
 
    },
    
    change_direction: function()
        {
           Zombie = this;
           Zombie.d_Zombie_x = -Zombie.d_Zombie_x;
           Zombie.d_Zombie_y = -Zombie.d_Zombie_y;
           
            return this;
          },

    killZombie: function() 
    {
        var Zombie = this;
        Zombie.destroy();
    },
    
    stopOnSolids: function()
    {
        this.onHit('Solid', this.stopMovement);
        return this;
    },

    // Stops the movement
    stopMovement: function() 
    {
        this._speed = 0;
        if (this._movement)
        {
            this.x -= this._movement.x;
            this.y -= this._movement.y;
        }
    },
});
////////////////////////////////////////////////////////////////////////////////////
// A Tree is just an Actor with a certain color
Crafty.c('Tree', {
  init: function() {
    this.requires('Actor,spr_tree, Solid')
  },
});


///////////////////////////////////////////////////////////////////////////////////
// A Bush is just an Actor with a certain color

Crafty.c('Bush', {
  init: function() {
    this.requires('Actor, spr_bush, Solid')
  },
});

/////////////////////////////////////////////////////////////////////////////////////
 // A village is a tile on the grid that the PC must visit in order to win the game
Crafty.c('Village',
{
    init: function() 
    {
        this.requires('Actor, spr_village');
    },
    collect: function() 
    {
        this.destroy();
    }
});

/////////////////////////////////////////////////////////

Crafty.c('ball', 
{
    speed: 25,
    init: function()
    {   
        var ball = this;
        this.requires("2D, Color, Collision,Tween, Canvas, spr_player");
        this.attr({ h: 5 , w: 5 });
	    this.bind('EnterFrame', function () 
        { 	
        	this.x = this.x + dX;
		    this.y = this.y + dY;
            setTimeout(function () 
            { 
                ball.destroy(); 
            }, 320);
            if (this.y > 860)
            {
				this.destroy();
			}
        });
       this.tween({ h: 0, w: 0,alpha: 0 }, 420); 
    },
    at: function(x, y)
    {
        if (x === undefined && y === undefined) 
        {
          return { x: this.x/Game.map_grid.tile.width, y: this.y/Game.map_grid.tile.height }
        } else 
        {
          //this.attr({ x: x * Game.map_grid.tile.width, y: y * Game.map_grid.tile.height });
          this.attr({ x: x , y: y  });
          return this;
        }
    }
});

///////////////////////////////////////////////////////////////

Crafty.c('Hero',
{
    init: function() 
    {
        var Hero = this;
        var Zombie = Crafty('Zombie');
        
        Crafty.addEvent(Hero, Crafty.stage.elem, "mousedown", Hero.onMouseDown);
        this.requires('Fourway,Grid,2D, Player,Tween, Controls, Collision,Mouse,Keyboard,Canvas,spr_player,SpriteAnimation')
        .attr({ h: 31, w:31 })
        .fourway(8)
        .stopOnSolids()
        .onHit('Village', this.visitVillage)
      
     
     
     .bind('Moved', function(from) {
						if( this.hit('obstacles') ){
							this.attr({x: from.x, y:from.y});
						}							
						this.z = Math.floor(this._y + this._h);  
					})
 
        .reel('PlayerMovingUp',  600, 0, 0, 3)
        .reel('PlayerMovingRight', 600, 0, 1, 3)
        .reel('PlayerMovingDown', 600, 0, 2, 3)
        .reel('PlayerMovingLeft', 600, 0, 3, 3);
        
        var animation_speed = 8;
        
        /*
        this.bind("Moved", function(oldPos) {
		if (oldPos.x < Zombie.x)
			  Zombie.flip();
		else
			  Zombie.unflip();
		});
        
     */   

        this.bind('NewDirection', function(data) 
        {
            if (data.x > 0) {
          //  this.animate('PlayerMovingRight', animation_speed, -1);
            
          //  Hero.unflip();
            
            
            } else if (data.x < 0) {
        //    this.animate('PlayerMovingLeft', animation_speed, -1);
             Hero.flip();
            } else if (data.y > 0) {
      //      this.animate('PlayerMovingDown', animation_speed, -1);
           //  Hero.flip();
            } else if (data.y < 0) {
     //      this.animate('PlayerMovingUp', animation_speed, -1);
           //  Hero.flip();
            } else {
            this.pauseAnimation();
            }
        });
     },   
        // Registers a stop-movement function to be called when
        // this entity hits an entity with the "Solid" component
        stopOnSolids: function()
        {
            this.onHit('Solid', this.stopMovement);
            return this;
        },

        // Stops the movement
        stopMovement: function() 
        {
            this._speed = 0;
            if (this._movement)
            {
                this.x -= this._movement.x;
                this.y -= this._movement.y;
            }
        },

        // Respond to this player visiting a village
        visitVillage: function(data)
        {
            village = data[0].obj;
            village.collect();
			
			//var index = window._id;
			
			console.log(village);
		

	//	map_number = (PORTALS[index].destination_map);
		this.portalJump(data);
         //   var z_number = pad(number,3);
         //   Crafty.background('#FFFFFF url(assets/zombie' + z_number+'.png) no-repeat center center'); 
         },
        portalJump: function(data)
        {
		//window._id = entry.id;
			village = data[0].obj;
			index = village._entityName;
		 
			values = PORTALS[index];
			
			map_number = values.destination_map;

			console.log(map_number);
			Crafty('obj').each(function() { this.destroy(); });
			 Crafty.e("2D, Canvas, TiledMapBuilder").destroy();
                
			//	Hero = Crafty('Hero');
				
			//        Hero.x =  values.destination_x; 
				
			//	   Hero.y =  values.destination_y; 
				
			Crafty.e("Hero").at(values.destination_x,values.destination_y);
     
			Crafty.e("2D, Canvas, TiledMapBuilder").setMapDataSource(  ORTHOGONAL[map_number] )
				.attr({x: 0, y: 0, z: 1000}) 
				.createWorld( function( tiledmap )
				{
					
					//Obstacles
					for (var obstacle = 0; obstacle < tiledmap.getEntitiesInLayer('obstacles').length; obstacle++){
					tiledmap.getEntitiesInLayer('obstacles')[obstacle]
						.addComponent("Collision")
						.collision();							
					}
				});
				
		var max_villages = 5;
		for (var x = 0; x < Game.map_grid.width; x++)
		{
			for (var y = 0; y < Game.map_grid.height; y++)
			{
				if (Math.random() < 0.06)
				{
					if (Crafty('Village').length < max_villages )
					{
				
				//	 Crafty.e('Village').at(values.portal_x,values.portal_y);
					 // Crafty.e('Village').at(x, y);
					}
				}
			}
		}
		PORTALS.forEach(function(entry)
		{
			if (entry.source_map==map_number)
			{
				//   console.log(number);
				Crafty.e('Village').at(entry.portal_x,entry.portal_y).setName(entry.id);
			}
	
		});
		
		
		
		
		
		
		
		
		
		
		
		
	}
});// End of hero
