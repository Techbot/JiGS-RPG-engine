
<div class="name">Primary Systems Control</div>

<!--Stat Points    <- 3 ->  <br />-->
<form class="primary_0" action="index.php" method="get" name="adminForm_0" id= "adminForm_0">
<label title="Allocate available stats points" for="quantity_adjust">Upgrade:</label>

<h2>:<span id = 'assign_primary_cp'> <?php echo $this->building_hobbit_stats->primary; ?></span>:</h2>

<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="1" style="width:10px;"  />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" onclick = "var qty_el = document.getElementById('primary_quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4" onclick = "var qty_el = document.getElementById('primary_quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty ) & qty > 0 ) qty_el.value--;return false;" />

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

<span id= "assign_primary" class="assign btn btn-success">Assign Hobbit</span>
<span id= "remove_primary" class="remove btn btn-danger">Remove Hobbit</span>
