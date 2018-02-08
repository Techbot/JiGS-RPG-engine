
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


    


<div id="factory_noob" class="sample">
<div class="mask3">
<div id="box4">
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

		
