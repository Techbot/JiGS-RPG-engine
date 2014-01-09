 <?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<div id="flats">

<div class="row name">Apartments</div>
<!--div class="row">
<div class="name">Message:</div>
<div class="name">Status:</div>
<div class="name">Id:</div>
<div class="name">Lease Remaining</div>
</div-->

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

	<div class="flats row">

	
	<div id="message_<?php echo $room ?>" ><?php echo $this->message[$room]; ?>
	</div>
	
	<div id="<?php echo $room ?>" class="work_flat" >
	<h4><a href="#" title="Click Here to <?php echo $status_tooltip; ?>"><?php echo $status_word; ?></a></h4>
	<!--<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/buttons/flat<?php echo $status; ?>.jpg">-->
	</div>

	<div id="avatar_<?php echo $room ?>">
	<img  src="<?php echo $this->baseurl; ?>/images/comprofiler/<?php echo $this->pics[$room] ;?>" height="20px" width="20px">
	</div>
	
	
	
	<div id="timer_<?php echo $room ?>" ><span class="label inline">Rent Due:</span><?php echo $remaining ?> days <?php echo $remaining2 ?> hrs
	</div>
	
	
	
	</div><!--flats -->	
	
<?php
} // end of 
?>


