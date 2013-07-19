<?php defined( '_JEXEC' ) or die( 'Restricted access' );
?>


<div id="inventory">

	<div id="left" style="width: 49.5%; float: left;">

		<div id="building_inventory_table">
			
				<div class="name">Available to Buy</div>

				
		</div>

	</div>
	<!--end of left -->



	<div id="middle" style="width: 49.5%; float: left;">

		<div id="my_inventory">
				<div class="name">Available to Sell</div>
		</div>

	</div>
	<!-- end of middle -->



	<div>
		<!-- end of inventory -->





		<!--end inventory-->
		<script type='text/javascript'>
function request_shop_inventory(){
	var all = '<div id="building_inventory_table"><div class="name">Available to Buy</div>';
	var details = this.details;
	//	var id = $('image').get('number');
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_inventory&building_id=<?php echo $this->buildings->id ; ?>", 
    onSuccess: function(result){
       	    	
    for (i = 0; i < result.length; ++ i){
        var row = "<div class='object'><a href='#' title='" + result[i].name + "' class='buy' id='" + result[i].item_id + "'><img src='/components/com_battle/images/objects/" + result[i].name + ".png' height='32' width='32' /></a><span class='price'>$" + result[i].sell_price + "</span></div>"; 
  		all= all + row;
  		}
		id=0;
		all= all + '</div>';
		$('building_inventory_table').innerHTML = all;
		$$('.buy').addEvent('click', function(){
			var itemID = this.get('id');
			buy1(itemID);
			});
		}
	}).get();
	}

function request_inventory(){
	var all = '<div id="my_inventory"><div class="name">Available to Sell</div>';
	var details = this.details;
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=get_inventory_to_sell&building_id=<?php echo $this->buildings->id; ?>", 
        onSuccess: function(result){
            for (i = 0; i < result.length; ++ i){
                var row = "<div class='object'><a href='#' title='" + result[i].name + "' class='sell' id='" + result[i].item_id + "'><img src='/components/com_battle/images/objects/" + result[i].name + ".png' height='32' width='32' /></a><span class='price'>$" + result[i].buy_price + "</span></div>"; 
 				all= all + row;
 				}
				all= all + '</div>';
				$('my_inventory').innerHTML = all;
				$$('.sell').addEvent('click', function(){
					var itemID = this.get('id');
					sell1(itemID);
					});
				}
	}).get();
	}


function buy1(itemID){
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy&building_id=<?php echo $this->buildings->id ; ?>&item=" + itemID, 
    onSuccess: function(result){
    	    
    	}
    }).get();
 
}

function sell1(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell&building_id=<?php echo $this->buildings->id ; ?>&item=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}

request_shop_inventory();
request_inventory.periodical(1000);	

</script>