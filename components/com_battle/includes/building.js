(function()
{
	buy_building();
	window.id1			= new Array();
	window.metal_name_1 = new Array();
	window.metal_name_2 = new Array();
	window.mystock1		= 0;
	window.mystock2		= 0; 
	window.q_1			= new Array();
	window.q_2			= new Array();	  
	window.metals		= new Array();
	var refTab			= document.getElementById("stats");
	var row				= refTab.rows[0];
	var col				= row.cells[1]; 
	// alert(col.firstChild.nodeValue);
	// var  col =   refTab.rows[1].cells[1]; 
	// alert(col.firstChild.nodeValue);
	building_id			= col.firstChild.nodeValue;
	var row				= refTab.rows[3];
	var col				= row.cells[1]; 
	//alert(col.firstChild.nodeValue);
	//var  col =   refTab.rows[1].cells[1]; 
	//alert(col.firstChild.nodeValue);
	window.building_type = col.firstChild.nodeValue;	
	//change();
	//noobslide
	request_batteries_cp();
	//request_batteries.periodical(50085);	 
	control_panel_system();
	set_type();

})();	

//http://liquidslider.com/documentation/
$(function(){

	$('#slider-id').liquidSlider({
	  slideEaseFunction: "easeInOutCubic",
	  autoHeight: false,
	  dynamicTabs: true,
	  dynamicTabsAlign: "center",
	  includeTitle:false,
	  slideEaseFunction:'animate.css',
	  slideEaseDuration:1000,
	  heightEaseDuration:1000,
	  animateIn:"bounceInLeft",
	  animateOut:"bounceOutRight",
	  dynamicTabsPosition:"bottom"
	});
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function set_type()
{

	if (window.building_type=="papier")
    {
        get_shop_papers();
        get_papers.periodical(1000);				
    }
    
    if (window.building_type=="mine")
    {
  		dig();
	    check_mine();
	    check_mine.periodical(2000);
    }
    
    if (window.building_type=="blueprints")
    {
     	get_my_blueprints.periodical(1000);
	    get_shop_blueprints();
    }
  
    if (window.building_type=="apartment")
    {
     	$$('.work_flat').addEvent('click', function(){
	    var itemID = this.get('id');
	    work_flat(itemID);
	    });
    }

    if (window.building_type=="farm")
    {
     	$$('.work_field').addEvent('click',function()
     	{
		    var itemID = this.get('id');
		    work_field(itemID);
	
	    });
 		
 		check_farm.periodical(5000)

    }

    if (window.building_type=="reprocessor")
    {
        prepare();
        prepare2();
        work_reprocessor();
        check_reprocessor.periodical(5000);
        //change();
    }

    if (window.building_type=="factory")
    {
        prepare();
        prepare2();
        work_conveyer();
        get_blueprints();
        check_factory.periodical(5000);
        request_metals();
    }

    if (window.building_type=="scrapyard")
    {
        request_shop_metals();
        // request_metals2();
        // request_metals2.periodical(10000);
        request_get_metals_to_sell();
        request_get_metals_to_sell.periodical(10000);
    }

    if (window.building_type=="food")
    {
     	document.id('sell_crops').addEvent('click', function()
     	{
	     // var itemID = this.get('id');
 		  sell_crops();
  		});
	    get_papers.periodical(1000);
	    get_shop_papers.periodical(1000);
    }

    if (window.building_type=="stand")
    {
        request_shop_inventory();
        request_inventory.periodical(1000);				
    }

    if (window.building_type=="generator")
    {
        request_batteries();
        request_batteries.periodical(5085);
        request_battery_slots();
        request_battery_slots.periodical(5000);				
    }	

    if (window.building_type=="bank")
    {
        deposit();
        withdraw();				
    }
 
    if (window.building_type=="bullet")
    {
       
        buy_bullets();				
    } 
 
 
 
 
 
 
 
 
 
 
 
    
    if (window.building_type=="diner")
    {
        //SAMPLE 4 (walk to item)
	    /*var nS4 = new noobSlide({
		    box: document.id('box4'),
		    items: $$('#box4 div'),
		    size: 640,
		    handles: $$('#handles4 span'),
		    onWalk: function(currentItem,currentHandle){
			    // $('info4').set('html',currentItem.getFirst().innerHTML);
			    this.handles.removeClass('active');
			    currentHandle.addClass('active');
		    }
	    });*/
		
       	document.id('eat_burger').addEvent('click', function()
       	{
	        var itemID = this.get('id');
	        eat(itemID);
	    });
 
    }
    
    if (window.building_type=="weapons")
    {   
            request_shop_weapons();
            //request_weapons2();
            request_weapons.periodical(1000);	
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////
function control_panel_system()
{
	
	$$('.b_button').addEvent('click', function()
	{
	    var itemID = this.get('id');
 		switch(itemID)
 		{
 		
         	case 'primary':
         		$$('.panel').set('styles',{visibility:'hidden'});
         		document.id('first_panel').set('styles',{visibility:'visible'});
          		$$('.b_button').set('class','b_button inactive');
	            document.id('primary').set('class', 'b_button active');
         		break;
         	case 'defence':
         		$$('.panel').set('styles',{visibility: 'hidden'});
         		document.id('second_panel').set('styles',{visibility: 'visible'});
          		$$('.b_button').set('class','b_button inactive');
	            document.id('defence').set('class', 'b_button active');
         		break;	
           	case 'distr':
         		$$('.panel').set('styles',{visibility:'hidden'});
         		document.id('third_panel').set('styles',{visibility:'visible'});
         		$$('.b_button').set('class','b_button inactive');
	            document.id('distr').set('class','b_button active');		
         		break;		
            case 'hr':
         		$$('.panel').set('styles',{visibility:'hidden'});
         		document.id('fourth_panel').set('styles',{visibility:'visible'});
	            $$('.b_button').set('class', 'b_button inactive');
	            document.id('hr').set('class', 'b_button active');		
         		break;			
             case 'energy':
         		$$('.panel').set('styles',{visibility:'hidden'});
         		document.id('fifth_panel').set('styles',{visibility:'visible'});
         		$$('.b_button').set('class','b_button inactive');
	            document.id('energy').set('class','b_button active');		
          		break;
         	default:
         		$$('panel').set('styles',{visibility:'hidden'});
         		$$('.b_button').set('class','b_button inactive');
      	}
	});
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////	 

function buy_weapon(itemID)
{
 	var a               = new Request.JSON(
 	{
        url: "index.php?option=com_battle&format=raw&task=action&action=buy_weapon&building_id=" 
        + building_id + "&item=" + itemID, 
        onSuccess: function(result)
        {
        	    
        }
    }).get();
}

function sell_weapon(itemID)
{
 	var a = new Request.JSON(
 	{
        url: "index.php?option=com_battle&format=raw&task=action&action=sell_weapon&building_id=" 
        + building_id 
        + "&item=" 
        + itemID, 
        onSuccess: function(result)
        {
       	   
        }
    }).get();

}
  
function request_shop_weapons()
{
    var all = '';
	var details = this.details;
    //	var id = $('image').get('number'); 
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_weapons&building_id=" 
        + building_id , 
        onSuccess: function(result)
        {
       	    for (i = 0; i < result.length; ++ i)
       	    {
                var row = "<div class='row'><span>" 
                + (i+1) + ": " 
                + result[i].name 
                + ":</span><span class='price'>$" 
                + result[i].sell_price 
                + "</span><a href='#' class='buy' id='" 
                + result[i].item_id 
				+ "'>BUY</a></div>"; 
                all= all + row;  
        	}
        	id=0;

            all= all + '';
	
       	    document.id('building_inventory_table').innerHTML = all;	
       	    $$('.buy').addEvent('click', function()
       	    {
      	
                var itemID = this.get('id');
                buy_weapon(itemID);
      		 });
        }	
    }).get();
}

function request_weapons()
{
	var price = 0 ;
	var all = '';
	var details = this.details;
	var a = new Request.JSON(
	{
        url: "index.php?option=com_battle&format=raw&task=action&action=get_weapons&building_id=" 
        + building_id , 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                price = result[i].sell_price / 2 ;
                var row = "<div class='row'><span>" 
				+result[i].name 
                + "</span><span class='price'>COST:" 
                +  price 
				+ "</span><a href='#' class= 'sell' id='" 
				+ result[i].item_id 
                + "'>SELL</a></div>";
                all= all + row;
            }
    	    all= all + '';
    	    document.id('my_inventory').innerHTML = all;	
            $$('.sell').addEvent('click', function()
            {
                var itemID = this.get('id');
 		        sell_weapon(itemID);
  		    });
        }	
    }).get();
}

function request_weapons2()
{
    var all = '<table class="shade-table"><tbody>';
	var details = this.details;
	var a = new Request.JSON(
	{
        url: "index.php?option=com_battle&format=raw&task=action&action=get_weapons2&building_id="
        + building_id, 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<tr class=\"d" 
                + (i & 1) + "\"><td>" 
                +result[i].name 
                + " </td></tr>";
                all= all + row;
            }
            all= all + '</tbody></table>';
        	document.id('my_inventory2').innerHTML = all;	
        }	
    }).get();
}

