<div class="name">Hobbit Resources Systems Control</div>

<form class="primary_0" action="index.php" method="get" name="adminForm_0" id= "adminForm_0">	

<label title="Primary System Upgrade" for="quantity_adjust">Upgrade:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="1" style="width:10px;"  />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" onclick = "var qty_el = document.getElementById('primary_quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4" onclick = "var qty_el = document.getElementById('primary_quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) qty_el.value--;return false;" />

<hr />
<label title="Primary System Capacity" for="quantity_adjust">Transfer Rate:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="2" style="width:10px;" />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4"  /> <br />

<label title="Primary System Capacity" for="quantity_adjust">Energy Efficiency:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="1" style="width:10px;" />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4"  /><br />


<label title="Primary System Capacity" for="quantity_adjust">Output Quality:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="3" style="width:20px;" />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4"  /><br />

</form>	
<br />
<div id="defence" style ="background-color:black;">
</div>


    <div id="hr"></div>


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
var paper = Raphael("hr", 150, 100);

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
 
    







</script>





