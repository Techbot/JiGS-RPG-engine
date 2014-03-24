 <?php defined( '_JEXEC' ) or die( 'Restricted access' );
 $now = time();
?>
<?php // echo $this->buildings->type ; ?>





<?php //<div id="slider-id" class="liquid-slider"--> ?>
	<div class="mine"><!--instead of above div with id -->		
			    <!--h2 class="title">Mine(@ 0)</h2-- need this for liquid slider-->					
				
				 <?php
				// print_r ($x);
				echo $this->loadTemplate ('mine_drill'); 
				?> 	
			

				<ul>
					<li><span class="label">Number of Employees:</span> 7</li>
					<li><span class="label">Employees Morale:</span> 70%</li>
					<li><span class="label">Employee Efficiency:</span> 95%</li>
				</ul>
				
    </div>
  