<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>


<div id="inventory" class="weapons">

	<div class="stand_left">

	<div class="name">Building Weapons Inventory</div>

		<div id="building_inventory_table">
		
		
		</div>

	</div>
	<!--end of left -->


	<div class="stand_right">
	
	<div class="name">My Inventory</div>
	
		<div id="my_inventory">
		
		
		</div>

	</div>
	<!-- end of right -->
	
	
</div><!--end inventory-->



<script type='text/javascript'>


 request_shop_weapons();
 //request_weapons2();
 request_weapons.periodical(1000);		
 		




function buy_weapon(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy_weapon&building_id=<?php echo $this->buildings->id; ?>&item=" + itemID, 
    onSuccess: function(result){
    	    
    	}
    }).get();
 
}
function sell_weapon(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_weapon&building_id=<?php echo $this->buildings->id; ?>&item=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}


</script>

