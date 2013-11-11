<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<div id="crystals_board" class="clearfix">
	<div class="name">Battery Cells
	<div id="buy_battery"  class="buy_battery"><a href="#">Buy</a></div>
	<div id="sell_battery" class="sell_battery"><a href="#">Sell</a></div>
	</div>
</div>
<script type='text/javascript'>
$$('.buy_battery' ).addEvent('click', function(){ buy_battery();  });
$$('.sell_battery').addEvent('click', function(){ sell_battery(); });			
			
function buy_battery(itemID){
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=buy_battery&building_id=<?php echo $this->buildings->id ; ?>",
		onSuccess: function(result){
		}
	}).get();
}

function sell_battery(itemID){
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=sell_battery&building_id=<?php echo $this->buildings->id ; ?>",
		onSuccess: function(result){
		}
	}).get();
}   
</script>
