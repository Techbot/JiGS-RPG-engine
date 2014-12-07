Crafty.scene('Loading', function(){

		Crafty.e('2D, Canvas, Text')
			.attr({ x: 0, y: 200 - 24, w: 200 })
			.text('Loading...');
	// Load our sprite map image
	Crafty.load([
	'assets/dorm-tiles-red.png', 
	'assets/player.png',
	'assets/dobbs.png',
		'assets/city-top-day.jpg',
		'grid001-001.png',
		'assets/pope.jpg',
	
	'assets/TileA4.png',
	'assets/TileB.png',	
	'assets/TileC.png',
  	'img/obstacles.png',
  				          
	'assets/undeadking.png'
], 
	function(){
		// Once the images are loaded...

		
		
		Crafty.sprite(32, 'assets/dorm-tiles-red.png', {
			spr_tree:    [6, 2],
			spr_bush:    [3, 3],
			spr_village: [6, 1]
		});
	


	
		Crafty.sprite(32, 'assets/transparent.png', {
		//	spr_village: [1, 1]
		});		
		// Define the PC's sprite to be the first sprite in the third row of the
		//  animation sprite map
		Crafty.sprite(32,32, 'assets/undeadking.png', {
			spr_player:  [0, 2],
		}, 0, 2);
 
        Crafty.sprite(32,32, 'assets/undeadking.png', {
			spr_zombie:  [0,2],
		},0, 2);

		// Now that our sprites are ready to draw, start the game
		Crafty.scene('Cutscene');
	})
});

// Game scene
// -------------
// Runs the core gameplay loop
Crafty.scene('Cutscene', function() 
{
	Crafty.background('#000000 url(assets/city-top-day.jpg) no-repeat top center');

	Crafty.e("2D, Canvas, Image, Mouse").image("assets/dobbs.png").attr({ x: 30, y: 10 })
	
	.bind('MouseDown', function(e)
	{
        console.log(e.mouseButton, e.realX, e.realY);
		Crafty.scene('instructions2');
    });
	



	
	Crafty.e("2D, Canvas, Image").image("assets/mask.jpg").attr({ x: 20, y: 300 });

	
	
	
	
	Crafty.e("2D, Canvas, Image, Mouse").image("assets/grid001-001.png").attr({ x: 0, y: 0 })

	
	.bind('MouseDown', function(e)
	{
      //  console.log(e.mouseButton, e.realX, e.realY);
		//Crafty.scene('Game');
    });
		
	Crafty.e("2D, Canvas, Image, Mouse").image("assets/pope.jpg").attr({ x: 400, y: 290 })
	
	.bind('MouseDown', function(e)
	{
   //     console.log(e.mouseButton, e.realX, e.realY);
		Crafty.scene('instructions');
    });	
		
	
	
	
	
	Crafty.e("2D, Canvas, Image, Mouse").image("assets/enter.png").attr({ x: 200, y: 50 })

//	.replace("<a href='www.eclecticmeme.com/default.php'>Index</a>")
	.bind('MouseDown', function(e)
	
	{
	
	
	
	
	
     //  console.log(e.mouseButton, e.realX, e.realY);
		Crafty.scene('Game');
    });
	
});

Crafty.scene('instructions', function() 
{
	Crafty.background('#000000 url(assets/city-top-day.jpg) no-repeat top center');
	
	Crafty.e("2D, Canvas, Text, Mouse").attr({ x: 100, y: 100 }).text("You receive 100 credits per day")

	Crafty.e("2D, Canvas, Image, Mouse").image("assets/dobbs.png").attr({ x: 30, y: 10 })
	
	.bind('MouseDown', function(e)
	{
        console.log(e.mouseButton, e.realX, e.realY);
		Crafty.scene('instructions2');
    });
	
	Crafty.e("2D, Canvas, Image, Mouse").image("assets/pope.jpg").attr({ x: 400, y: 250 })
		.bind('MouseDown', function(e)
	{
        console.log(e.mouseButton, e.realX, e.realY);
		Crafty.scene('Cutscene');
    });
	
});

