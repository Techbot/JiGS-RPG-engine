(function()
{
	// requestAnim shim layer by Paul Irish
    window.requestAnimFrame = (function()
    {
        return window.requestAnimationFrame ||
              window.webkitRequestAnimationFrame ||
              window.mozRequestAnimationFrame ||
              window.oRequestAnimationFrame ||
              window.msRequestAnimationFrame ||
              function(/* function */ callback, /* DOMElement */ element){
                window.setTimeout(callback, 1000 / 60);
              };
    })();

	active = 4;
    
	var canvas = document.getElementById("myCanvas");
	var context = canvas.getContext("2d");
	
	var dirX = 1;

	var imageObj = new Image();

	var destX = 260;
	var destY = 50;
	imageObj.src = "/components/com_battle/images/plate/sprite-voodoo-woman.png";


	var imageObj2 = new Image();

	var destX2 = 0;
	var destY2 = 415;
	imageObj2.src = "/components/com_battle/images/plate/walk.png";
	var number=1;


	var imageBgObj= {};	
			
    imageBgObj[1] = new Image();
	imageBgObj[1].src = "/components/com_battle/images/plate/bg.jpg";


    imageBgObj[2] = new Image();
	imageBgObj[2].src = "/components/com_battle/images/plate/np-dream.jpg";

    imageBgObj[3] = new Image();
	imageBgObj[3].src = "/components/com_battle/images/plate/ta-cafe_aubette.jpg";

    imageBgObj[4] = new Image();
	imageBgObj[4].src = "/components/com_battle/images/plate/ty-landscape.jpg";

    imageBgObj[5] = new Image();
	imageBgObj[5].src = "/components/com_battle/images/plate/ty-white.jpg";

    imageBgObj[6] = new Image();
	imageBgObj[6].src = "/components/com_battle/images/plate/ty-waiting.jpg";

    imageBgObj[7] = new Image();
	imageBgObj[7].src = "/components/com_battle/images/plate/ty- surrealist_landscape.jpg";

    imageBgObj[8] = new Image();
	imageBgObj[8].src = "/components/com_battle/images/plate/ty-destroy.jpg";

	var imageGridObj = new Image();
	imageGridObj.src = "/components/com_battle/images/plate/guides50x50.png";
	
	var smallX = 0;
	var pause = 15;
	var framenumber=1;
	var i =1;
	var state = "stop";
    
    leave();
	animate();

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function animate() {
                requestAnimFrame( animate );
                update();
                draw();
        }
		
	
	function update(){
		anim_update ();
		input ();
		
	}
	
	function input()
	{

	    $(document).keyup(function(e)
		{
			if (e.keyCode == 37)
			{
				state= "stop";
				dirX=1;
			}
			if (e.keyCode == 39)
			{
				state= "stop";
				dirX=1;
			}
		});

	    $(document).keydown(function(e)
	    {
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
	   		destX2 = destX2 - (1 * dirX);
        }
        if (state == 'right')
		{
			destX2 = destX2 + (1 * dirX);
	  		
		}
		if (destX2 > canvas.width )
		{
   			destX2 =-50;
			number++;
    	}
		
		if (destX2 < -50 )
		{
   			destX2 =600;
			number--;
    	}
		
		
		if(number==9){
		
			number =1;
		
		}
		
		if(number==0){
		
			number =8;
		
		}
	}
	
	function anim_update()
	{
	    if (state != "stop")
	    {
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
	
	function draw()
	{
        context.drawImage(imageBgObj[number], 0, 0, 600, 482);
	
        //context.drawImage(imageGridObj, 0, 0, 600, 482);
	
        context.drawImage(imageObj, destX, destY);
			
        context.drawImage(imageObj2, smallX,0,50,67,destX2,destY2,50,67);
        /* sourceX, sourceY, sourceWidth, sourceHeight, destX, destY, destWidth, destHeight */
	}
		
	function leave()
    {
        document.id('leave').addEvent('click', function()
		{
            active=1;
            var a = new Request.JSON(
            {
                url: "index.php?option=com_battle&format=raw&task=action&action=leave_room", 
                onSuccess: function(result)
                {
	                location.href = 'index.php?option=com_battle&view=single';
                }
            }).get();
			
		});
    }
})();