function insert(id)
{
    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&building_id=" 
        + building_id + "&task=action&action=swap_battery&id="
        +id, 
        onSuccess: function(result)
        {
          	request_batteries_cp();
        }	
    	
    }
    ).get();

}

function request_batteries_cp()
{
    var all = '';
//	var details = this.details;

    var a = new Request.JSON(
    {
        url: "index.php?option=com_battle&format=raw&task=action&action=get_batteries", 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
	            var row = "<span class=\"label\">Battery " + (i+1) + ":</span>" 
	            + result[i][1]  + " : " + result[i][2] 
                + "<a href='#' onclick='insert(" 
                + result[i][0] +")'> [insert] </a> ";
            
                all= all + row + "<br/>";  
	        }

	        document.id('batteries').innerHTML = all;	
        }	
	
    }).get();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////////////////



function prepare()
    {

    var foo = document.id('quantity_box_button_up'); 

    // if it returns an Element object, it will be truthy.
    if (foo) {

        document.id('quantity_box_button_up').addEvent('click', function(){
	        increment();
	        });
        }	
}

function prepare2()
{
    var foo = document.id('quantity_box_button_up'); 
if (foo) {
    document.id('quantity_box_button_down').addEvent('click', function(){
	    decrement();
	    });
}

}

function increment()
{
    var qty_el							= document.getElementById('quantity_adjust'); 
    var qty								= qty_el.value;
    if( !isNaN( qty )) qty_el.value++;
    var cost_el							= document.getElementById('q1'); 
    var cost 							= cost_el.value;
    var cost_el_2						= document.getElementById('q2'); 
    var cost_2							= cost_el_2.value;
    var time							= 1;
    document.adminForm.q1t.value		= (cost * (parseInt(qty) + 1));
    document.adminForm.q2t.value		= (cost_2 * (parseInt(qty) + 1));
    document.adminForm.time.value		= (time * (parseInt(qty) + 1));	
    check_stock_control();
    return false;
}

