<!-- <script type="text/javascript" src="/JIGS/plugins/system/mtupgrade/mootools.js"></script>
 <SCRIPT type="text/javascript" src="clientcide.2.2.0.js"></script> -->
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 

// include_once ( $mainframe->getCfg( 'absolute_path' ) . '/components/com_battle/includes/JIGS.js.php');
	//	echo '<pre>';
	//	print_r($this->mygun);
	//	echo '</pre>';
	?>

<div style= "width:250px ; float:left;" >
<table>


<?php

// print_r($this->metals);

foreach ($this->metals as $row){
echo '<br />Name : ' . $row->name .'  Quantity : ' . $row->quantity ;


}

/*
	echo "<tr><td><a href='#' class='swap' id='" . 
	$row[position] ."'></td></tr>";
	
	 
	}  
	  
	/*    . 
"'><img src=\"components/com_battle/images/clothing/" . 
$row[image] . 
" \">[Default]</a></td><td>" . 
$row[name] . 

"</td></tr>";

*/

?>

</table></div>

		<div style="
		width:200px;
		float:left;
		">
		
<?php

//print_r ($this->skills);


echo $this->skills->name_1 . '<br/>';
echo $this->skills->name_2 . '<br/>';
echo $this->skills->name_3 . '<br/>';
echo $this->skills->name_4 . '<br/>';	
echo $this->skills->name_5 . '<br/>';
echo $this->skills->name_6 . '<br/>';
echo $this->skills->name_7 . '<br/>';
echo $this->skills->name_8 . '<br/>';	
?>		
		
		
		
		
</div>




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