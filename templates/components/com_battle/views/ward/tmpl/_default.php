 
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.css" type="text/css" />
<style type="text/css">
tr.d0 td {
	background-color: #CC9999; color: black;
}
tr.d1 td {
	background-color: #9999CC; color: black;
}
</style>
You are in a recovery ward. You were found beaten to a pulp. <br />
Everything you had on you was taken. <br />
You apparently have no insurance so we took a pint of blood as payment.<br />
<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/ward.jpg" >

<div id='leave'>Checkout</div>

<script type='text/javascript'>


function leave(){
	
		$('leave').addEvent('click', function(){
		
		var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=leave_room", 
    onSuccess: function(result){
       	    	
location.href = 'index.php?option=com_battle&view=single';
 
    	}

    	
    	
    }).get();
		
		
		});
}
	
	
	leave();
	
	
 
</script>