function decrement()
{

	var qty_el							= document.getElementById('quantity_adjust');
	var qty								= qty_el.value ;

	if( !isNaN( qty ) && qty > 0 ) qty_el.value--;
	var cost_el 						= document.getElementById('q1');
	var cost 							= cost_el.value;
	var cost_el_2 						= document.getElementById('q2');
	var cost_2 							= cost_el_2.value;
	var time							= 1;
	document.adminForm.q1t.value		= cost * (qty-1);
	document.adminForm.q2t.value		= cost_2 * (qty-1);
	document.adminForm.time.value		= (time * (parseInt(qty) - 1));	
	check_stock_control();
	 return false;
}


///////////////////////////////////////////////////////////////

function request_shop_metals()
{
	var all = '';
	var details = this.details;
	//	var id = $('image').get('number');
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_metals&building_id=" 
		+ building_id , 
    onSuccess: function(result){
       	    	
    for (i = 0; i < result.length; ++ i)
	{
	
        var row = "<div class='row'><span>" 
        + (i+1) + ": " 
		+ result[i].name 
		+ ":</span><span class='price'>$" 
        + result[i].sell_price 
		+ "</span><a href='#' class='buy' id='" 
        + result[i].item_id 
		+ "'>BUY</a></div>"; 
  		all= all + row;
  		}
		id=0;
		all= all + '';
		document.id('building_inventory_table').innerHTML = all;
		$$('.buy').addEvent('click', function(){
			var itemID = this.get('id');
			buy_metal(itemID);
			});
		}
	}).get();
}

function request_get_metals_to_sell(){
	var all = '';
	var details = this.details;
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=get_metals_to_sell&building_id=" 
		+ building_id , 
        onSuccess: function(result){
            for (i = 0; i < result.length; ++ i)
			{
                var row = "<div class='row'><span>"
				+result[i].name 
				+ "</span><span class='price'>COST:" 
                + result[i].buy_price 
				+ "</span><a href='#' class= 'sell' id='" + result[i].item_id 
                + "' >SELL</a></div>"; 
 				all= all + row;
 				}
				all= all + '';
				document.id('my_inventory').innerHTML = all;
				$$('.sell').addEvent('click', function(){
					var itemID = this.get('id');
					sell_metal(itemID);
					});
				}
	}).get();
	}

function request_metals2()
{
	var total_metals    = parseInt(0);
	var all             = '';
	//var all = '<table class="shade-table"><tbody>';
	var details         = this.details;
	var a               = new Request.JSON(
	{
		url: 'index.php?option=com_battle&format=raw&task=action&action=get_metals2&building_id=' 
		+ building_id , 
    	onSuccess: function(result)
    	{
        	 for (i = 0; i < result.length; ++i)
        	 {
            	 var row = '<br/>Metal ' + (i+1) + ':' + result[i].name  + ' : ' + result[i].quantity;
            	 all= all + row;
            	 total_metals = parseInt(total_metals) + parseInt(result[i].quantity);
        	 }
        	 all = all + '<br/>Total Metals: ' + total_metals;
        	 document.id('my_inventory2').innerHTML = all;
        }
      }).get();
}
        	 
function buy_metal(itemID){
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy_metal&building_id=" 
    + building_id + "&metal=" + itemID, 
    onSuccess: function(result){
    	    
    	}
    }).get();
}

function sell_metal(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_metal&building_id=" 
    + building_id + "&metal=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
}



