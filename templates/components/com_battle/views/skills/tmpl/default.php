<!-- <script type="text/javascript" src="/JIGS/plugins/system/mtupgrade/mootools.js"></script>
 <SCRIPT type="text/javascript" src="clientcide.2.2.0.js"></script> -->
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 
	?>

<div style= "width:250px ; float:left;" >
<table class="shade-table">
<?php
//print_r ($this->skills);
echo '<tr><td>' . $this->skills->name_1 . '</td><td>Level : 1</td></tr>';
echo '<tr><td>' . $this->skills->name_2 . '</td><td>Level : 1</td></tr>';
echo' <tr><td>' . $this->skills->name_3 . '</td><td>Level : 1</td></tr>';
echo '<tr><td>' . $this->skills->name_4 . '</td><td>Level : 1</td></tr>';	
echo '<tr><td>' . $this->skills->name_5 . '</td><td>Level : 1</td></tr>';
echo '<tr><td>' . $this->skills->name_6 . '</td><td>Level : 1</td></tr>';
echo '<tr><td>' . $this->skills->name_7 . '</td><td>Level : 1</td></tr>';
echo '<tr><td>' . $this->skills->name_8 . '</td><td>Level : 1</td></tr>';	
?>		
	</table></div>	


<script type='text/javascript'>

 $$('.swap').addEvent('click', function(){
	
			 var itemID = this.get('id');
 		  swap1(itemID);
  		 });

function swap1(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=swap&weapon_id=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}
</script>