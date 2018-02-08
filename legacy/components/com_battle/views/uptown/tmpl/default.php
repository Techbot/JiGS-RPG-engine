<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<title>Ping Pong</title>
<style>
#playground{
background: #e0ffe0 url(http://46.19.37.66/components/com_dojogames/views/pingpong/images/pixel_grid.jpg);

width: 400px;
height: 200px;
position: relative;
overflow: hidden;
}
#ball {
background: #fbb;
position: absolute;
width: 20px;
height: 20px;
left: 150px;
top: 100px;
border-radius: 10px;
}
.paddle {
background: #bbf;
left: 50px;
top: 70px;
position: absolute;
width: 30px;
height: 70px;
}

#paddleB {
left: 320px;
}
</style>


</head>
<body>
<header>
<h1>Ping Pong</h1>
</header>



<div id="scoreboard">
<div class="score">Player A : <span id="scoreA">0</span></div>
<div class="score">Player B : <span id="scoreB">0</span></div>
</div>






<div id= 'center' style = "margin:0 auto; border:1px;">  <!-- centre -->

<div id="game">
<div id="playground">
<div id="paddleA" class="paddle"></div>
<div id="paddleB" class="paddle"></div>
<div id="ball"></div>
</div>
</div>
<div id ="numbers"> </div>




<footer>
This is an example of creating a Ping Pong Game.
</footer>
<script src="http://46.19.37.66/components/com_dojogames/views/jquery-1.7.1.min.js"></script>

<script src="http://46.19.37.66/components/com_dojogames/views/pingpong/js/html5games.pingpong.js"></script>


<script>
$(function(){
alert("Welcome to the Ping Pong battle.");
});
</script>
</div> <!-- /centre -->
</body>
</html>