function eat(itemID)
{
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=eat",
		onSuccess: function(result){
			if (result=="success"){
					alert("You gained 10 health points which cost you 10 credits");
					document.id('eat_burger').setStyle('visibility','hidden');
					}
			if (result=="broke"){
					alert("You don't have enough money. Get out of here! Go get a job you waster!");
					document.id('eat_burger').setStyle('visibility','hidden');
					}
		}
	}).get();
}

function display_alert_deposit()
{
  alert("Thank you for the deposit.\nYour money is safe with us.");
}
  
function display_alert_withdraw()
{
  alert("Thank you for your valued custom.\nWe hope to see you again soon.");
}

function deposit()
{

	$$('#deposit').addEvent('click', function(){

		var qty_el = document.getElementById('quantity_adjust'); 
		var qty = qty_el.value; 
		var a = new Request.JSON({
			    url: "index.php?option=com_battle&format=raw&task=action&action=deposit&building_id=" 
			    + building_id + "&amount=" + qty  ,
			    onSuccess: function(result){
			      
			   // $(result[0]).innerHTML = result[1];	
			   // $(result[2]).innerHTML = result[3];	
			  //  $(deposit).setStyle('visibility','hidden');
		  	    
			    	}
			    }).get();
		    
		
		});	
}

function withdraw()
{

    $$('#withdraw').addEvent('click', function()
    {

    		var qty_el = document.getElementById('quantity_adjust2'); 
    		var qty = qty_el.value; 
    		var a = new Request.JSON({
    			    url: "index.php?option=com_battle&format=raw&task=action&action=withdraw&building_id=" 
    			    + building_id 
    			    + "&amount=" 
    			    + qty  ,
    			    onSuccess: function(result){
    			      
    			   // $(result[0]).innerHTML = result[1];	
    			   // $(result[2]).innerHTML = result[3];	
    			  //  $(deposit).setStyle('visibility','hidden');
    		  	    
    			    	}
    			    }).get();
      });	
}	




function buy_bullets()
{

    $$('#buy_bullets').addEvent('click', function()
    {

    		var qty_el = document.getElementById('quantity_adjust'); 
    		var qty = qty_el.value; 
    		var a = new Request.JSON({
    			    url: "index.php?option=com_battle&format=raw&task=action&action=buy_bullets&building_id=" 
    			    + building_id 
    			    + "&amount=" 
    			    + qty  ,
    			    onSuccess: function(result){
    			      
    			   // $(result[0]).innerHTML = result[1];	
    			   // $(result[2]).innerHTML = result[3];	
    			  //  $(deposit).setStyle('visibility','hidden');
    		  	    
    			    	}
    			    }).get();
      });	
}	










    

function request_batteries()
{
	 var all = '';
	//	var details = this.details;
	var a = new Request.JSON(
	{
        url: "index.php?option=com_battle&format=raw&task=action&action=get_batteries", 
        onSuccess: function(result)
        {
           	    	
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='put' id='" 
                + result[i][0] + "'><span class='label'>Battery " 
                + (i+1) + ":</span>" 
                + result[i][1]  + " : " 
                + result[i][2]+ "</div>";
          
                all= all + row;  
            }
            document.id('generator').innerHTML = all;	

	        $$('.put').addEvent('click', function()
	        {
			        var itemID = this.get('id');
			        put_battery(itemID);
	        });
        }	
    }).get();
}

function request_battery_slots()
{
	var all = '';
	//	var details = this.details;
	var a = new Request.JSON(
	{
        url: "index.php?option=com_battle&format=raw&task=building_action&action=get_battery_slots&building_id=" 
        + building_id , 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
  	            var row = "<div class='get' id='" 
  	            + result[i]['id'] + "'><span class=\"label\">Battery " 
  	            + (i+1) 
  	            + ":</span>" 
  	            + result[i]['id']  + " : " 
  	            + result[i]['units'] +"</div>";
  	            all= all + row ;  
    	}
    	document.id('batteries_inv').innerHTML = all;

	$$('.get').addEvent('click', function(){
			var itemID = this.get('id');
			get_battery(itemID);
			});
    }	
    }).get();
}

function get_battery(itemID){
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=building_action&action=get_battery&building_id=" 
    + building_id + "&item=" + itemID, 
    onSuccess: function(result){
     	}
    }).get();
 
}

