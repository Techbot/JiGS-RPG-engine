<?php defined( '_JEXEC' ) or die( 'Restricted access' );
  $now=time();
?>
<!--div id="slider-id" class="liquid-slider"-->
	
<?php

$land=1;
//	for ($land = 1 ; $land <= 8 ;$land++)
//	{
	$status = $this->fields->status_field[$land];
    ?>
    
    
	<div class="subsection" style="float:left;width:80%;">
	    <h2 style="display:none"<!--remove this to enable slider--> class="title">Field <?php echo $land ?>(@ 0)</h2>
	    
	    <!-- gets injected not turned on or off -->
	    
	   

 
	     <div id = "message_text_<?php echo $land ?>" >Status: </div>
	    
	  <!-- end of injection -->  

	    
	        <div id = "<?php echo $land ?>" class="work_field" style="text-align:center;">
	        
	            <a href="#" class = "field" ><img src="components/com_battle/images/<?php echo $status; ?>.gif"></a>
	              </div>
	          

<?php //////////////////////////////////////////////////////////////////////////// ?>



<?php //////////////////////////////////////////////////////////////////////////// ?>

	   <div id="farm_progress_<?php echo $land ?>" style='display: none;'>
	        <!--img src ="components/com_battle/images/5.gif"/-->
            <label title="when manufactoring began">Started: </label>
            <span id="since"></span>
            <label>Current Time: </label>
            <span id="now"><?php echo date('l jS \of F Y h:i:s A',$now) ; ?></span>
	        <div id="time_elapsed" class='wrapper sec'>
	                <label title="since manufactoring began">Time Elapsed: </label>
	                <span id="elapsed"> </span> secs
	        </div>
	            
            <div id="time_remaining" class='wrapper sec'>
                <label title="until manufactoring is complete">Time Remaining: </label>
                <span id="remaining"> </span>Minutes
            </div>
	  </div>
 
	<!-- end of farm_progress -->

<?php //////////////////////////////////////////////////////////////////////////// ?>
 

<div id = "farm_controls_<?php echo $land ?>" style='display: block;'>

<?php

	$crops = $this->crop_types;
	$x = count($this->crop_types);
	$index = $x+1;
	$now = time();
	
/*
	function array_unshift_assoc(&$arr, $key, $val)
	{
	$arr = array_reverse($arr, true);
	$arr[$key] = $val;
	return  array_reverse($arr, true);
	}
*/	
	
	
	$javascript			= 'onchange="changeCrops();"';
	$directory			= '/images/banners';


if (isset ($this->crop_types))
{
	$this->lists['crops']	=  JHTML::_('select.genericlist', $this->crop_types , 'crops',$javascript, 'id', 'name' );
}

?>

	<form class="conveyor" action="index.php" method="get" name="adminForm" id="adminForm">


		<div class="field-group">
		<label>Crop Type</label>
		<?php echo '' .  $this->lists['crops'] . '';?>



		<?php echo $this->loadTemplate ("hobbit_workforce"); ?>

		<?php echo $this->loadTemplate ("timebar"); ?>

				<ul class="inline">
					<li>Number of Employees: 7</li>
					<li>Employees Morale: 70%</li>
					<li>Employee Efficiency: 95%</li>
				</ul>

		 
		  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
		  <input type="hidden" name="option" value="<?php echo $option;?>" />
		  <input type="hidden" name="controller" value="buildings" />
		  <input type="hidden" name="task" value="not_withdraw" />
		  
		</div>


	</form>



<?php //////////////////////////////////////////////////////////////////////////// ?>


<div class='clear'></div>

</div>

<?php // } ?>

</div>



<div id = 'hobbit_names' style="float:right;width:20%;" >
<?php 
	$i= 1;
	foreach ($this->building_hobbit_stats->hobbitList as $hobbit)
	{
		if ($hobbit->status == 2)
		{
	//print_r($hobbit);
			echo ($hobbit->name . " [remove]<br/>");
		}
		//$i++;
	}
?>


</div>
