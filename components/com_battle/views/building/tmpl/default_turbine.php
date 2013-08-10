<div id = "crystal_actions">- Insert Crystals - Remove Crystals - Charge Crystals - </div>
<div id = "charge">Charge Battery </div>
<div id = 'charge_progress' style='visibility:hidden;'>Battery Charge Process in Progress</div>	
<script type="text/javascript">
work();
check_turbine.periodical(1000);
// noobslide
function work_turbine() {
	$('charge').addEvent('click', function(){
		work_turbine();
	});
}	
function work_turbine(){
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=building_action&action=work_turbine&quantity=1&building_id=<?php echo $this->buildings->id ?>&line=1"  ,
			onSuccess: function(result){
				$('charge').setStyle('visibility','hidden');
				$('charge_progress').setStyle('visibility','visible');
			}
	}).get();
}
function check_turbine(){
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=building_action&action=check_turbine&building_id=<?php echo $this->buildings->id ; ?>" , 
			onSuccess: function(result){
				if (result==0){
					$('charge').setStyle('visibility','visible');
					$('charge_progress').setStyle('visibility','hidden');  	    
				}
			}
	}).get();
}
</script>