function put_battery(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=put_battery&building_id=" 
    + building_id + "&item=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}

function get_shop_papers(){
	
	var all = '';
	var details = this.details;
	var a = new Request.JSON(
	{
    	url: "index.php?option=com_battle&format=raw&task=building_action&action=get_shop_papers&building_id=" 
    	+ building_id, 
   		onSuccess: function(result)
   		{
			for (i = 0; i < result.length; ++ i)
			{
   	
   				var row = "<div class='row'><span>"
   				+ (i+1) 
   				+ ": " 
   				+ result[i].name 
   				+ ":</span><span class='price'>$" 
				+ result[i].sell_price 
				+ "</span><a href='#' class='buy' id='" 
   				+ result[i].item_id 
   				+ "'>BUY</a></div>"; 
  				all= all + row;  
   			}

			all= all + '';
	
		   	document.id('building_papers_table').innerHTML = all;	
		   	$$('.buy').addEvent('click', function()
		   	{
		  		var itemID = this.get('id');
		 		buy_papers(itemID);
		 	});
   	
   		}	
   }).get();
}

function get_papers(){
	var all		= '';
	var details = this.details;
	var a		= new Request.JSON(
	{
   		url: "index.php?option=com_battle&format=raw&task=building_action&action=get_papers", 
    	onSuccess: function(result)
    	{
       		for (i = 0; i < result.length; ++ i)
       		{
				var row = "<div class='row'><span>" 
				+ (i+1) + ":" 
				+ result[i].name 
				+ "</span><span class='price'>COST:" 
				+ result[i].buy_price 
				+ "</span><a href='#' class= 'sell' id='" 
				+ result[i].item_id 
				+ "' >SELL</a></div>";
				all= all + row;  
    		}
			all = all + '';	
			document.id('my_papers').innerHTML = all;	
			$$('.sell').addEvent('click', function()
			{
				var itemID = this.get('id');
	 			sell_papers(itemID);
	 		});
    	}	
   }).get();
}

function buy_papers(itemID)
{
	var a = new Request.JSON(
	{
    	url: "index.php?option=com_battle&format=raw&task=action&action=buy_papers&building_id=" 
    	+ building_id + "&item=" + itemID, 
    	onSuccess: function(result)
    	{
    	
    	}
    }).get();
 
}

function sell_papers(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action==sell_papers&building_id=" 
    + building_id + "&item=" + itemID, 
    onSuccess: function(result){
   	   
    	}
    }).get();
 
}

function sell_crops(){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_crops", 
    onSuccess: function(result){
   	   	document.id('sell_crops').setStyle('display','none'); 
    	}
    }).get();
 
}

function work_field(itemID)
{	 	
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=building_action&action=work_field&building_id=" 
    + building_id + "&crop=1&field=" + itemID  ,
    onSuccess: function(result){
     	//new tmp element that contains the new div
    	var tmpDiv = new Element('div',
    	{
    		html:'<div id="' + itemID + '" class="work_field" style="text-align:center;"> <img src ="components/com_battle/images/5.gif"/></div>'
    	}
    	);
    	//new div (first child of my tmp div) replaces the old 'myDiv' (that can be grabbed from the DOM by $)
    	tmpDiv.getFirst().replaces(document.id(itemID));
		document.id('farm_progress_'+itemID).setStyle('display','block');
		document.id('farm_controls_'+itemID).setStyle('display','none');
    	}
    }).get();
    
}

 
function check_farm(){
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=building_action&action=check_farm&field=1&building="
    + building_id ,
    onSuccess: function(result){
     
        itemID = result['field'];
        status = result['status'];
        document.getElementById('since').innerHTML = result['since'];
        document.getElementById('now').innerHTML = result['now'];
        document.getElementById('elapsed').innerHTML = result['elapsed'];
        document.getElementById('remaining').innerHTML = result['remaining'];
        document.getElementById('message_text_'+itemID).innerHTML = result['status_message'];
       
        text = '<img src = "components/com_battle/images/' + result["status"] + '.gif">';
        document.getElementById(itemID).innerHTML = text;

        if (result['remaining'] <= 0 )
        {
                    
                    
                   // $('adminForm').setStyle('visibility','visible');
 
                    document.id('farm_progress_'+ itemID).setStyle('display','none');
                    document.id('farm_controls_'+ itemID).setStyle('display','block');
      
                   // string_text = 'status_message_'+ itemID;
    
                    //document.id(string_text).setStyle('visibility','visible');

                 /*
                 
                    var tmpDiv = new Element('div',
                    {html:'<div>', '<div ="' + itemID + '" class= ="work_field"><img src ="components/com_battle/images/'
                    +result['status'] +'.gif" /></div>'});
                    tmpDiv.getFirst().replaces(document.id(itemID));
                    */

                    $$('.work_field').removeEvent('click', test);

                    $$('.work_field').addEvent('click',function(){
                    
                    work_field(itemID);
                    });
             }
             else{
            
                    document.id('farm_progress_'+ itemID).setStyle('display','block');
                    document.id('farm_controls_'+ itemID).setStyle('display','none');
             }
         }
    }).get();
}
function work_flat(itemID){	 	
    var a = new Request.JSON({
    	url: "index.php?option=com_battle&format=raw&task=building_action&action=work_flat&building_id=" 
    	+ building_id + "&flat=" + itemID  ,
    	onSuccess: function(result){
    
    	if (result[0]=="broke"){
    
    	alert(result[0] + '.You need 1000 credits IN THE BANK to rent an apartment. Then you will be safe from attack! 1000 Credits will be withdrawn from your account every week.')
    
    	}
     	else {
				 alert(result[3]);
				document.id(result[0]).innerHTML = result[1];	
				document.id(result[2]).innerHTML = result[3];	
				document.id(result[4]).innerHTML = result[5];
				document.id(result[6]).innerHTML = result[7];
  	    }
   	}
    }).get();
}

