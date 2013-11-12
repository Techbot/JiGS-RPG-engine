<!--<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.css" type="text/css" />-->
<div class="apt_bg">

<div id="leave">Leave Apartment</div>

</div>

<script type='text/javascript'>

function leave()
{
		$('leave').addEvent('click', function()
		{
			var a = new Request.JSON(
			{
				url: "index.php?option=com_battle&format=raw&task=action&action=leave_room", 
				onSuccess: function(result)
				{
					location.href = 'index.php?option=com_battle&view=single';
				}
			}).get();
		});
}

leave();
 
</script>
