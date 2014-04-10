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
			
<?php echo $this->loadTemplate ("hobbit_workforce"); ?>
		<?php echo $this->loadTemplate ("timebar"); ?>
		
				
    </div>
  