function get_shop_blueprints(id)
{
	var all		= '<table class="shade-table"><tbody>';
	var details = this.details;
	var a		= new Request.JSON(
	{
		url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_blueprints&building_id=" 
		+ building_id,
		onSuccess: function(result)
		{
			for (i = 0; i < result.length; ++ i)
			{
				var row = "<tr class=\"d" 
				+ (i & 1) 
				+ "\"><td> Blueprint for " 
				+ (i+1) 
				+ ": " 
				+ result[i].name + ":</td><td>$" 
				+ result[i].sell_price 
				+ "<a href='#' class='buy' id='" 
				+ result[i].object 
				+ "'>[BUY]</a></td></tr>";
				all = all + row;
			}
			all = all + '</tbody></table>';
			document.id('building_papers_table').innerHTML = all;
			$$('.buy').addEvent('click', function()
			{
				var itemID = this.get('id');
				buy_blueprint(itemID);
			});
		}
	}).get();
}

function get_my_blueprints(){
	var all = '<table class="shade-table"><tbody>';
	//var details = this.details;
	var a = new Request.JSON({
	url: "index.php?option=com_battle&format=raw&task=building_action&action=get_my_blueprints_list",
	onSuccess: function(result){
		for (i = 0; i < result.length; ++ i)
		{
			var row = "<tr class=\"d" 
			+ (i & 1) 
			+ "\"><td> Blueprint for " 
			+ result[i].name 
			+ "</td></tr>";
			all= all + row;
		}
		all                         = all + '</tbody></table>';
		document.id('my_papers').innerHTML    = all;
	}
	}).get();

}

function buy_blueprint(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy_blueprints&building_id=" 
    + building_id + "&item=" 
    + itemID, 
    onSuccess: function(result){
    	    
    	}
    }).get();
 
}

///////////////////////////////
function changeDisplayImage()
{
	var id1					= new Array();
	var metal_name_1		= new Array();
	var metal_name_2		= new Array();
	var object_quantity		= new Array();
	//var mystock1 = 0;
	//var mystock2 = 0; 
	var q_1 = new Array();
	var q_2 = new Array();			
	Array.each(metals, function( )
	{
		if (metals[i].name == metal_name_1[index])
		{
			window.mystock1 = metals[i].quantity;
		}
		if (metals[i].name == metal_name_2[index])
		{
			window.mystock2 = metals[i].quantity;
		}
		i++;
	});
	if (document.adminForm.blueprints.value !='')
	{
		index                           = id1[document.adminForm.blueprints.value];
		document.adminForm.id1.value    = id1[index];
		document.adminForm.q1.value     = q_1[index];
		document.adminForm.n1.value     = metal_name_1[index];
        document.adminForm.q2.value     = q_2[index];
        document.adminForm.n2.value     = metal_name_2[index]  ;
        document.adminForm.stock.value  = object_quantity[index];
      //document.adminForm.stock.value  = 7;                  		
		i                               = 0;
		Array.each(metals, function( )
		{
			if (metals[i].name == metal_name_1[index])
			{
				mystock1 = metals[i].quantity;
			}
			if (metals[i].name == metal_name_2[index])
			{
				mystock2 = metals[i].quantity;
			}
			i++;
		}); 
        // document.adminForm.stock2.value = mystock2;
        check_stock_control();
    }
    else 
    {
        document.adminForm.imagelib.src='images/blank.png';
    }
}






function get_blueprints()
{

    var a = new Request.JSON(
    {
		url: "index.php?option=com_battle&format=raw&task=building_action&action=get_blueprints&blueprints=" 
		+ document.adminForm.id1.value,
		onSuccess: function(result)
		{
			for(var i=0;i<result.length;i++)
			{
				var row = result[i];
				console.log(row);
				for(var key in row)
				{
				    var attrName		= key;
				    var attrValue		= row[key];
			  		var x				= row.id;
			  		//console.log(x);
			  		//window.id1[x]				= row.id;		  		
					window.id1[x]				= x ;
					window.q_1[x]				= row.quantity_1;
					window.q_2[x]				= row.quantity_2;
					window.metal_name_1[x]		= row.metal_1_name;
					window.metal_name_2[x]		= row.metal_2_name;
				}
			}	
		}
	}).get();
}










///////////////////////////////

