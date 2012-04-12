
 
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
?>


<div id="inventory" style="
width:49%;
float:left;
">


<div id="b_i_t_title" style="
text-transform:uppercase;
font-weight:bold;
background:#333;
color:#000;
text-align:center;
margin:0 0 10px 0;
">
* * * * Building Clothing Inventory * * * *</div>

<table id="building_clothing_table" class="shade-table">
<tbody>
<tr>

</tr>
</tbody>
</table>

</div>

<div  style="
width:49%;
float:right;
">

<div id="m_i_t_title" style="
text-transform:uppercase;
font-weight:bold;
background:#333;
color:#000;
text-align:center;
margin:0 0 10px 0;
">
* * * * My Clothing * * * *</div>

<table id="my_clothing"class="shade-table">
<tbody>
<tr>

</tr>
</tbody>
</table>





</div><!--end inventory-->











<script type='text/javascript'>
function request_inventory(){
	 var all = '<table class="shade-table"><tbody>';
		var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_clothing&building_id=<?php echo $this->buildings->id ; ?>", 
    onSuccess: function(result){
       	    	
   for (i = 0; i < result.length; ++ i){
  var row = "<tr class=\"d" + (i & 1) + "\"><td>" + (i+1) + ": " + result[i].name + ":</td><td>$" + result[i].sell_price + "<a href='#' class='buy' id='" + result[i].item_id + "'>[BUY]</a></td></tr>"; 
  all= all + row;  
        	}

all= all + '</tbody></table>';





  	
   	$('building_clothing_table').innerHTML = all;	
   	   	 $$('.buy').addEvent('click', function(){
  	
 		 var itemID = this.get('id');
 		 		  buy(itemID);
 		 });
   	
   }	
    	    }).get();

}





function request_inventory2(){
	
	 var all = '<table class="shade-table"><tbody>';
		var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_clothing", 
    onSuccess: function(result){
       	    	
   for (i = 0; i < result.length; ++ i){
  var row = "<tr class=\"d" + (i & 1) + "\"><td>" + (i+1) + ":" + result[i].name + " COST:" + result[i].buy_price + "<a href='#' class= 'sell' id='" + result[i].item_id + "' > [SELL] </a></td></tr>"; 
  all= all + row;  
    	}
    	
    	all= all + '</tbody></table>';
    	
    	$('my_clothing').innerHTML = all;	
    	
    	   	
   	   	 $$('.sell').addEvent('click', function(){
	
			 var itemID = this.get('id');
 		  sell(itemID);
 		 });
    }	
    	
    }).get();

}


request_inventory2.periodical(1000);
request_inventory.periodical(1000);



function buy(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy&building_id=<?php echo $this->buildings->id ; ?>&item=" + itemID, 
    onSuccess: function(result){
    	    
    	}
    }).get();
 
}
function sell(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell&building_id=<?php echo $this->buildings->id ; ?>&item=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}


</script>

