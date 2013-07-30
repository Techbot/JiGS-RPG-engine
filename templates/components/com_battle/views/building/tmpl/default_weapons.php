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
function request_shop_weapons(){
	
	
	
	 var all = '<table class="shade-table"><tbody>';
		var details = this.details;

  	//	var id = $('image').get('number'); 
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_weapons&building_id=<?php echo $this->buildings->id ; ?>", 
    onSuccess: function(result){
       	    	
   for (i = 0; i < result.length; ++ i){
  var row = "<tr class=\"d" + (i & 1) + "\"><td>" + (i+1) + ": " + result[i].name + ":</td><td>$" + result[i].sell_price + "<a href='#' class='buy' id='" + result[i].item_id + "'>[BUY]</a></td></tr>"; 
  all= all + row;  
        	}
        	id=0;

all= all + '</tbody></table>';
	
   	$('building_inventory_table').innerHTML = all;	
   	   	 $$('.buy').addEvent('click', function(){
  	
 		 var itemID = this.get('id');
 		 		  buy(itemID);
  		 });
    }	
    	    }).get();
  

  
}
  

function request_weapons(){
	var price = 0 ;
		 var all = '<table class="shade-table"><tbody>';
		var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_weapons&building_id=<?php echo $this->buildings->id; ?>", 
    onSuccess: function(result){
        	    	
   for (i = 0; i < result.length; ++ i){
 price = result[i].sell_price / 2 ;

 
  var row = "<tr class=\"d" + (i & 1) + "\"><td>" +result[i].name + "<td>"  + " COST:" +  price + "<a href='#' class= 'sell' id='" + result[i].item_id + "' > [SELL] </a></td></tr>"; 
 
 
 
 
  all= all + row;  
        
    	}
    	all= all + '</tbody></table>';
    	$('my_inventory').innerHTML = all;	
    	
    	   	
   	   	 $$('.sell').addEvent('click', function(){
	
			 var itemID = this.get('id');
 		  sell(itemID);
  		 });
    }	
    	
    }).get();
    
    
}

function request_weapons2(){
	
		 var all = '<table class="shade-table"><tbody>';
		var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_weapons2&building_id=<?php echo $this->buildings->id; ?>", 
    onSuccess: function(result){
        	    	
   for (i = 0; i < result.length; ++ i){
 

 	var row = "<tr class=\"d" + (i & 1) + "\"><td>" +result[i].name + " </td></tr>"; 

 
 
  all= all + row;  
        
    	}
    	
    	all= all + '</tbody></table>';
    	$('my_inventory2').innerHTML = all;	
    	
    	   	
 
    }	
    	
    }).get();
    
    
}



 request_shop_weapons();
 //request_weapons2();
 request_weapons.periodical(1000);		
 		




function buy(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy_weapon&building_id=<?php echo $this->buildings->id; ?>&item=" + itemID, 
    onSuccess: function(result){
    	    
    	}
    }).get();
 
}
function sell(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_weapon&building_id=<?php echo $this->buildings->id; ?>&item=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}


</script>

