
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
 
	$blueprints = $this->blueprints;
	$x = count($this->blueprints);
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
	
	
	$javascript			= 'onchange="change();"';
	$directory			= '/images/banners';


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

		
