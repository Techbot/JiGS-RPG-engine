<?php ?>

<div id="stats_module">loading....</div>

<script type='text/javascript'>

function request_stats(){
	
		var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_stats", 
    onSuccess: function(result){
    	
    	
    	
   // 	alert('health: ' + result[0].health + '   strenght: ' + result[0].strenght + '   Intelligence: ' + result[0].intelligence);
    
   document.id('stats_module').innerHTML = 
    
       "<span class=\"label\">Level:</span>                   " +result[0].level +
       "<br /><span class=\"label\">   Experience:</span>     "    +	result[0].xp + 
       "<br /><span class=\"label\">   Health:</span>         "    +    result[0].health +
       "<br /><span class=\"label\">   Energy:</span>         "    +    result[0].energy +
       "<br /><span class=\"label\">   Strength:</span>       "    +	result[0].strength +
       "<br /><span class=\"label\">   Intelligence:</span>   "    +	result[0].intelligence +
       "<br /><span class=\"label\">   Speed:</span>   "           +	result[0].speed +       
       "<br /><span class=\"label\">   Pos X:</span>   "    +    result[0].posx +
       "<span class=\"label\" style=\"margin-left:10px;\">   Pos Y:</span>          "    +    result[0].posy +
       "<br /><span class=\"label\">   Cash: </span>          "    +    result[0].money        +   " <br /><span class=\"label\">Bank:</span>  " +  result[0].bank   +
       "<br /><span class=\"label\">   Attack: </span>      "    +    result[0].attack       +   " <span class=\"label\" style=\"margin-left:10px;\">Total:</span> " +  result[0].final_attack   +
       "<br /><span class=\"label\">   Defence:</span>       "    +    result[0].defence      +   " <span class=\"label\" style=\"margin-left:10px;\">Total:</span> " +  result[0].final_defence  +      
       "<br /><span class=\"label\">   Attacks:</span>       "    +    result[0].nbr_attacks  +   " <span class=\"label\" style=\"margin-left:10px;\">Kills:</span> " +  result[0].nbr_kills      +          
       "<input type='button' value='Update' onclick= 'request_stats();'></button>"
         ;
     
    	//	update: $('stats')

    
    
    	}
    }).get();
}



request_stats();






</script>

