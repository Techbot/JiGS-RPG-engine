 <?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<div id="flats">
<table class="shade-table" >
<tr style="text-align:center;" ><th width = "20px" >Flat:</th><th width = "20px" >Status:</th><th width = "20px" >Id:</th><th width = "320px" >Message:</th><th>Lease Remaining</th></tr>

 <?php
 //echo '<pre>';
// print_r($this->flats);
// echo '</pre>';




for ($room = 0 ; $room <= 7 ;$room++){

	$status			=			$this->flats[$room]['status'];
	$remaining		=			$this->flats[$room]['remaining_days'];
	$remaining2		=			$this->flats[$room]['remaining_hours'];
	
	
	if (!isset($this->pics[$room])){
		$this->pics[$room] = 'gallery/black.gif';
	}
	
	?>
	<tr>
<td><?php echo $room ?></td>

	<td id="<?php echo $room ?>" class="work_flat" >
	<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/buttons/flat<?php echo $status; ?>.jpg">
	</td>

	<td>
	<img id="avatar_<?php echo $room ?>" src="<?php echo $this->baseurl; ?>/images/comprofiler/<?php echo $this->pics[$room] ;?>" height="20px" width="20px">
	</td>
	
	
	
	<td id="message_<?php echo $room ?>" ><?php echo $this->message[$room]; ?>
	</td>
	
	<td id="timer_<?php echo $room ?>" > <?php echo $remaining ?> days <?php echo $remaining2 ?> hrs
	</td>
	
	
	
	</tr>
<?php
} // end of 
?>

 </table>
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
      
    $(result[0]).innerHTML = result[1];	
    $(result[2]).innerHTML = result[3];	
    $(result[4]).innerHTML = result[5];
    $(result[6]).innerHTML = result[7];
  	    
    	}
    }).get();}

 work_flat();
 </script>