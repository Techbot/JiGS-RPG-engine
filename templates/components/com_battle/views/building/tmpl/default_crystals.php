<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
?>
<div id="inventory" ><div id='left''><div class='name'>Available to buy </div>

<table id="building_inventory_table" class="shade-table"><tbody><tr></tr></tbody></table></div><!--end of left -->

<div id="middle" style="width:40%;float:left;"><div class="shade-table" id="m_i_t_title" >Available for Sale </div>

<table id="my_inventory" class="shade-table"><tbody><tr></tr></tbody></table>

</div> <!-- end of middle -->

<div id="right" style="width:30%;float:left;">
<div id="s_i_t_title" style="">My Inventory </div>
<table id="my_inventory2" class="shade-table"><tbody><tr></tr></tbody></table>
</div>
</div><!-- end of right -->

<!--end inventory-->
<script type='text/javascript'>
function request_shop_inventory(){
	 var all = '<table class="shade-table"><tbody>';
		var details = this.details;
  	
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_crystals&building_id=<?php echo $this->buildings->id ; ?>", 
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
 		 		  buy1(itemID);
  		 });
    }	
    	    }).get();
} 
function request_inventory(){
	var all = '<table class="shade-table"><tbody>';
	var details = this.details;
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=get_crystals&building_id=<?php echo $this->buildings->id; ?>",
		onSuccess: function(result){
			for (i = 0; i < result.length; ++ i){
				var row = "<tr class=\"d" + (i & 1) + "\"><td>" +result[i].name + "<td>"  + " COST:" + result[i].buy_price + "<a href='#' class= 'sell' id='" + result[i].item_id + "' > [SELL] </a></td></tr>";
				 all= all + row;
				 }
			 all= all + '</tbody></table>';
			 $('my_inventory').innerHTML = all;
			 $$('.sell').addEvent('click', function(){
				 var itemID = this.get('id');
				 sell1(itemID)
				 });
			 }
	 }).get();
	 }

function request_inventory2(){
		 var all = '<table class="shade-table"><tbody>';
		var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_crystals2&building_id=<?php echo $this->buildings->id; ?>", 
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


request_shop_inventory();
request_inventory2();
request_inventory.periodical(1000);		
 		



</script >

<script type='text/javascript'>
function buy1(itemID){
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy_crystals&building_id=<?php echo $this->buildings->id ; ?>&item=" + itemID, 
    onSuccess: function(result){
   	    
    	}
    }).get();
 
}
function sell1(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_crystals&building_id=<?php echo $this->buildings->id ; ?>&item=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}


</script>