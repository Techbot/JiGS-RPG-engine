
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
 
	$blueprints = $this->blueprints;
	$x = count($this->blueprints);
	$index = $x+1;
	$now = time();


	
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







if (isset ($this->blueprints)){


	$this->lists['blueprints']	=  JHTML::_('select.genericlist', $this->blueprints , 'blueprints',$javascript, 'id', 'name' );

}


?>

<!--div id="slider-id" class="liquid-slider"-->

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
		<?php echo $this->loadTemplate ("hobbit_workforce"); ?>
		<?php echo $this->loadTemplate ("timebar"); ?>
				<div id="meter">
					<img src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg">
				</div>
				<!--end of meter-->
						<ul>
					<li>Number of Employees: 7</li>
					<li>Employees Morale: 70%</li>
					<li>Employee Efficiency: 95%</li>
				</ul>
				
			</div>

		

<!--/div-->

		
