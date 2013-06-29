<?php 

defined( '_JEXEC' ) or die( 'Restricted access' );
echo $this->loadTemplate ('board_batteries'); 

//print_r($this->buildings->battery_slots);


foreach ($this->buildings->battery_slots as $battery_slot)
{
		echo $battery_slot['id'] . " : " . $battery_slot['units'] . "/" .  $battery_slot['max_units'] . "<br>";
}


?>

<script type="text/javascript">
work_turbine();
energy_time.periodical(100000);
//noobslide
function work_turbine() {
	$('charge').addEvent('click', function(){				
		work();
	});
}	
function work(){	
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=work_turbine&quantity=1&building_id=<?php echo $this->buildings->id ?>&line=1"  ,
		onSuccess: function(result){
			$('charge').setStyle('visibility','hidden');
			$('charge_progress').setStyle('visibility','visible');  	
		}
	}).get();
}
function energy_time(){
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=energy_time&building_id=<?php echo $this->buildings->id ; ?>" , 
		onSuccess: function(result){
			if (result==0){
				$('charge').setStyle('visibility','visible');
				$('charge_progress').setStyle('visibility','hidden');  	    
			}
		}
	}).get();
}
</script>

