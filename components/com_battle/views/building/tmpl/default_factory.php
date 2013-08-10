
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
 
	$blueprints = $this->blueprints;
	$x=count($this->blueprints);
	$index= $x+1;
	$now=time();
	
 /*  $arr = new object;

           $arr[id] = 0;
           $arr[object] = 0;
           $arr[user_id] = 63;
           $arr[sell_price] = 1;
           $arr[name] = 'Select';
           $arr[description] = 'Select';
           $arr[metal_1] = 0;
           $arr[quantity_1] = 0;
           $arr[metal_2] = 0;
           $arr[quantity_2] = 0;
           $arr[metal_1_name] = 'Kryptonite';
           $arr[metal_2_name] = 'Carbon';
           $arr[metal_1_stock] = 0;
           $arr[metal_2_stock] = 0;
           
           */

   //        echo '<pre>';
  //        print_r($factories);
  //        echo '</pre>';
  //        exit();
           
//$factories = array_unshift_assoc( $factories , '' , $arr);

//$factories[$index]='Select';

	function array_unshift_assoc(&$arr, $key, $val)
	{
	$arr = array_reverse($arr, true);
	$arr[$key] = $val;
	return  array_reverse($arr, true);
	}
	$javascript			= 'onchange="change();"';
	$directory			= '/images/banners';
	$lists['blueprints']	=  JHTML::_('select.genericlist', $this->blueprints , 'blueprints',$javascript, 'id', 'name' );

?>

<div id="factory_noob" class="sample">
<div class="mask3">
<div id="box4">
<div>
<div id='conveyor_progress' style='visibility: hidden;'>
<p>
<label title="when manufactoring began">Started: </label><span id="since"></span></p>
<p>
<label>Current Time: </label><span id="now"><?php echo date('l jS \of F Y h:i:s A',$now) ; ?></span>
</p>
<div id="time_elapsed" class='wrapper sec'>
<label title="since manufactoring began">Time Elapsed: </label> <span id="elapsed"> </span> secs
</div>

<div id="time_remaining" class='wrapper sec'>
<label title="until manufactoring is complete">Time Remaining: </label>
<span id="remaining"> </span>secs
</div>

</div>
<!-- end of conveyor_progress -->
<h3>Conveyor 1</h3>
<?php
// print_r ($x);

?>
<form class="conveyor" action="index.php" method="get" name="adminForm" id="adminForm"><fieldset class="object">

<legend>Object</legend>

<input type="text" title="Object ID" name="id1" id="id1" value = "1" size="2" style="width: 10px;" maxlength="2" 
readonly="readonly" />


<?php echo '' .  $lists['blueprints'] . '';?>


<label title="Quantity of Objects Required" for="quantity_adjust">qty:</label>

<input type="text" id="quantity_adjust" name = "quantity_adjust" value = "0" style = "width:20px;" size="2" onchange = "alterQuantity(this.form)" /> 

<input title="Increase Quantity" type="button" id="quantity_box_button_up" value="+" size="4" /> 

<input title="Decrease Quantity" type="button" id="quantity_box_button_down" value="-" size="4" /> 

<label title="Time To Manufacture Required" >Time:</label>
<input type="text" id="time" name="time" readonly='readonly' value="<?php echo $blueprints[0]->man_time ;?>" style="width:20px;" size="2" onchange="alterQuantity(this.form)" /> 

<span title="Start Manufacturing" id='submit_c'>Submit</span>
</fieldset>

<fieldset class="metal">

						<legend title="What the object is made from">Material</legend>

<fieldset>
<label title="Type of Metal required" for="n1">Metal:</label> 
<input class="inputbox" type="text" size="4" maxlength="6" name="n1" id="n1" style="width: 70px;" value="<?php echo $blueprints[0]->metal_1_name ;?>" /> 

<label title="Units per Object" for="q1">units:</label> 
<input class="inputbox" type="text" size="1" maxlength="2" name="q1" id="q1" style="width: 20px;" value="<?php echo $blueprints[0]->quantity_1 ;?>" /> 

<label title="Total Units" for="q1t">total:</label>
 <input class="inputbox" type="text" size="1" maxlength="2"  name="q1t" id="q1t" style="width: 20px;" /> 

 <label title="In Stock" for="stock">In Stock:</label>
<input class="inputbox" type="text" size="1" maxlength="2" value="<?php echo $blueprints[0]->metal_1_stock ;?>" name="stock" id="stock"  style="width: 20px;" />
 </fieldset>

<fieldset>
<label title="Type of Metal required" for="n2">Metal:</label>
<input class="inputbox" type="text" size="4" maxlength="6" name="n2" id="n2" style="width: 70px;" value="<?php echo $blueprints[0]->metal_2_name ;?>" /> 
 
 
 <label title="Units per Object" for="q2" >units:</label>
  <input class="inputbox" type="text" size="1" maxlength="1" name="q2" id="q2" style="width: 20px;" value="<?php echo $blueprints[0]->quantity_2 ;?>" /> 

  
  <label title="Total Units" for="qt2" >total:</label>
<input class="inputbox" type="text" size="1" maxlength="2"  name="q2t" id="q2t" style="width: 20px;"  />


<label title="In Stock" for="stock2">In Stock:</label> 
<input class="inputbox" type="text" size="1" maxlength="2" name="stock2" id="stock2"  style="width: 20px;" value="<?php echo $blueprints[0]->metal_2_stock ;?>" />

</fieldset>

					</fieldset>
					<input type="hidden" name="c" value="banner" /> <input
						type="hidden" name="id" value="" /> <input type="hidden"
						name="name" value="" /> <input type="hidden" name="task" value="" />
				</form>

			</div>
			<div>
				<h3>Conveyor 2</h3>
				<div id="meter">

					<img src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg">
				</div>
				<!--end of meter-->
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>

			</div>

			<div>
				<h3>Conveyor 3</h3>
				<ul>
					<li>Number of Employees: 7</li>
					<li>Employees Morale: 70%</li>
					<li>Employee Efficiency: 95%</li>
				</ul>
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

			<div>
				<h3>Conveyor 4</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img4.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

			<div>
				<h3>Conveyor 5</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img5.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>

			</div>

			<div>
				<h3>Conveyor 6</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img6.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>

			</div>

			<div>
				<h3>Conveyor 7</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img7.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>

			</div>

			<div>
				<h3>Conveyor 8</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img8.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

		</div>
	</div>
	<p class="buttons" id="handles4">
		<span title="Conveyor 1">C 1</span> <span title="Conveyor 2">C 2</span>
		<span title="Conveyor 3">C 3</span> <span title="Conveyor 4">C 4</span>
		<span title="Conveyor 5">C 5</span> <span title="Conveyor 6">C 6</span>
		<span title="Conveyor 7">C 7</span> <span title="Conveyor 8">C 8</span>
	</p>
</div>

		
