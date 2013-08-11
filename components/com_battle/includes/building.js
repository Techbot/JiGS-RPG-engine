(function(){

	buy_building();
	window.id1 = new Array();
	window.metal_name_1 = new Array();
	window.metal_name_2 = new Array();
	window.mystock1 = 0;
	window.mystock2 = 0; 
	window.q_1 = new Array();
	window.q_2 = new Array();	  
	window.metals = new Array();
	request_metals();
	var refTab = document.getElementById("stats");

	var row = refTab.rows[0];
	var col = row.cells[1]; 
	//alert(col.firstChild.nodeValue);

	//var  col =   refTab.rows[1].cells[1]; 
	//alert(col.firstChild.nodeValue);
	building_id = col.firstChild.nodeValue;

	var row = refTab.rows[3];
	var col = row.cells[1]; 
	//alert(col.firstChild.nodeValue);

	//var  col =   refTab.rows[1].cells[1]; 
	//alert(col.firstChild.nodeValue);
	window.building_type = col.firstChild.nodeValue;	
	//change();
	//noobslide
    
    if (window.building_type=="mine"){
 
 		dig();
		check_mine();
		check_mine.periodical(2000);
    
    
    }
    
    if (window.building_type=="blueprints")
	{
     	get_my_blueprints.periodical(1000);
		get_shop_blueprints.periodical(1000);
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
     	$$('.work_field').addEvent('click',function(){
			var itemID = this.get('id');
			work_field(itemID);
		
		});
 		
 		check_farm.periodical(5000)

	}
	   
	if (window.building_type=="food")
	{
     	$('sell_crops').addEvent('click', function(){
		 // var itemID = this.get('id');
 		  sell_crops();
  		});

	}


})();

function sell_crops(){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=sell_crops", 
    onSuccess: function(result){
   	   	$('sell_crops').setStyle('visibility','hidden'); 
    	}
    }).get();
 
}


function work_field(itemID){	 	
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=building_action&action=work_field&building_id=" + building_id + "&crop=1&field=" + itemID  ,
    onSuccess: function(result){
   
    	//new tmp element that contains the new div
    	var tmpDiv = new Element('div',
    	{
    		html:'<div id="'+itemID+'"><img src ="components/com_battle/images/jigs_loader.gif"/></div>'
    	
    	}
    	);
    	//new div (first child of my tmp div) replaces the old 'myDiv' (that can be grabbed from the DOM by $)
    	tmpDiv.getFirst().replaces($(itemID));
   
		$('farm_progress').setStyle('visibility','visible');
	    
    	}
    }).get();}

 
    function check_farm(){
		var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=building_action&action=check_farm&field=1&building=" + building_id , 
	    onSuccess: function(result){
 
		    document.getElementById('since').innerHTML = result['since'];
		    document.getElementById('now').innerHTML = result['now'];
		    document.getElementById('elapsed').innerHTML = result['elapsed'];
		    document.getElementById('remaining').innerHTML = result['remaining'];
			itemID = result['field'];
			status = result['status'];
	        if (result['remaining'] <= 0 ){
		       // $('adminForm').setStyle('visibility','visible');
			    $('farm_progress').setStyle('visibility','hidden');
				var tmpDiv = new Element('div',{html:'<div id="'+itemID+'" class ="work_field"><img src ="components/com_battle/images/'+result['status'] +'.gif" /></div>'});
				//new div (first child of my tmp div) replaces the old 'myDiv' (that can be grabbed from the DOM by $)
				tmpDiv.getFirst().replaces($(itemID));
				$$('.work_field').removeEvent('click', test);
				
				
				
				$$('.work_field').addEvent('click',function(){
			var itemID = this.get('id');
			work_field(itemID);
		
		});
			  
			  
			  
			  
			  
			  
			  
			  
			    }
		    }
	    }).get();
	    }

    
    function work_flat(itemID){	 	
    var a = new Request.JSON({
    	url: "index.php?option=com_battle&format=raw&task=work_flat&building_id=" + building_id + "&flat=" + itemID  ,
    	onSuccess: function(result){
    
    	if (result[0]=="broke"){
    
    	alert(result[0] + '.You need 1000 credits IN THE BANK to rent an apartment. Then you will be safe from attack! 1000 Credits will be withdrawn from your account every week.')
    
    	}
     	else {
				 alert(result[2]);
				$(result[0]).innerHTML = result[1];	
				$(result[2]).innerHTML = result[3];	
				$(result[4]).innerHTML = result[5];
				$(result[6]).innerHTML = result[7];
  	    }
   	}
    }).get();
}


