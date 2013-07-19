
 
 <?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
?>




<div id="inventory" style="
width:49%;
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
* * * * Building Inventory * * * *</div>

<table id="building_software_table" class="shade-table">
<tbody>
<tr>

</tr>
</tbody>
</table>

</div>

<div  style="
width:49%;
font-size:75%;
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
* * * * My Software * * * *</div>

<table id="my_software" class="shade-table">
<tbody>
<tr>

</tr>
</tbody>
</table>





</div><!--end inventory-->



<script type='text/javascript'>
function request_inventory(id){
	 var all = '<table class="shade-table"><tbody>';
	 
name =Array(8);	 
	 name[0]="Subroutine"; 
	 name[1]="Method" ;
	 name[2]="Function";
	 name[3]="Algorythm";
	 name[4]="Stack";
	 name[5]="Procedure";
	 name[6]="Plugin";
	 name[7]="API"
	
	
	 
	 
	 
	 
		var details = this.details;
		
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_software&building_id=<?php echo $this->buildings->id ; ?>", 
    onSuccess: function(result){
       
       	    	
       	    	
       	    	
   for (i = 0; i < 8 ; ++ i){
  var row =  "<tr class=\"d" + (i & 1) + "\"><td>"  + name[i]  + ": </strong>  " + ": " + result[i] + " Price : " + result[i+1]   +     "<a href='#' class='buy' id='" + i + "' >[BUY]</a></td></tr>"; 
  all= all + row;  
        	}
  	
  	    all= all + '</tbody></table>';	
  	
  	
   	$('building_software_table').innerHTML = all;	
   	   	 $$('.buy').addEvent('click', function(){
  	
 		 var itemID = this.get('id');
 		 		  buy(itemID);
 		 });
   	
   }	
    	    }).get();

}





function request_inventory2(){
	
	 var all = '<table class="shade-table"><tbody>';
		var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_software", 
    onSuccess: function(result){
       	    	
   for (i = 2; i < 10; ++ i){


 var row =  "<tr class=\"d" + (i & 1) + "\"><td>"  + name[i-2]  + ": </strong> Qty " + ": " + result[i] + "  Price : " + result[i+1]   +     "<a href='#' class='sell' id='" + i + "' >[SELL]</a></td></tr>";
  
  
  
  
  all= all + row;  
    	}
    	    all= all + '</tbody></table>';	
    	
    	
    	$('my_software').innerHTML = all;	
    	
    	   	
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
    url: "index.php?option=com_battle&format=raw&task=action&action=buy_software&building_id=<?php echo $this->buildings->id ; ?>&item=" + id, 
    onSuccess: function(result){
    	    
    	}
    }).get();
 
}
function sell(id){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_software&building_id=<?php echo $this->buildings->id ; ?>&item=" + id, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}


</script>



