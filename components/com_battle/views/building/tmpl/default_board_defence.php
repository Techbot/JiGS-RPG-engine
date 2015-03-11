<div class="name">Defence Systems Control</div>

<form class="primary_0" action="index.php" method="get" name="adminForm_0" id= "adminForm_0">	

<h2>: <span id = 'assign_defence_cp'><?php echo $this->building_hobbit_stats->defence; ?></span>:</h2>

<span id= "assign_defence" class="assign button btn btn-success">Assign Hobbit to building defence:</span>
<span id= "remove_defence" class="remove remove button btn btn-danger">Remove Hobbit from building defence:</span>


</form>	
<br />

<img src ="components/com_battle/images/buildings/fencing.jpg">
<img src ="components/com_battle/images/buildings/gatling-gun.jpg">
<img src ="components/com_battle/images/buildings/tower.jpg">
<img src ="components/com_battle/images/buildings/zombiedetector.jpg">
<img src ="components/com_battle/images/buildings/dog.jpg">
<img src ="components/com_battle/images/buildings/landmines.jpg">

<script type='text/javascript'>

// Creates canvas 640 × 480 at 10, 50
//var r = Raphael(640, 480, 10,50 );


// Creates pie chart at with center at 320, 200,
// radius 100 and data: [55, 20, 13, 32, 5, 1, 2]
 //r.piechart(150, 50, 50, [55, 20, 13, 32, 5, 1, 2]);


// Creates canvas 640 × 480 at 10, 50
// var s = Raphael(10, 50, 1, 1);
// Creates pie chart at with center at 320, 200,
// radius 100 and data: [55, 20, 13, 32, 5, 1, 2]
// 

//Creates canvas 320 × 200 at 10, 50
var paper = Raphael("defence", 150, 100);

paper.piechart(50, 50, 50, [33, 33, 33 ]);


//var circle = paper.circle(50, 40, 10);
// circle.attr("fill", "#333");
// Creates circle at x = 50, y = 40, with radius 10
// var circle = paper.circle(50, 40, 10);
// Sets the fill attribute of the circle to red (#f00)
// circle.attr("fill", "#f00");


// Sets the stroke attribute of the circle to white
// circle.attr("stroke", "#fff");


        </script>
