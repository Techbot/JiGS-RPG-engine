 <?php defined( '_JEXEC' ) or die( 'Restricted access' );
 $now = time();
?>
<?php // echo $this->buildings->type ; ?>





<?php ?>
	<div class="mine">
	
		<?php
		// print_r ($x);
		echo $this->loadTemplate ('mine_drill'); 
		?> 	
			
		<?php echo $this->loadTemplate ("hobbit_workforce"); ?>
		<?php echo $this->loadTemplate ("timebar"); ?>
		
				
    </div>
  
