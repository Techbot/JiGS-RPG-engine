<div class="canvas_bg" id = "gamecanvas" style = "width:498px;
                                                  margin:0 auto;
                                                  border : 1px red solid;
                                                  ">
    <div id="leave">Log Out</div>

</div>

<script type='text/javascript'>
// Create the canvas
var canvas = document.createElement("canvas");
var ctx = canvas.getContext("2d");
canvas.width = 512;
canvas.height = 480;
var distance =0;
var gC = document.getElementById("gamecanvas");
gC.appendChild(canvas);
var dir = 1;
var first = true;
var shoot_update = false;

// Background image
var bgReady = false;
var bgImage = new Image();
bgImage.onload = function () {
	bgReady = true;
};
bgImage.src = "/components/com_battle/images/canvas/background.png";

// Hero image
var heroReady = false;
var heroImage = new Image();
heroImage.onload = function () {
	heroReady = true;
};
heroImage.src = "/components/com_battle/images/canvas/hero.png";

// Bullet image
var bulletReady = false;
var bulletImage = new Image();
bulletImage.onload = function () {
	//bulletReady = true;
};
bulletImage.src = "/components/com_battle/images/canvas/bullet.png";

// Monster image
var monsterReady = false;
var monsterImage = new Image();
monsterImage.onload = function () {
	monsterReady = true;
};
monsterImage.src = "/components/com_battle/images/canvas/monster.png";

// Game objects
var hero = {
	speed: 256 // movement in pixels per second
};

var bullet = {
	speed: 256 // movement in pixels per second
};

var origin = {
	
};

var monster = {};

var monstersCaught = 0;
var monstersShot = 0;
// Handle keyboard controls
var keysDown = {};

addEventListener("keydown", function (e) {
	keysDown[e.keyCode] = true;
}, false);

addEventListener("keyup", function (e) {
	delete keysDown[e.keyCode];
}, false);

// Reset the game when the player catches a monster
var reset = function () {
	hero.x = canvas.width / 2;
	hero.y = canvas.height / 2;

	// Throw the monster somewhere on the screen randomly
	monster.x = 32 + (Math.random() * (canvas.width - 64));
	monster.y = 32 + (Math.random() * (canvas.height - 64));
};

// Update game objects
var update = function (modifier) {
	if (38 in keysDown) { // Player holding up
		hero.y -= hero.speed * modifier;
		dir=1;
	}
	if (40 in keysDown) { // Player holding down
		hero.y += hero.speed * modifier;
	    dir=2;
	}
	if (37 in keysDown) { // Player holding left
		hero.x -= hero.speed * modifier;
	    dir=3;	
	}
	if (39 in keysDown) { // Player holding right
		hero.x += hero.speed * modifier;
		dir=4;
	}
	
	if (32 in keysDown) { // Player holding space
		bulletReady = true;
		bullet.x = hero.x;
        bullet.y = hero.y;
        
   		
   		if(first ==true)
   		{ 
       		origin.x = hero.x;
            origin.y = hero.y;
            first = false ;    
        }
		//alert ('spacebar');
	}
	
	// Are they touching?
	if (
		hero.x <= (monster.x + 32)
		&& monster.x <= (hero.x + 32)
		&& hero.y <= (monster.y + 32)
		&& monster.y <= (hero.y + 32)
	) {
		++monstersCaught;
		first=true;
		reset();
	}
};

// shoot addition
var shoot = function(modifier){

    if (dir==1){

        bullet.y -= bullet.speed * modifier * 4;
    }

    if (dir==2){

        bullet.y += bullet.speed * modifier * 4;
    }

    if (dir==3){

        bullet.x -= bullet.speed * modifier * 4;
    }

    if (dir==4){

        bullet.x += bullet.speed * modifier * 4;

    }
 
    	// Are they touching2?
	if (
		bullet.x <= (monster.x + 32)
		&& monster.x <= (bullet.x + 32)
		&& hero.y <= (bullet.y + 32)
		&& monster.y <= (bullet.y + 32)
	) {
		++monstersShot;
		reset();
	}
   
   //distance = square root sqrt  of ( (x2-x1)^2 + (y2-y1)^2)
   
    var distance = Math.sqrt(    Math.pow(bullet.x-origin.x, 2) + Math.pow(bullet.y - origin.y,2) );
   
    if (distance > 200)
    {
        bulletReady = false;
        first = true
    }
}

// Draw everything
var render = function ()
     {
	    if (bgReady) {
		    ctx.drawImage(bgImage, 0, 0);
	    }

	    if (heroReady) {
		    ctx.drawImage(heroImage, hero.x, hero.y);
	    }

	    if (monsterReady) {
		    ctx.drawImage(monsterImage, monster.x, monster.y);
	    }
	
	    if (bulletReady) {
	        ctx.drawImage(bulletImage, bullet.x, bullet.y);
	    }

	// Score
	ctx.fillStyle = "rgb(250, 250, 250)";
	ctx.font = "24px Helvetica";
	ctx.textAlign = "left";
	ctx.textBaseline = "top";
	ctx.fillText("Goblins caught: " + distance, 32, 32);
};

    // The main game loop
var main = function ()
    {
	    var now = Date.now();
	    var delta = now - then;
          
        shoot(delta / 1000);
	    update(delta / 1000);
	
	    console.log(dir);
	
	    render();

	    then = now;
    };

// Let's play this game!
reset();
var then = Date.now();
setInterval(main, 1); // Execute as fast as possible


function leave()
{
	
		$('leave').addEvent('click', function()
		{
		
				var a = new Request.JSON({
					url: "index.php?option=com_battle&format=raw&task=action&action=leave_room", 
					onSuccess: function(result)
					{
			   	    	
						location.href = 'index.php?option=com_battle&view=single';
		 
					}
			}).get();
		});
}
leave();
</script>
