<!-- <script type="text/javascript" src="/JIGS/plugins/system/mtupgrade/mootools.js"></script>
 <SCRIPT type="text/javascript" src="clientcide.2.2.0.js"></script> -->
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 

	?>

<div style= "width:250px ; float:left;" >
<table>


<?php

// print_r($this->metals);

foreach ($this->metals as $row){
echo '<br />Name : ' . $row->name .'  Quantity : ' . $row->quantity ;


}


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





