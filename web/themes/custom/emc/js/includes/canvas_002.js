

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
var dirx	=	10;
var diry	=	10;

    canvas = document.createElement( 'canvas' );
    canvas.width = 568;
    canvas.height = 400;
    context = canvas.getContext( '2d' );
    context.font = "40pt Calibri";
    context.fillStyle = "black";
	// align text horizontally center
	context.textAlign = "center";
	// align text vertically center
	context.textBaseline = "middle";	
	context.font = "12pt Calibri"; 

    canvas.width = 568;


 paper.text(300, 50, "first very very long line\nshort line").attr(
            {"font-family":"arial", 
            "font-size":"30",
            "text-align":"left",
            "font-color":"white"
           }
            );
animate();

function animate() {
    requestAnimFrame( animate );
      draw();
}

function draw(){

	
    paper.customAttributes.hue = function (num) {
    num = num % 1;
    return {fill: "hsb(" + num + ", 0.75, 1)"};
};
// Custom attribute “hue” will change fill
// to be given hue with fixed saturation and brightness.
// Now you can use it like this:
var c = paper.circle(x, y, 10).attr({hue: .45});
// or even like this:
c.animate({hue: 1}, 1e3);

// You could also create custom attribute
// with multiple parameters:
paper.customAttributes.hsb = function (h, s, b) {
    return {fill: "hsb(" + [h, s, b].join(",") + ")"};
};
c.attr({hsb: "0.5 .8 1"});
c.animate({hsb: [1, 0, 0.5]}, 1e3);
	
	x = x + dirx;
	y = y + diry;

	if ( y > 480){
	diry = -diry;
	y=480
	}
	
	
	if ( y < 0){
	
	y=0;
	diry = -diry;
	}
	
	
	
	if ( x > 620){
	
	x=620;
	dirx = -dirx;
	}
	
	
	
	
	if ( x < 0){
	dirx = -dirx;
	x=0;
	}
	
}