Crafty.scene('instructions2', function() 
{
	Crafty.background('#000000 url(assets/city-top-day.jpg) no-repeat top center');
	
	Crafty.e("2D, Canvas, Text, Mouse").attr({ x: 100, y: 100 }).text("You receive 100 credits per day")

	Crafty.e("2D, Canvas, Image, Mouse").image("assets/dobbs.png").attr({ x: 30, y: 90 })
	
	.bind('MouseDown', function(e)
	{
        console.log(e.mouseButton, e.realX, e.realY);
		Crafty.scene('instructions2');
    });
	
		Crafty.e("2D, Canvas, Image, Mouse").image("assets/fsm.png").attr({ x: 200, y: 190 })
	
	.bind('MouseDown', function(e)
	{
        console.log(e.mouseButton, e.realX, e.realY);
		Crafty.scene('Cutscene');
    });
	
			Crafty.e("2D, Canvas, Image, Mouse").image("assets/apple.png").attr({ x: 100, y: 390 })
	
	.bind('MouseDown', function(e)
	{
       hoverLink='http://eclecticmeme.com/index.php?option=com_comprofiler&task=userslist&Itemid=125';
	
	window.location = hoverLink;
    });
	
	Crafty.e("2D, Canvas, Image, Mouse").image("assets/grid001-001.png").attr({ x: 0, y: 0 })

	
	.bind('MouseDown', function(e)
	{
      //  console.log(e.mouseButton, e.realX, e.realY);
		//Crafty.scene('Game');
    });
});

