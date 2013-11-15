<div id = "charge">Charge Battery </div>
<div id = 'charge_progress' style='visibility:hidden;'>Battery Charge Process in Progress</div>	




<?php echo $this->loadTemplate ('board_batteries'); ?>






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
