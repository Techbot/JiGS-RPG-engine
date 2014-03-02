<?php defined( '_JEXEC' ) or die( 'Restricted access' );
  $now=time();
?>
<div id="slider-id" class="liquid-slider">
	
<?php

$land=1;
//	for ($land = 1 ; $land <= 8 ;$land++)
//	{
	$status = $this->fields->status_field[$land];
    ?>
    
    
	<div>
	    <h2 class="title">Field <?php echo $land ?>(@ 0)</h2>
	    
	    <!-- gets injected not turned on or off -->
	    
	    
	     <div id ="message_text_<?php echo $land ?>" style="visibility: visible;">Status: Field is Barren. Click to begin Tilling.</div>
	    
	  <!-- end of injection -->  
	  
	  
<?php //////////////////////////////////////////////////////////////////////////// ?>

<?php //////////////////////////////////////////////////////////////////////////// ?>
	  
	  
   
	    <div id = "status_message_<?php echo $land ?>" style = "visibility: visible;"> 	    
	    
	        <div id = "<?php echo $land ?>" class="work_field" style="text-align:center;">
	        
	            <a href="#" class = "field" ><img src="/components/com_battle/images/<?php echo $status; ?>.gif"></a>
	              </div>
	    </div>

<?php //////////////////////////////////////////////////////////////////////////// ?>

<?php //////////////////////////////////////////////////////////////////////////// ?>

	   <div id="farm_progress_<?php echo $land ?>" style='visibility: visible;'>
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
                <span id="remaining"> </span>secs
            </div>
	  </div>
 
	<!-- end of farm_progress -->

<?php //////////////////////////////////////////////////////////////////////////// ?>



<?php //////////////////////////////////////////////////////////////////////////// ?>





		<div class='clear'></div>
	</div>
<?php // } ?>

</div>