function changeCrops()
{
    i=0;
    index							= document.adminForm.crops.value;
    
	
	
	
	    var a = new Request.JSON(
    {
		url: "index.php?option=com_battle&format=raw&task=building_action&action=get_crop_index&crop=" 
		+ index,
		onSuccess: function(result)
		{


            document.adminForm.Crop_Index.value = result[0];
            
            Magic_index						= document.adminForm.Magic_Index.value;
            Crop_index						= document.adminForm.Crop_Index.value;
            Skill_index						= document.adminForm.Skill_Index.value; 
            
            
            document.adminForm.ETA.value = Magic_index * Crop_index * Skill_index * 50;
		
		}
	}).get();

}



//////////////////////////////////////////////////////////////////////////////////////////////////////




///////////////////////////////

function change()
{
    i=0;
    index							= window.id1[document.adminForm.blueprints.value];
	Array.each(window.metals, function( )
	{
		if (window.metals[i].name == window.metal_name_1[index])
		{
			window.mystock1 = window.metals[i].quantity;
		}
		if (window.metals[i].name == window.metal_name_2[index])
		{
			window.mystock2 = window.metals[i].quantity;
		}
		i++;
	});

	if (document.adminForm.blueprints.value !='')
	{
		index							= window.id1[document.adminForm.blueprints.value];
		
		//document.adminForm.id1.value	= window.id1[index];
		
		
		document.adminForm.id1.value	= window.id1[2];
		//document.adminForm.id1.value	= 2;
		
		
    	document.adminForm.q1.value		= window.q_1[index];
		document.adminForm.n1.value		= window.metal_name_1[index];
        document.adminForm.q2.value		= window.q_2[index];
        document.adminForm.n2.value		= window.metal_name_2[index]  ;    		
		i = 0;
		Array.each(metals, function( )
		{
			if (metals[i].name == metal_name_1[index]) {
				window.mystock1 = metals[i].quantity;
				}
			if (metals[i].name == metal_name_2[index]) {
				window.mystock2 = metals[i].quantity;
				}
			i++;
		}); 
        document.adminForm.stock.value = window.mystock1;
        document.adminForm.stock2.value = window.mystock2;
        check_stock_control();
     }
	else
	{
		document.adminForm.imagelib.src='images/blank.png';
	}
}



//////////////////////////////////////////////////////////////////////////////////////////////////////

function buy_building() {
	$$('.buy').addEvent('click', function(){
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=buy_building&building_id=" 
			+ building_id , 
				onSuccess: function(result){
					document.id('building_id').setStyle('visibility','hidden');
				}
		}).get();
	});
} 

function work_conveyer()
{
    var foo = document.id('submit_c'); 
    if (foo) 
    {
	document.id('submit_c').addEvent('click', function()
	{
		work();
	});

    }
}

function work(){
	var a = new Request.JSON(
	{
		url: "index.php?option=com_battle&format=raw&task=building_action&action=work_conveyer&quantity=" 
		+ document.adminForm.time.value 
		+ "&building_id=" + building_id + "&line=1&type=" + document.adminForm.id1.value  ,
		onSuccess: function(result){
			document.id('adminForm').setStyle('visibility','hidden');
			document.id('conveyor_progress').setStyle('visibility','visible');
			}
	}).get();
}

function work_reprocessor()
{
    var foo = document.id('submit_c'); 
    if (foo)
    {
	    document.id('submit_c').addEvent('click', function()
	    {
		    reprocess();
	    });
    }
}

function reprocess(){
	var a = new Request.JSON(
	{
		url: "index.php?option=com_battle&format=raw&task=building_action&action=work_reprocessor&quantity=" 
		+ document.adminForm.time.value 
		+ "&building_id=" + building_id + "&line=1&type=" + document.adminForm.id1.value  ,
		onSuccess: function(result){
			document.id('adminForm').setStyle('visibility','hidden');
			document.id('conveyor_progress').setStyle('visibility','visible');
			}
	}).get();
}

function test_rob()
{
	alert();
}

function check_reprocessor()
{
	var a = new Request.JSON(
	{
	    url: "index.php?option=com_battle&format=raw&task=building_action&action=check_reprocessor&line=1&building=" 
	    + building_id , 
        onSuccess: function(result)
        {
	        document.getElementById('since').innerHTML      = result['since'];
	        document.getElementById('now').innerHTML        = result['now'];
	        document.getElementById('elapsed').innerHTML    = result['elapsed'];
	        document.getElementById('remaining').innerHTML  = result['remaining'];        
            if (result['remaining'] <= 0)
            {
	            document.id('adminForm').setStyle('visibility','visible');
		        document.id('conveyor_progress').setStyle('visibility','hidden');
		    }
	     }
	}).get();
}

function check_factory()
{
		var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=building_action&action=check_factory&line=1&building=" 
		+ building_id , 
	    onSuccess: function(result)
	    {
		    document.getElementById('since').innerHTML      = result['since'];
		    document.getElementById('now').innerHTML        = result['now'];
		    document.getElementById('elapsed').innerHTML    = result['elapsed'];
		    document.getElementById('remaining').innerHTML  = result['remaining'];        
	        if (result['remaining'] <= 0){
		        document.id('adminForm').setStyle('visibility','visible');
			    document.id('conveyor_progress').setStyle('visibility','hidden');
			    }
		    }
	    }).get();
}
		    

