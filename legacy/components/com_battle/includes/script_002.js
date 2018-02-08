
alert ("bounce");


// requestAnim shim layer by Paul Irish
    window.requestAnimFrame = (function(){
      return  window.requestAnimationFrame       || 
              window.webkitRequestAnimationFrame || 
              window.mozRequestAnimationFrame    || 
              window.oRequestAnimationFrame      || 
              window.msRequestAnimationFrame     || 
              function(/* function */ callback, /* DOMElement */ element){
                window.setTimeout(callback, 1000 / 60);
              };
    })();

var paper	=	Raphael('holder',598, 480);  
var x		=	1;
var y		=	12;
var dirx	=	1;
var diry	=	1;
var circle = paper.circle(10, 10, 10);  
	circle.attr("fill", "#ffff00");
	circle.attr("stroke", "#ffff00");

 //window.onload=function() {
	alert('Welcome!');
//function init() {
    canvas = document.createElement( 'canvas' );
    canvas.width = 598;
    canvas.height = 400;
    context = canvas.getContext( '2d' );
    context.font = "40pt Calibri";
    context.fillStyle = "black";
	// align text horizontally center
	context.textAlign = "center";
	// align text vertically center
	context.textBaseline = "middle";	
	context.font = "12pt Calibri"; 
	canvas.width = 6186;
	context.drawImage(background_obj, backg_x, backg_y);
 	imageData = context.getImageData(0,0,6186,300);
 	//var x = document;
    canvas.width = 568;
    $( "#container" ).append( canvas );
//}
animate();
function animate() {
    requestAnimFrame( animate );
   
    draw();
}

function draw(){
	
	// Raphael.animation(params, ms)
	// circle.animate({arc: [x, 300, 10]}, 750, "elastic");
	circle.animate({"cx":x,"cy":y},5,"linear");

	x = x + dirx;
	y = y + diry;

	if ( y == 480 || y== 0){
	diry = -diry;
	}
	if ( x == 620|| x == 0){
	dirx = -dirx;
	}
}


