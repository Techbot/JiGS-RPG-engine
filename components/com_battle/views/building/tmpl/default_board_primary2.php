<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/g.raphael-min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/g.pie-min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/g.line-min.js"></script>

Stat Points    =- 3 -=   <br />



<form class="primary_0" action="index.php" method="get" name="adminForm_0" id= "adminForm_0">	
<label title="Primary System Upgrade" for="quantity_adjust">Primary System Upgrade:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="1" />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4"  />


</form>	

This is the primary board

<script type='text/javascript'>

// Creates canvas 640 × 480 at 10, 50
var r = Raphael(10, 50, 1, 1);
// Creates pie chart at with center at 320, 200,
// radius 100 and data: [55, 20, 13, 32, 5, 1, 2]
// r.g.piechart(10, 10, 20, [55, 20, 13, 32, 5, 1, 2]);


//Creates canvas 640 × 480 at 10, 50
var s = Raphael(10, 50, 1, 1);
// Creates pie chart at with center at 320, 200,
// radius 100 and data: [55, 20, 13, 32, 5, 1, 2]
s.g.line(10, 10, 20, [55, 20, 13, 32, 5, 1, 2]);



</script>
