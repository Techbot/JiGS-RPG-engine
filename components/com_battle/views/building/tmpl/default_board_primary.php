Stat Points    <- 3 ->  <br />







<form class="primary_0" action="index.php" method="get" name="adminForm_0" id= "adminForm_0">	

<label title="Primary System Upgrade" for="quantity_adjust">Primary System Upgrade:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="1" style="width:10px;" />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4"  />

<label title="Primary System Capacity" for="quantity_adjust">Primary System Capacity:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="1" style="width:10px;" />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4"  />

</form>	

This is the primary board
		<div id="test" style ="background-color:black;">
</div>
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
var paper = Raphael("test", 150, 150);

paper.piechart(50, 50, 50, [55, 20, 13, 32, 5, 1, 2]);


//var circle = paper.circle(50, 40, 10);
// circle.attr("fill", "#333");
// Creates circle at x = 50, y = 40, with radius 10
// var circle = paper.circle(50, 40, 10);
// Sets the fill attribute of the circle to red (#f00)
// circle.attr("fill", "#f00");
localStorage.lastname="Smith";
document.getElementById("result").innerHTML="Last name: " + localStorage.lastname; 

// Sets the stroke attribute of the circle to white
// circle.attr("stroke", "#fff");
</script>





