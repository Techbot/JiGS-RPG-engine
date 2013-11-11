<div class="name">Distribution Systems Control</div>

<form class="primary_0" action="index.php" method="get" name="adminForm_0" id= "adminForm_0">	


<!--


<label title="Primary System Upgrade" for="quantity_adjust">Upgrade:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="1" style="width:10px;"  />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" onclick = "var qty_el = document.getElementById('primary_quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4" onclick = "var qty_el = document.getElementById('primary_quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) qty_el.value--;return false;" />

<hr />
<label title="Primary System Capacity" for="quantity_adjust">Transfer Rate:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="2" style="width:10px;" />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4"  /> <br />

<label title="Primary System Capacity" for="quantity_adjust">Energy Efficiency:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="1" style="width:10px;" />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4"  /><br />


<label title="Primary System Capacity" for="quantity_adjust">Output Quality:</label>
<input type="text" id="primary_quantity_adjust" name="primary_quantity_adjust" value="3"  size="3" style="width:20px;" />
<input title="Increase Quantity" type="button" id = "primary_quantity_box_button_up" value="+" size="4" />
<input title="Decrease Quantity" type="button" id = "primary_quantity_box_button_down" value="-" size="4"  /><br />

-->



</form>	<div id="batteries">x</div>
<br />
<div id="distr" style ="background-color:black;">
</div>


    <div id="holder">
    
    
    
    
    </div>

<script type='text/javascript'>


function insert(id){
	
		
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&building_id=<?php echo $this->buildings->id ; ?>&task=action&action=swap_battery&id="+id, 
    onSuccess: function(result){
       	    	
 	request_batteries();
    }	
    	
    }).get();

}

function request_batteries(){
	
	 var all = '';
	//	var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_batteries", 
    onSuccess: function(result){
    	for (i = 0; i < result.length; ++ i){
    	var row = "<span class=\"label\">Battery " + (i+1) + ":</span>" + result[i][1]  + " : " + result[i][2] 
    	+ "<a href='#' onclick='insert(" + result[i][0] +")'> [insert] </a> ";
  all= all + row + "<br/>";  
    	}
    	$('batteries').innerHTML = all;	
    }	
    	
    }).get();

}

    request_batteries();
	//request_batteries.periodical(50085);

</script>