function get_shop_blueprints(id)
{
	var all		= '<table class="shade-table"><tbody>';
	var details = this.details;
	var a		= new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=get_shop_blueprints&building_id=" + building_id,
		onSuccess: function(result){
			for (i = 0; i < result.length; ++ i){
				var row = "<tr class=\"d" + (i & 1) + "\"><td> Blueprint for " 
				+ (i+1) + ": " 
				+ result[i].name + ":</td><td>$" + result[i].sell_price 
				+ "<a href='#' class='buy' id='" 
				+ result[i].object + "'>[BUY]</a></td></tr>";
				all= all + row;
				}
				all= all + '</tbody></table>';
				$('building_papers_table').innerHTML = all;
				$$('.buy').addEvent('click', function(){
				var itemID = this.get('id');
				buy(itemID);
				});
				}
}).get();

}

function get_my_blueprints(){
	var all = '<table class="shade-table"><tbody>';
	//var details = this.details;
	var a = new Request.JSON({
	url: "index.php?option=com_battle&format=raw&task=action&action=get_blueprints",
	onSuccess: function(result){
		for (i = 0; i < result.length; ++ i){
			var row = "<tr class=\"d" + (i & 1) + "\"><td> Blueprint for " + result[i].name + "</td></tr>";
			all= all + row;
		}
		all= all + '</tbody></table>';
		$('my_papers').innerHTML = all;
	}
	}).get();

}

function buy_blueprint(itemID){
 
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=buy_blueprints&building_id=" + building_id + "&item=" + itemID, 
    onSuccess: function(result){
    	    
    	}
    }).get();
 
}





function get_blueprints(){

var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=building_action&action=get_blueprints&blueprints=" +
		document.adminForm.id1.value,
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




function change(blueprint)
{
	
	if (document.adminForm.blueprints.value !='')
	{
		index							= id1[document.adminForm.blueprints.value];
		document.adminForm.id1.value	= window.id1[index];
		
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

function buy_building() {
	$$('.buy').addEvent('click', function(){
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=buy_building&building_id=" + building_id , 
				onSuccess: function(result){
					$('building_id').setStyle('visibility','hidden');
				}
		}).get();
	});
} 

function prepare(){
	$('quantity_box_button_up').addEvent('click', function(){
		increment();
		});
	}

function prepare2()
{
	$('quantity_box_button_down').addEvent('click', function(){
		decrement();
		});
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

function decrement(){

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

function work_conveyer()
{
	$('submit_c').addEvent('click', function()
	{
		work();
	});
}

function work(){
	var a = new Request.JSON(
	{
		url: "index.php?option=com_battle&format=raw&task=work_conveyer&quantity=" + document.adminForm.time.value 
		+ "&building_id=" + building_id + "&line=1&type=" + document.adminForm.id1.value  ,
		onSuccess: function(result){
			$('adminForm').setStyle('visibility','hidden');
			$('conveyor_progress').setStyle('visibility','visible');
			}
	}).get();
}


function test_rob()
{
	alert();
}

function check_factory(){
			var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=check_factory&line=1&building=" + building_id , 
		    onSuccess: function(result){
			    document.getElementById('since').innerHTML = result['since'];
			    document.getElementById('now').innerHTML = result['now'];
			    document.getElementById('elapsed').innerHTML = result['elapsed'];
			    document.getElementById('remaining').innerHTML = result['remaining'];        
		        if (result['remaining'] <= 0){
			        $('adminForm').setStyle('visibility','visible');
				    $('conveyor_progress').setStyle('visibility','hidden');
				    }
			    }
		    }).get();
		    }
function request_metals(){
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_metals2", 
    onSuccess: function(result){
    metals= result;
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
		$('q1t').setStyle('background','red');
		$('q2t').setStyle('background','red');
		$('submit_c').setStyle('visibility','hidden');
	}
	if((ct1 > q_y1)  && (ct2 > q_y2))
	{
		$('q1t').setStyle('background','black');
		$('q2t').setStyle('background','black');
		$('submit_c').setStyle('visibility','visible');
	}
}




function check_mine(){
	var a = new Request.JSON(
	{
		url: "index.php?option=com_battle&format=raw&task=building_action&action=check_mine&building_id=" + building_id , 
    onSuccess: function(result)
		{

			document.getElementById('since').innerHTML = result['since'];
			document.getElementById('now').innerHTML = result['now'];
			document.getElementById('elapsed').innerHTML = result['elapsed'];
			document.getElementById('remaining').innerHTML = result['remaining'];        

			if(result['remaining']<=0)
			{
		 		$$('#mine_board').setStyle('visibility','visible');
		   		$$('#mine_progress').setStyle('visibility','hidden');
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


function mine(type){
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=building_action&action=work_mine&building_id=" + building_id + "&type=" + type, 
    onSuccess: function(result){
               	
    	$$('#mine_board').setStyle('visibility','hidden');
        $$('#mine_progress').setStyle('visibility','visible');  	    
    	}
    }).get();
}


//SAMPLE 4 (walk to item)
	var nS4 = new noobSlide({
			box: $('box4'),
			items: $$('#box4 div'),
			size: 640,
			handles: $$('#handles4 span'),
			onWalk: function(currentItem,currentHandle){
				// $('info4').set('html',currentItem.getFirst().innerHTML);
				this.handles.removeClass('active');
				currentHandle.addClass('active');
			}
		});	
