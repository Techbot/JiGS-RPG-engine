<?php 

defined( '_JEXEC' ) or die( 'Restricted access' );
echo $this->loadTemplate ('board_batteries'); 

//print_r($this->buildings->battery_slots);

echo "<div>";


foreach ($this->buildings->battery_slots as $battery_slot)
{
		echo $battery_slot['id'] . " : " . $battery_slot['units'] . "/" .  $battery_slot['max_units'] . "<br>";
}

echo "</div>";

echo "<div id='batteries_inv'>";


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
  var row = "<span class=\"label\">Battery " + (i+1) + ":</span>" + result[i][1]  + " : " + result[i][2];
  all= all + row + "<br />";  
    	}
    	$('batteries_inv').innerHTML = all;	
    }	
    	
    }).get();

}


    request_batteries();
	//request_batteries.periodical(50085);


</script>