function request_metals(){


	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_metals2", 
    onSuccess: function(result){
    window.metals= result;
    
    
    
    }
    }).get();
}




function check_stock_control(){
//	if whats in stock is less than required total hide submit button and change background to red
//  else change to green and show submit
    var stck = document.getElementById('stock');
	var ct1 = parseInt(stck.value);
	var stck2 = document.getElementById('stock2');
	var ct2 = parseInt(stck2.value);
	var qy1 = document.getElementById('q1t');
	var q_y1 = parseInt(qy1.value);
	var qy2 = document.getElementById('q2t');
	var q_y2 = parseInt(qy2.value);
 	if ((ct1 < q_y1) || (ct2 < q_y2))
	{
		document.id('q1t').setStyle('background','red');
		document.id('q2t').setStyle('background','red');
		document.id('submit_c').setStyle('visibility','hidden');
	}
	if((ct1 > q_y1)  && (ct2 > q_y2))
	{
		document.id('q1t').setStyle('background','black');
		document.id('q2t').setStyle('background','black');
		document.id('submit_c').setStyle('visibility','visible');
	}
}

function check_mine(){
	var a = new Request.JSON(
	{
		url: "index.php?option=com_battle&format=raw&task=building_action&action=check_mine&building_id=" 
		+ building_id , 
    onSuccess: function(result)
		{

			document.getElementById('since').innerHTML = result['since'];
			document.getElementById('now').innerHTML = result['now'];
			document.getElementById('elapsed').innerHTML = result['elapsed'];
			document.getElementById('remaining').innerHTML = result['remaining'];        

			if(result['remaining']<=0)
			{
		 		$$('#mine_board1').setStyle('visibility','visible');
		   		$$('#mine_progress1').setStyle('visibility','hidden');
			}
          
    	}
    }).get();
}

function dig() {
	$$('.mine').addEvent('click', function(){
		var type = this.get('type');
		mine(type);
		});
	}	





function mine(type)
{
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=building_action&action=work_mine&building_id=" 
		+ building_id + "&type=" + type, 
    onSuccess: function(result){
               	
    	$$('#mine_board1').setStyle('visibility','hidden');
        $$('#mine_progress1').setStyle('visibility','visible');  	    
    	}
    }).get();
}






/*

//SAMPLE 4 (walk to item)
	var nS4 = new noobSlide(
	{
			box: document.id('box4'),
			items: $$('#box4 div'),
			size: 640,
			handles: $$('#handles4 span'),
			onWalk: function(currentItem,currentHandle){
				// $('info4').set('html',currentItem.getFirst().innerHTML);
				this.handles.removeClass('active');
				currentHandle.addClass('active');
	}
			
});	

*/

			
			
function request_shop_inventory()
{
	var all = '';
	var details = this.details;
	//	var id = $('image').get('number');
	var a = new Request.JSON(
	{
		url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_inventory&building_id=" 
		+ building_id, 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='object'><a href='#' title='" 
                + result[i].name + "' class='buy' id='" 
                + result[i].item_id + "'><img src='/components/com_battle/images/objects/" 
                + result[i].name + ".png' height='32' width='32' /></a><span class='price'>$" 
                + result[i].sell_price + "</span></div>"; 
  		        all= all + row;
  		    }
		    id      = 0;
		    all     = all + '';
		    document.id('building_inventory_table').innerHTML = all;
		    $$('.buy').addEvent('click', function()
		    {
			    var itemID = this.get('id');
			    buy1(itemID);
		    });
		}
	}).get();
}

function request_inventory()
{
	var all = '';
	var details = this.details;
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=get_inventory_to_sell&building_id=" 
		+ building_id, 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<div class='object'><a href='#' title='" 
                + result[i].name + "' class='sell' id='" 
                + result[i].item_id 
                + "'><img src='/components/com_battle/images/objects/" 
                + result[i].name + ".png' height='32' width='32' /></a><span class='price'>$" 
                + result[i].buy_price 
                + "</span></div>"; 
 				all= all + row;
 			}
			all= all + '';
			document.id('my_inventory').innerHTML = all;
			$$('.sell').addEvent('click', function()
			{
				var itemID = this.get('id');
				sell1(itemID);
			});
		}
	}).get();
}


function buy1(itemID){
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy&building_id=" 
    + building_id 
    +"&item=" 
    + itemID, 
    onSuccess: function(result){
    	    
    	}
    }).get();
 
}

function sell1(itemID)
{
 
	var a = new Request.JSON(
	{
        url: "index.php?option=com_battle&format=raw&task=action&action=sell&building_id=" 
        + building_id + "&item=" 
        + itemID, 
        onSuccess: function(result)
        {
       	   
        }
    }).get();
}
