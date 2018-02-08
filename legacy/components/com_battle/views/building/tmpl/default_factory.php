
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
 
	$blueprints = $this->blueprints;
	$x = count($this->blueprints);
	$index = $x+1;
	$now = time();


	
	$javascript			= 'onchange="change();"';
	$directory			= '/images/banners';

	$lists['blueprints']	=  JHTML::_('select.genericlist', $this->blueprints , 'blueprints',$javascript, 'id', 'name' );


?>

<div class="factory">


<?php
// print_r ($x);

if (isset ($this->blueprints)){

	$this->lists['blueprints']	=  JHTML::_('select.genericlist', $this->blueprints , 'blueprints',$javascript, 'id', 'name' );

}

?>

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
