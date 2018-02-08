






<div class="canvas_bg" id = "gamecanvas">
    <div id="leave">Log Out</div>
<img class="fluid" src = "/components/com_battle/images/zxmbf2.gif">
</div>

	<script>
	
	leave();
function leave()
{
	
		 document.id('leave').addEvent('click', function()
		{
		
				var a = new Request.JSON({
					url: "index.php?option=com_battle&format=raw&task=action&action=leave_room", 
					onSuccess: function(result)
					{
			   	    	
						location.href = 'index.php?option=com_battle&view=single';
		 
					}
			}).get();
		});
}
</script>
