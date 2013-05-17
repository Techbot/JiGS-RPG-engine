 <?php defined( '_JEXEC' ) or die( 'Restricted access' );  ?>
 
 <div>
<div id= 'sell_crops' style="visibility:visible;"> You have <?php echo (int)$this->crops ;?> crops to sell</div>

<?php if($this->crops > 0 ){ ?>	
	
<script type='text/javascript'>


	   	 $('sell_crops').addEvent('click', function(){
	
		 // var itemID = this.get('id');
 		  sell_crops();
  		 });
  		 
  		 
function sell_crops(){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_crops", 
    onSuccess: function(result){
   	   	$('sell_crops').setStyle('visibility','hidden'); 
    	}
    }).get();
 
}


</script>

<?php } ?> 
 </div>
