<?php defined( '_JEXEC' ) or die( 'Restricted access' );
  
?>
<div style="color:#fff;
font-size:10px;
">

<div id = 'fields'>

<?php
for ($land = 1 ; $land <= 8 ;$land++){
	
	$status = '$this->fields->status_field_'.$land;

?>

 <div style = " visibility: visible; float:left; ">Field <?php echo $land ?> :</div>
	 <div id = "<?php echo $land ?>" class="work_field" style = " visibility: visible; float:left; " >
	 <a href="#"  job="1" class = "field" >
	 <img src="/components/com_battle/images/<?php  eval ("\$image = print_r($status);"); ?>.jpg"></a></div>

	 	 Status: Field is Barren. Click to begin Tilling.<div class='clear'></div>
<?php		
 }?>
 
</div>
</div>


<script type='text/javascript'>
function work_field() {
	$$('.work_field').addEvent('click', function(){
		var itemID = this.get('id');
		work(itemID);
		});
    }	
    
    function work(itemID){	 	
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=work_field&building_id=<?php echo $this->buildings->id ?>&crop=soya&field=" + itemID  ,
    onSuccess: function(result){
    
    	$(itemID).setStyle('visibility','hidden');

  	    
    	}
    }).get();}

 work_field();
 </script>
 