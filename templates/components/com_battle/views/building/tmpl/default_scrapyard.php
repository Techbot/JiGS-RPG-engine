<?php defined( '_JEXEC' ) or die( 'Restricted access' );
?>


<div id="inventory">

	<div style="float:left;width:49.5%">

		<div class="name">Available to Buy</div>
		<table id="building_inventory_table" class="shade-table">
			<tbody>
				<tr>

				</tr>
			</tbody>
		</table>

	</div>
	<!--end of left -->



	<div style="float:right;width:49.5%">
		<div class="name">Available to Sell</div>

		<table id="my_inventory" class="shade-table">
			<tbody>
				<tr>

				</tr>
			</tbody>
		</table>

	</div>
	<!-- end of middle 

	<div id="right" style="width: 30%; float: left;">

		<div class="name">My Inventory</div>

		<table id="my_inventory2" class="shade-table">
			<tbody>
				<tr>

				</tr>
			</tbody>
		</table>
	</div>
	<!-- end of right -->

	<div>
		<!-- end of inventory -->





		<!--end inventory-->
		<script type='text/javascript'>
function request_shop_metals(){
	var all = '<table class="shade-table"><tbody>';
	var details = this.details;
	//	var id = $('image').get('number');
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_metals&building_id=<?php echo $this->buildings->id ; ?>", 
    onSuccess: function(result){
       	    	
    for (i = 0; i < result.length; ++ i){
        var row = "<tr class=\"d" + (i & 1) + "\"><td>" + (i+1) + ": " + result[i].name + ":</td><td>$" + result[i].sell_price + "</td><td><a href='#' class='buy' id='" + result[i].item_id + "'>BUY</a></td></tr>"; 
  		all= all + row;
  		}
		id=0;
		all= all + '</tbody></table>';
		$('building_inventory_table').innerHTML = all;
		$$('.buy').addEvent('click', function(){
			var itemID = this.get('id');
			buy_metal(itemID);
			});
		}
	}).get();
	}

function request_get_metals_to_sell(){
	var all = '<table class="shade-table"><tbody>';
	var details = this.details;
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=get_metals_to_sell&building_id=<?php echo $this->buildings->id; ?>", 
        onSuccess: function(result){
            for (i = 0; i < result.length; ++ i){
                var row = "<tr class=\"d" + (i & 1) + "\"><td>" +result[i].name + "<td>"  + " COST:" + result[i].buy_price + "</td><td><a href='#' class= 'sell' id='" + result[i].item_id + "' >SELL</a></td></tr>"; 
 				all= all + row;
 				}
				all= all + '</tbody></table>';
				$('my_inventory').innerHTML = all;
				$$('.sell').addEvent('click', function(){
					var itemID = this.get('id');
					sell_metal(itemID);
					});
				}
	}).get();
	}

function request_metals2(){
	var total_metals = parseInt(0);
	 var all = '';
	//var all = '<table class="shade-table"><tbody>';
	var details = this.details;
	var a = new Request.JSON({
		url: 'index.php?option=com_battle&format=raw&task=action&action=get_metals2&building_id=<?php echo $this->buildings->id; ?>', 
    	onSuccess: function(result){
        	 for (i = 0; i < result.length; ++i){
        	 var row = '<br/>Metal ' + (i+1) + ':' + result[i].name  + ' : ' + result[i].quantity;
        	 all= all + row;
        	 total_metals = parseInt(total_metals) + parseInt(result[i].quantity);
        	 }
        	 all = all + '<br/>Total Metals: ' + total_metals;
        	 $('my_inventory2').innerHTML = all;
        	 }
        	 }).get();
        	 }
        	 
        	 function buy_metal(itemID){
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy_metal&building_id=<?php echo $this->buildings->id ; ?>&metal=" + itemID, 
    onSuccess: function(result){
    	    
    	}
    }).get();
}

function sell_metal(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_metal&building_id=<?php echo $this->buildings->id ; ?>&metal=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
}

request_shop_metals();
// request_metals2();
// request_metals2.periodical(10000);
request_get_metals_to_sell();
request_get_metals_to_sell.periodical(10000);	

</script>
