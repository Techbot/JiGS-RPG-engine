<?php if ($this->mines[timestamp] !=0 ){ ?>
<div id="mine_board" style="visibility:hidden;">
<?php } 
else { ?>
<div id="mine_board" style="visibility:visible;">
<div>
<a href="#" class="mine" type= "1"><img title="Crystal" src="<?php echo $this->baseurl ?>/components/com_battle/images/crystal.png"></a>
<a href="#"class="mine" type= "2"><img title="Metal" src="<?php echo $this->baseurl ?>/components/com_battle/images/metal.png"></a>
<a href="#"class="mine" type= "3"><img title="Fuel" src="<?php echo $this->baseurl ?>/components/com_battle/images/fuel.png"></a>
</div>
<?php } ?>	
</div>


<?php if ($this->mines[timestamp] != 0 ) { ?> 
<div id ="mine_progress" style="visibility:visible;">
<?php }
 else{ ?>
<div id ="mine_progress" style="visibility:hidden;">
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