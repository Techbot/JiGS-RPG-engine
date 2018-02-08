
<div class="apt">

<ul class="inline">
	<li id="building_id">
<span class="label">Room id</span>

	<?php echo $this->room; ?>
		</li>
	<li id="flat">
<span class="label">Building id</span>
	
	<?php echo $this->building; ?>
		</li>	
	
</ul>


<div id="leave">Leave Apartment</div>

<div id="inventory">

	<div class="stand_left">
	<div class="name">In Storage</div>
		<div id="building_inventory_table">
			
				
		</div>

	</div>
<!--	end of left -->

	<div class="stand_right">
	<div class="name">Backpack</div>
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
