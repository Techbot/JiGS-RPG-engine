<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>


<div id="inventory" style="width:49%;float:left;">

<div class="name">Building Weapons Inventory</div>

<table id="building_inventory_table" class="shade-table">
<tbody>
<tr></tr>
</tbody>
</table>

</div>

<div id="inventory" style="width:49%;float:right;">

<div class="name">My Inventory</div>

<table id="my_inventory" class="shade-table">
<tbody>
<tr></tr>
</tbody>
</table>

<table id="my_inventory2" class="shade-table">
<tbody>
<tr></tr>
</tbody>
</table>

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

