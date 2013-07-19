 
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/emc23flexiv2.3/css/jigs.css" type="text/css" />
<style type="text/css">
tr.d0 td {
	background-color: #CC9999; color: black;
}
tr.d1 td {
	background-color: #9999CC; color: black;
}
</style>
<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/interior.png" >

<div id='leave'>Leave Apartment</div>

<script type='text/javascript'>


function leave(){
	
		$('leave').addEvent('click', function(){
		
		var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=leave_room", 
    onSuccess: function(result){
       	    	
location.href = 'index.php?option=com_battle&view=single';
 
    	}

    	
    	
    }).get();
		
		
		});
}
	
	
	leave();
	
	
 
</script>