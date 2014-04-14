	<?php 
	$now = time();
	
	?>
	
	
	
<div id='conveyor_progress' style='display: none;'>

    <p>
    <label title="when manufactoring began">Started: </label><span id="since"></span></p>
    <p>
    <label>Current Time: </label><span id="now"><?php echo date('l jS \of F Y h:i:s A', $now) ; ?></span>
    </p>

    <div id="time_elapsed" class='wrapper sec'>
        <label title="since manufactoring began">Time Elapsed: </label> <span id="elapsed"> </span> secs
    </div>

    <div id="time_remaining" class='wrapper sec'>
        <label title="until manufactoring is complete">Time Remaining: </label><span id="remaining"> </span>secs
    </div>

</div>



