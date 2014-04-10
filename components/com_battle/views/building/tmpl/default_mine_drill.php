<?php

$now= time();

// echo $this->mines['timestamp'];



 if ($this->mines['timestamp'] !=0 )

 { ?>
	<div id="mine_board1" style="display:none;">
		
<?php } 





else { ?>
	<div id="mine_board1" style="display:block;">
	
		<?php } ?>	
	
		
		<p style="text-align:center"><strong>Mine for:</strong></p>
		<a href="#" class="mine" type= "1"><img title="Crystal" width ="100px" src="<?php echo $this->baseurl ?>/components/com_battle/images/crystal.jpg"></a>
		<a href="#" class="mine" type= "2"><img title="Metal"  width ="100px" src="<?php echo $this->baseurl ?>/components/com_battle/images/metal.jpg"></a>
		<a href="#" class="mine" type= "3"><img title="Fuel"  width ="100px" src="<?php echo $this->baseurl ?>/components/com_battle/images/fuel.jpg"></a>
	
		
	

</div>


<?php if ($this->mines['timestamp'] != 0 )
 { ?> 
<div id ="mine_progress1" style="display:block;">
<?php }
 else{ ?>
<div id ="mine_progress1" style="display:none;">
<?php  } ?>



<p><label title="when mining began">Started: </label><span id ="since"></span></p>
<p><label>Current Time: </label><span id ="now"><?php echo date('l jS \of F Y h:i:s A',$now) ; ?></span></p>

<div id="time_elapsed" class = 'wrapper sec'>
<label title="since mining began">Time Elapsed: </label>
<span id ="elapsed"> </span> secs</div> 

<div id="time_remaining" class = 'wrapper sec'>
<label title="until mining is complete">Time Remaining: </label>
<span id ="remaining"> </span>secs</div>


</div> <!-- end of mine_progress -->
