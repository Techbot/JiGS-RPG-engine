 <?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<div id="flats">
<div class="row">
<div class="name">Status:</div>
<div class="name">Id:</div>
<div class="name">Message:</div>
<div class="name">Lease Remaining</div>
</div>

 <?php
 //echo '<pre>';
// print_r($this->flats);
// echo '</pre>';

	$status			= 0;
	$remaining		= 0;
	$remaining2		= 0;


for ($room = 0 ; $room <= 7 ;$room++){

	$status			=			$this->flats[$room]['status'];
	$remaining		=			$this->flats[$room]['remaining_days'];
	$remaining2		=			$this->flats[$room]['remaining_hours'];
	
	
	if (!isset($this->pics[$room])){
		$this->pics[$room] = 'gallery/black.gif';
	}
	
 
 // Lisa
	if($status == "0")  
   {  
      $status_word = "Vacant"; 
		$status_tooltip = "Rent";	  
   }  
	else 
   {  
      $status_word = "Occupied";  
		$status_tooltip = "Vacate";	  
   }  
   
?>
	<div class="row">

	<div id="<?php echo $room ?>" class="work_flat" >
	<h4><a href="#" title="Click Here to <?php echo $status_tooltip; ?>"><?php echo $status_word; ?></a></h4>
	<!--<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/buttons/flat<?php echo $status; ?>.jpg">-->
	</div>

	<div>
	<img id="avatar_<?php echo $room ?>" src="<?php echo $this->baseurl; ?>/images/comprofiler/<?php echo $this->pics[$room] ;?>" height="20px" width="20px">
	</div>
	
	
	
	<div id="message_<?php echo $room ?>" ><?php //echo $this->message[$room]; ?>
	</div>
	
	<div id="timer_<?php echo $room ?>" > <?php echo $remaining ?> days <?php echo $remaining2 ?> hrs
	</div>
	
	
	
	</div>
<?php
} // end of 
?>

</div><!--flats -->

<script type='text/javascript'>
function work_flat() {
	$$('.work_flat').addEvent('click', function(){
		var itemID = this.get('id');
		work(itemID);
		});
    }	
    
    function work(itemID){	 	
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=work_flat&building_id=<?php echo $this->buildings->id ?>&flat=" + itemID  ,
    onSuccess: function(result){
    
    if (result[0]=="broke"){
    
    alert(result[0] + '.You need 1000 credits IN THE BANK to rent an apartment. Then you will be safe from attack! 1000 Credits will be withdrawn from your account every week.')
    
    }
     else {
	  alert(result[2]);
    $(result[0]).innerHTML = result[1];	
    $(result[2]).innerHTML = result[3];	
    $(result[4]).innerHTML = result[5];
    $(result[6]).innerHTML = result[7];
  	    }


    	}
    }).get();}

 work_flat();
 </script>
