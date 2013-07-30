
 
 <?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
?>
<style type="text/css"><!-- 

div#container {
font-family:arial;
color:white;
}

div#building_info_table {
border-right:1px dotted #333;
width:50%;
float:left;
}
div#building_info_table td:first-child {
text-transform:uppercase;
color:#666;
}

table.shade-table {
width:100%;
text-align:center;
}

table.shade-table th{
font-weight:bold;
text-transform:uppercase;
background:#1F1F1F;
color:#333;

}
--></style> 
<div  style="float:left;">
<div id="inventory" style="

float:left;
">

<div id="b_i_t_title" style="
text-transform:uppercase;
font-weight:bold;
background:#333;
color:#000;
text-align:center;
margin:0 0 10px 0;
">
Available to buy </div>

<table id="building_inventory_table" class="shade-table">
<tbody>
<tr>

</tr>
</tbody>
</table>
</div>
<div  style="

float:right;
">
<div id="m_i_t_title" style="
text-transform:uppercase;
font-weight:bold;
background:#333;
color:#000;
text-align:center;
margin:0 0 10px 0;
">
Available for Sale </div>

<table id="my_inventory" class="shade-table">
<tbody>
<tr>

</tr>
</tbody>
</table>

</div>





<script type='text/javascript'>
function request_inventory(id){
	 var all = '';
	 
name =Array(8);	 
	 name[0]="Hash"; 
	 name[1]="Acid" ;
	 name[2]="DMT";
	 name[3]="Ecstacy";
	 name[4]="PCP";
	 name[5]="Mushroom";
	 name[6]="Cocaine";
	 name[7]="Ketamine";
	
	 
	 
	 
	 
		var details = this.details;
		
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_drugs&building_id=<?php echo $this->buildings->id ; ?>", 
    onSuccess: function(result){
       
       	    	
       	    	
       	    	
   for (i = 0; i < 8 ; ++ i){
  var row = "<br><strong>" + name[i]  + ": </strong> Qty " + ": " + result[i] + "grams  Price : " + result[i+1]   +     "<a href='#' class='buy' id='" + i + "' >[BUY]</a>"; 
  all= all + row;  
        	}
  	
   	$('building_inventory_table').innerHTML = all;	
   	   	 $$('.buy').addEvent('click', function(){
  	
 		 var itemID = this.get('id');
 		 		  buy(itemID);
 		 });
   	
   }	
    	    }).get();

}





function request_inventory2(){
	
	 var all = '';
		var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_drugs", 
    onSuccess: function(result){
       	    	
   for (i = 2; i < 10; ++ i){


 var row = "<br><strong>" + name[i-2]  + ": </strong> Qty " + ": " + result[i] + "grams  Price : " + result[i+1]   +     "<a href='#' class='sell' id='" + i + "' >[SELL]</a>";
  
  
  
  
  all= all + row;  
    	}
    	$('my_inventory').innerHTML = all;	
    	
    	   	
   	   	 $$('.sell').addEvent('click', function(){
	
			 var itemID = this.get('id');
 		  sell(itemID);
 		 });
    }	
    	
    }).get();

}


request_inventory2.periodical(1000);
request_inventory.periodical(1000);



function buy(id){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy_drugs&building_id=<?php echo $this->buildings->id ; ?>&item=" + id, 
    onSuccess: function(result){
    	    
    	}
    }).get();
 
}
function sell(id){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_drugs&building_id=<?php echo $this->buildings->id ; ?>&item=" + id, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}


</script>



