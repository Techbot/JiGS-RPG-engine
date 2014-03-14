<!--<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.css" type="text/css" />-->





<div class="apt">



<table id="room_stats">
	<tr>
		<td>
<span class="label">room</span>
		</td>
		<td>
	<?php echo $this->room; ?>
		</td>
	</tr>
	
	<tr>
		<td>
<span class="label">room</span>
		</td>
		<td>
	<?php echo $this->building; ?>
		</td>
	</tr>	
	
	
	
</table>

<div id="leave">Leave Apartment</div>

<div id="inventory">

	<div class="stand_left">

		<div id="building_inventory_table">
			
				
		</div>

	</div>
<!--	end of left -->

	<div class="stand_right">

		<div id="my_inventory">
		</div>

	</div>
	<!-- end of middle -->



	</div>
		<!-- end of inventory -->








</div>

















<script type='text/javascript'>

function leave()
{
		document.id('leave').addEvent('click', function()
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
 
 
 
 
 
 				var head = document.getElementsByTagName('head')[0];
				script = document.createElement('script');
				script.type = "text/javascript";
				script.src = '<?php echo $this->baseurl; ?>/components/com_battle/includes/room.js';  
				head.appendChild(script);
 
 

 
 
 
 
 
 
 
 
 
</script>