// Game scene
// -------------
// Runs the core gameplay loop
Crafty.scene('Game', function() 
{
     this.occupied = new Array(Game.map_grid.width);
    
    for (var i = 0; i < Game.map_grid.width; i++) 
    {
        this.occupied[i] = new Array(Game.map_grid.height);
        for (var y = 0; y < Game.map_grid.height; y++) 
        {
            this.occupied[i][y] = false;
        }
    }

/*
	//Player
				Crafty.e("2D, Canvas, Fourway, SpriteAnimation, Ogre, Collision")
  			   		.attr({x: 100, y: 50, z: 10}) 
  			   		.reel("walk_left", 0, 1, 3)
  			   		.reel("walk_right", 0, 2, 3)	
  			   		.reel("walk_up", 0, 3, 3)	
  			   		.reel("walk_down", 0, 0, 3)	
  			   		.fourway(8)  			   					
  			   		.collision( new Crafty.polygon([10,60],[40,60],[40,67],[10,67]) )
  			   		.bind('Moved', function(from) {
						if( this.hit('obstacles') ){
							this.attr({x: from.x, y:from.y});
						}							
						this.z = Math.floor(this._y + this._h);  
					})																
					.bind("NewDirection",
					    function (direction) {
					        if (direction.x < 0) {
					            if (!this.isPlaying("walk_left"))
					               this.pauseAnimation();
					               
					        }
					        if (direction.x > 0) {
					            if (!this.isPlaying("walk_right"))
					              this.pauseAnimation();
					        }
					        if (direction.y < 0) {
					            if (!this.isPlaying("walk_up"))
					          this.pauseAnimation();
					        }
					        if (direction.y > 0) {
					            if (!this.isPlaying("walk_down"))
					               this.pauseAnimation();
					        }
					        if(!direction.x && !direction.y) {
					           this.pauseAnimation();
					        }
					})  

*/
//////////////////////////////////////////////////////////////

			Crafty.e("2D, Canvas, TiledMapBuilder").setMapDataSource( ORTHOGONAL[1] )
			.attr({x: 0, y: 0, z: 1000}) 
				.createWorld( function( tiledmap ){
					
					//Obstacles
					for (var obstacle = 0; obstacle < tiledmap.getEntitiesInLayer('obstacles').length; obstacle++){
						tiledmap.getEntitiesInLayer('obstacles')[obstacle]
							.addComponent("Collision")
							.collision();							
					}
				})
				.createView( 1, 1, 10, 10, function( tiledmap ){
				console.log("done");
				})
				
				
				
				;
///////////////////////////////////////////////////////////////////////////////////

    var Hero =   Crafty.e("Hero").at(9, 9); 
	this.occupied[10][10] = true;
    // Player character, placed at 5, 5 on our grid
    //this.Hero = Crafty.e('Hero').at(5, 5);
    //this.occupied[this.Hero.at().x][this.Hero.at().y] = true;

////////////////////////////////////////////////////////////////////////    
    
    for (var x = 0; x < Game.map_grid.width; x++)
    {
        for (var y = 0; y < Game.map_grid.height; y++)
        {
            var at_edge = x == 0 || x == Game.map_grid.width - 1 || y == 0 || y == Game.map_grid.height - 1;
         
            if (at_edge) 
            {
                // Place a tree entity at the current tile
             //   Crafty.e('Tree').at(x, y);
                this.occupied[x][y] = true;
   
            } 
                
            else if (Math.random() < 0.06 && !this.occupied[x][y]) 
  
        {
        
           if (Math.random() < 0.06 ) 
            {
            // Place a bush entity at the current tile
            // var bush_or_rock = (Math.random() > 0.3) ? 'Bush' : 'Rock';
       //     Crafty.e('Zombie').at(x, y);
           
            }
            
            else
             {
            // Place a bush entity at the current tile
            // var bush_or_rock = (Math.random() > 0.3) ? 'Bush' : 'Rock';
         //   Crafty.e('Bush').at(x, y);
            this.occupied[x][y] = true;
            }
            
         } 
   
        }
    }
 /////////////////////////////////////////////////////////////////////       
 // var values = PORTALS[number];  
   
// Crafty.e('Village').at(values.portal_x,values.portal_y);

 
 
  
/*
   var max_villages = 5;
    for (var x = 0; x < Game.map_grid.width; x++)
    {
        for (var y = 0; y < Game.map_grid.height; y++)
        {
            if (Math.random() < 0.03)
            {
               
                 
                if (Crafty('Village').length < max_villages && !this.occupied[x][y])
              
              //  if (Crafty('Village').length < max_villages)
                {
                   Crafty.e('Village').at(x, y);
                }
            }
        }
    }

	
	*/
	
	
	
PORTALS.forEach(function(entry) {

if (entry.source_map==1){

		console.log(entry);
	
		Crafty.e('Village').at(entry.portal_x,entry.portal_y).setName(entry.id);
	  }
	
});
	
////////////////////////////////////////////////////////////////////////    
    Crafty.addEvent(this, Crafty.stage.elem, "mousedown", function(e)
    {
        console.log(e.realY , Hero.y,e.realX , Hero.x );

        Crafty.e('ball').at(Hero.x,Hero.y);
            
/////////////////////////////////////////////////////////////////// 
  if (e.realY >= Hero.y+30)
            {
                 if (e.realX >= Hero.x + 30)
                {
                     dX = 10;
                }
                else if (e.realX <= Hero.x - 30)
                {
                    dX = -10;
                }
                else
                {
                    dX = 0;
                }
                dY = 10;
            }
///////////////////////////////////////////////////////////////////        
     else if (e.realY+30 <= Hero.y)
            {
               if (e.realX < Hero.x - 50)
                {
                     dX = -10;
                }
                else if (e.realX > Hero.x + 50)
                {
                    dX = 10;
                }
                else
                {
                    dX = 0;
                }
                dY = -10;
            }
//////////////////////////////////////////////////////////////////////
       else if (e.realX >= Hero.x+30)
            {
            
            
            
                if (e.realY-130 >= Hero.y )
                {
                     dY = 10;
                }
                else if (e.realY+310 <= Hero.y )
                {
                    dY = -10;
                }
                else
                {
                    dY = 0;
                }
                dX=10;
            }
///////////////////////////////////////////////////////////////////        
            else if (e.realX+30 <= Hero.x)
            {
                if (e.realY+330 <= Hero.y )
                {
                    dY = -10;
                }
                else if (e.realY-330 >= Hero.y )
                {
                    dY = 10;
                }
                else
                {
                    dY = 0;
                }
                dX=-10;
            }
///////////////////////////////////////////////////////////////////        
         
///////////////////////////////////////////////////////////////////        
    });
  
});
Game.start();
