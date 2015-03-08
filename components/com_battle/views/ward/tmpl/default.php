 <link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.css" type="text/css" />
<p>
You are in a recovery ward. You were found beaten to a pulp. 
Everything you had on you was taken. 
You apparently have no insurance so we took a pint of blood as payment.</p>

<div class="ward_bg">

<div id="leave">Check Out</div>

</div>

<script type='text/javascript'>


function leave()
{
	
		$('leave').addEvent('click', function()
		{
		
				var a = new Request.JSON({
					url: "index.php?option=com_battle&format=raw&task=action&action=leave_room", 
					onSuccess: function(result)
					{
			   	    	
						location.href = 'index.php?option=com_battle&amp;view=phaser&amp;Itemid=115';
		 
					}
			}).get();
		});
}
leave();
</script>
