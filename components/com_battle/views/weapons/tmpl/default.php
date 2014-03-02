<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 

 print_r($this->inv);
// exit();


?>
	
	
	
<div style= "width:250px ; float:left;" >
    <table>
    <?php
    foreach ($this->inv as $row)
    {
        echo '<div class= "swap" id= "' . $row->id . '"' ;
        echo '<br />Name : ' . $row->name;
        //echo '<br />Position : ' . $row->position;
        echo '<img src="components/com_battle/images/weapons/' . $row->image . '">';
        echo '	</div>';
    }  
     
    ?>
    </table>
</div>

<div style=" width:200px;float:left;">
    <div id="weapon"><?php ?></div>
</div>;

<script type='text/javascript'>

function swap(){
    $$('.swap').addEvent('click', function()
    {
		 var itemID = this.get('id');
 		 swap1(itemID);
  	});

}

function swap1(itemID)
{
	var a = new Request.JSON(
	{
        url: "index.php?option=com_battle&format=raw&task=action&action=swap&weapon_id=" + itemID, 
        onSuccess: function(result)
        {
	        request_weapon1();
	    }
    	
	}).get();
}
		
function request_weapon1()
{
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_weapon", 
    onSuccess: function(result){

        $('weapon_module').innerHTML = result;	
    	$('weapon').innerHTML = result;	
   }	
   }).get();
}

 	
//request_weapon1.periodical(5000);	
swap(); 
request_weapon1();

</script>
