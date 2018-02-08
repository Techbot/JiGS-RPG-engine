// code inside $(function(){} will run after the DOM is loaded and ready

$(function(){
// listen to the key down event
$(document).keydown(function(e){
switch(e.which){
case KEY.UP: // arrow-up
// get the current paddle B's top value in Int type
var top = parseInt($("#paddleB").css("top"));
// move the paddle B up 5 pixels
$("#paddleB").css("top",top-5);
break;
case KEY.DOWN: // arrow-down
var top = parseInt($("#paddleB").css("top"));
// move the paddle B down 5 pixels
$("#paddleB").css("top",top+5);
break;
case KEY.W: // w
var top = parseInt($("#paddleA").css("top"));
// move the paddle A up 5 pixels
$("#paddleA").css("top",top-5);
break;
case KEY.S: // s
var top = parseInt($("#paddleA").css("top"));
// move the paddle A drown 5 pixels
$("#paddleA").css("top",top+5);

break;
}
});
});

