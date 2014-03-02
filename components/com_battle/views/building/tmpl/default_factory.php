
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
 
	$blueprints = $this->blueprints;
	$x = count($this->blueprints);
	$index = $x+1;
	$now = time();
	
<<<<<<< HEAD
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


=======
/*
>>>>>>> upstream/master
	function array_unshift_assoc(&$arr, $key, $val)
	{
	$arr = array_reverse($arr, true);
	$arr[$key] = $val;
	return  array_reverse($arr, true);
	}
*/	
	
	
	$javascript			= 'onchange="change();"';
	$directory			= '/images/banners';
<<<<<<< HEAD
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

<input type="text" title="Object ID" name="id1" id="id1" value = "" size="2" style="width: 10px;" maxlength="2" 
readonly="readonly" />


<?php echo '' .  $lists['blueprints'] . '';?>


<label title="Quantity of Objects Required" for="quantity_adjust">qty:</label>
=======
>>>>>>> upstream/master


if (isset ($this->blueprints)){


	$this->lists['blueprints']	=  JHTML::_('select.genericlist', $this->blueprints , 'blueprints',$javascript, 'id', 'name' );

}


?>

<div id="slider-id" class="liquid-slider">

			<div>
				<?php 
					echo $this->loadTemplate ('factory_conveyer_progress');
					
					if(isset($this->blueprints))
					{
						echo $this->loadTemplate ('factory_conveyer_1');
					}
					else
					{
						echo "<br>You need to buy some blueprints to activate the conveyers<br><br><br><br><br><br>";
					}
				?>
			</div>
			
			<div>
				<h2 class="title">C2</h2>
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
				<h2 class="title">C3</h2>
				<ul>
					<li>Number of Employees: 7</li>
					<li>Employees Morale: 70%</li>
					<li>Employee Efficiency: 95%</li>
				</ul>
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

			<div>
				<h2 class="title">C4</h2>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img4.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

			<div>
				<h2 class="title">C5</h2>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img5.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

			<div>
				<h2 class="title">C6</h2>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img6.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

			<div>
				<h2 class="title">C7</h2>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img7.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

			<div>
				<h2 class="title">C8</h2>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img8.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

</div>

		
