<?php 

defined( '_JEXEC' ) or die( 'Restricted access' );
echo $this->loadTemplate ('board_batteries'); 

//print_r($this->buildings->battery_slots);

echo "<div id='generator' style = 'float:right;'>yyy";
//foreach ($this->buildings->battery_slots as $battery_slot)
//{
	//	echo "<li>" . $battery_slot['id'] . " : " . $battery_slot['units'] . "/" .  $battery_slot['max_units'] . "</li>";
//}
echo "</div>";
echo "<div id='batteries_inv' style = 'float:left;'>";
//foreach ($this->cropper->battery_slots as $battery_slot)
//{
//		echo $battery_slot['id'] . " : " . $battery_slot['units'] . "/" .  $battery_slot['max_units'] . "<br>";
//}
echo "xxx</div>"

?>
<script type="text/javascript">

function request_batteries(){
	 var all = '';
	//	var details = this.details;
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_batteries", 
    onSuccess: function(result){
       	    	
   for (i = 0; i < result.length; ++ i){
  var row = "<div class='put' id='" + result[i][0] + "'><span class='label'>Battery " + (i+1) + ":</span>" + result[i][1]  + " : " + result[i][2]+ "</div>";
  
	all= all + row;  
    	}
    	$('generator').innerHTML = all;	

	$$('.put').addEvent('click', function(){
			var itemID = this.get('id');
			put1(itemID);
			});

    }	
    	
    }).get();
}
function request_battery_slots(){
	 var all = '';
	//	var details = this.details;
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_battery_slots&building_id=<?php echo $this->buildings->id;?>", 
    onSuccess: function(result){
   for (i = 0; i < result.length; ++ i){
  	var row = "<div class='get' id='" + result[i]['id'] + "'><span class=\"label\">Battery " + (i+1) + ":</span>" + result[i]['id']  + " : " + result[i]['units'] +"</div>";
  	all= all + row ;  
    	}
    	$('batteries_inv').innerHTML = all;

	$$('.get').addEvent('click', function(){
			var itemID = this.get('id');
			get1(itemID);
			});
    }	
    }).get();
}
function get1(itemID){
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_battery&building_id=<?php echo $this->buildings->id ; ?>&item=" + itemID, 
    onSuccess: function(result){
     	}
    }).get();
 
}

function put1(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=put_battery&building_id=<?php echo $this->buildings->id ; ?>&item=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}

request_batteries();
request_batteries.periodical(5085);
request_battery_slots();
request_battery_slots.periodical(5000);

</script>

