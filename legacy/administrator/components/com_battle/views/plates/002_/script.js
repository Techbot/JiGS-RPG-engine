	

	

	var canvas = document.getElementById("myCanvas");
	var context = canvas.getContext("2d");
		
	var imageBgObj = new Image();

	imageBgObj.src = "bg.jpg";
	draw();
	
	function draw(){
		context.drawImage(imageBgObj, 0, 0, 640, 480);
	}
    
	