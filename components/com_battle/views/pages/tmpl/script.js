	
	// requestAnim shim layer by Paul Irish
    window.requestAnimFrame = (function(){
      return window.requestAnimationFrame ||
              window.webkitRequestAnimationFrame ||
              window.mozRequestAnimationFrame ||
              window.oRequestAnimationFrame ||
              window.msRequestAnimationFrame ||
              function(/* function */ callback, /* DOMElement */ element){
              window.setTimeout(callback, 1000 / 60);
              };
    })();
	
	
	
	var message = {};
	message[1]="So much depends";
	message[2]="upon an empty container";
	message[3]="container";
	message[4]="I";
	message[5]="like";
	message[6]="stuff";
	
	
	var canvas = document.getElementById("myCanvas");
	var context = canvas.getContext("2d");
	
	var dirX = 1;

	var imageObj = {};
	var destXObj = {};
	var destYObj = {};
	
		imageObj[1] = new Image();
		imageObj[1].src = "/components/com_battle/views/twines/tmpl/poster-sprite-voodoo-woman.png";
		destXObj[1] = 260;
		destYObj[1] = 50;
		
		
		imageObj[2] = new Image();
		imageObj[2].src = "/components/com_battle/views/twines/tmpl/poster-sprite-acid.png";
		destXObj[2] = 20;
		destYObj[2] = 330;
		
		imageObj[3] = new Image();
		imageObj[3].src = "/components/com_battle/views/twines/tmpl/poster-sprite-acid.png";
		destXObj[3] = 20;
		destYObj[3] = 330;
		
		imageObj[4] = new Image();
		imageObj[4].src = "/components/com_battle/views/twines/tmpl/poster-sprite-acid.png";
		destXObj[4] = 20;
		destYObj[4] = 330;
		
		imageObj[5] = new Image();
		imageObj[5].src = "/components/com_battle/views/twines/tmpl/poster-sprite-acid.png";
		destXObj[5] = 20;
		destYObj[5] = 330;
		
		imageObj[6] = new Image();
		imageObj[6].src = "/components/com_battle/views/twines/tmpl/poster-sprite-acid.png";
		destXObj[6] = 20;
		destYObj[6] = 330;
		
		imageObj[7] = new Image();
		imageObj[7].src = "/components/com_battle/views/twines/tmpl/poster-sprite-acid.png";
		destXObj[7] = 20;
		destYObj[7] = 330;
		
		imageObj[8] = new Image();
		imageObj[8].src = "/components/com_battle/views/twines/tmpl/poster-sprite-acid.png";
		destXObj[8] = 20;
		destYObj[8] = 330;
		

	var imagePlayer = new Image();
		imagePlayer.src = "/components/com_battle/views/twines/tmpl/walk.png";
		
		//var destX = canvas.width / 4 - (imageObj2.width / 2);
		//var destY = canvas.height / 2 - (imageObj2.height / 2);
		
		//starting point
		var destX = 0;
		var destY = 415;
		var number=1;


	var imageBgObj= {};	
			
	    imageBgObj[1] = new Image();
		imageBgObj[1].src = "/components/com_battle/views/twines/tmpl/frame001.jpg";

	    imageBgObj[2] = new Image();
		imageBgObj[2].src = "/components/com_battle/views/twines/tmpl/np-dream.jpg";

	    imageBgObj[3] = new Image();
		imageBgObj[3].src = "/components/com_battle/views/twines/tmpl/ta-cafe_aubette.jpg";

	    imageBgObj[4] = new Image();
		imageBgObj[4].src = "/components/com_battle/views/twines/tmpl/ty-landscape.jpg";

	    imageBgObj[5] = new Image();
		imageBgObj[5].src = "/components/com_battle/views/twines/tmpl/ty-white.jpg";

	    imageBgObj[6] = new Image();
		imageBgObj[6].src = "/components/com_battle/views/twines/tmpl/ty-waiting.jpg";

	    imageBgObj[7] = new Image();
		imageBgObj[7].src = "/components/com_battle/views/twines/tmpl/ty- surrealist_landscape.jpg";

	    imageBgObj[8] = new Image();
		imageBgObj[8].src = "/components/com_battle/views/twines/tmpl/ty-destroy.jpg";

	//var imageGridObj = new Image();
	//	imageGridObj.src = "guides50x50.png";	
	
	var smallX = 0;
	var pause = 2;
	var framenumber=1;
	var i =1;
	var state = "stop";
	
	window.onload=function() 
	{

		animate();
	
	};

    function animate() {
                requestAnimFrame( animate );
                update();
                draw();
        }
		
	
	function update(){
		anim_update ();
		input ();
	}
	
	function input(){

	$(document).keyup(function(e)
		{
			if (e.keyCode == 37)
			{
			//	state= "stop";
			//	dirX=1;
			}
			if (e.keyCode == 39)
			{
			//	state= "stop";
			//	dirX=1;
			}
		});

	$(document).keydown(function(e) {
	//alert (e.keyCode);
	//if space start/stop gameloop
	//var time = new Date().getTime() * 0.002;
	
		if(e.keyCode == 32)
		{
			//status = 0 - status;
		}
		if (e.keyCode == 40){
		//	down
		}
		if (e.keyCode == 37){
			state = 'left';
		}
		if (e.keyCode == 39){
			state = 'right';
		}
	});
		///////////////////////////////////////////////////////////////////////////////
	   if (state == 'left')
	   {
	   		destX = destX - (1 * dirX);
	   }
		if (state == 'right')
		{
			destX = destX + (1 * dirX);
		}
		

		if (destX > canvas.width )
		{
   			destX =-50;
			number++;
    	}
		
		if (destX < -50 )
		{
   			destX =600;
			number--;
    	}
		
		
		if(number==9){
			number =1;
		}
		
		if(number==0){
			number =8;
		}
	}
	
	function anim_update(){
		
	if (state != "stop") {
					i++;
			if (i==pause)
				{	
			 i=1;
			
			framenumber++;

			if (framenumber==11)
				{
					framenumber=1;
				}
			}
			
			smallX = framenumber * 50;
		}

	}
	
	function draw(){

			context.drawImage(imageBgObj[number], 0, 0, 600, 482);
	
			//context.drawImage(imageGridObj, 0, 0, 600, 482);
	
			context.drawImage(imageObj[number], destXObj[number], destYObj[number]);
			
			context.drawImage(imagePlayer, smallX,0,50,67,destX,destY,50,67);
			/* sourceX, sourceY, sourceWidth, sourceHeight, destX, destY, destWidth, destHeight */

			context.beginPath();
			  context.fillStyle = "white";
			  context.font = "bold 16px Arial";
			  
			  
			  for (i=1;i<=3;i++)
			  
			  {
			  x=i+((number-1)*3);
			  context.fillText(message[x], 100, 100 + x*20);
		
			  }
			  
			  
			  
			  
			  
			  
			context.closePath();		
	
		}
    
