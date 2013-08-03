
alert("popup");

(function(){
//  buy_building();
  
//  var metals = new Array();
alert("popup");
//request_metals();
//prepare();
//prepare2();
//work_conveyer();
//check_factory.periodical(5000);
 //changeDisplayImage()
//noobslide
      
})();

function buy_building() {
	$$('.buy').addEvent('click', function(){
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=buy_building&building_id=<?php echo $this->buildings->id ; ?>", 
				onSuccess: function(result){
					$('<?php echo $this->buildings->id ; ?>').setStyle('visibility','hidden');
				}
		}).get();
	});
} 





function prepare(){
	$('quantity_box_button_up').addEvent('click', function(){
		increment();
		});
	}

function prepare2(){
	$('quantity_box_button_down').addEvent('click', function(){
		decrement();
		});
	}



function increment(){
	var qty_el = document.getElementById('quantity_adjust'); 
	var qty = qty_el.value;
	
	if( !isNaN( qty )) qty_el.value++;

	var cost_el = document.getElementById('q1'); 
	var cost = cost_el.value;

	var cost_el_2	= document.getElementById('q2'); 
	var cost_2		= cost_el_2.value;

	var time		= <?php echo $blueprints[0]->man_time ;?>;
	
	document.adminForm.q1t.value = (cost * (parseInt(qty) + 1));
	document.adminForm.q2t.value = (cost_2 * (parseInt(qty) + 1));
	document.adminForm.time.value = (time * (parseInt(qty) + 1));	

	check_stock_control();

	return false;

	}

function decrement(){

	var qty_el = document.getElementById('quantity_adjust');
	var qty = qty_el.value ;
	
	if( !isNaN( qty ) && qty > 0 ) qty_el.value--;

	var cost_el = document.getElementById('q1');
	var cost = cost_el.value;

	var cost_el_2 = document.getElementById('q2');
	var cost_2 = cost_el_2.value;

	var time		= <?php echo $blueprints[0]->man_time ;?>;

	document.adminForm.q1t.value = cost * (qty-1);
	document.adminForm.q2t.value = cost_2 * (qty-1);
	document.adminForm.time.value = (time * (parseInt(qty) - 1));	
	
	check_stock_control();

	 return false;
	}

function work_conveyer() {
	$('submit_c').addEvent('click', function(){
		work();
		});
	}

function work(){
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=work_conveyer&quantity=" + document.adminForm.time.value + "&building_id=<?php echo $this->buildings->id ?>&line=1&type=" + document.adminForm.id1.value  ,
		onSuccess: function(result){
			$('adminForm').setStyle('visibility','hidden');
			$('conveyor_progress').setStyle('visibility','visible');
			}
	}).get();
	}

function changeDisplayImage() {
	var id1 = new Array();
	var metal_name_1 = new Array();
	var metal_name_2 = new Array();
	//var mystock1 = 0;
	//var mystock2 = 0; 
			var q_1 = new Array();
			var q_2 = new Array();			
			<?php 
			$i=1;
			foreach ($this->blueprints as $row){
			
			?>
			id1[<?php echo  $row->id ?>]="<?php echo $row->id ?>";

			q_1[<?php echo  $row->id ?>]="<?php echo $row->quantity_1 ?>";
			q_2[<?php echo  $row->id ?>]="<?php echo $row->quantity_2 ?>";
			
			metal_name_1[<?php echo  $row->id ?>]="<?php echo $row->metal_1_name ?>";
			metal_name_2[<?php echo  $row->id ?>]="<?php echo $row->metal_2_name ?>";
			<?php
			$i++ ; 
			 }
			?>
			if (document.adminForm.blueprints.value !='') {

				index = id1[document.adminForm.blueprints.value];

				document.adminForm.id1.value = id1[index];
				document.adminForm.q1.value = q_1[index];
				document.adminForm.n1.value = metal_name_1[index];
                 document.adminForm.q2.value = q_2[index];
                document.adminForm.n2.value = metal_name_2[index]  ;
                    		
				i=0;

				Array.each(metals, function( ){
					if (metals[i].name == metal_name_1[index]) {
						//alert('name: ' + metals[i].name + ' name: ' + metal_name_1[index]);
						mystock1 = metals[i].quantity;
						}
					if (metals[i].name == metal_name_2[index]) {
						//alert('name: ' + metals[i].name + ' name: ' + metal_name_2[index] );
						mystock2 = metals[i].quantity;
						}
					i++;
					}); // alerts 'name: Sun, index: 0', 'name: Mon, index: 1', etc.

                	document.adminForm.stock.value = mystock1;
                    document.adminForm.stock2.value = mystock2;
                    check_stock_control();
                    }
            else {
                document.adminForm.imagelib.src='images/blank.png';
                }
            }
//          var nS4 = new noobSlide({
//			box: $('box4'),
//			items: $$('#box4 div'),
//			size: 640,
//			handles: $$('#handles4 span'),
//			onWalk: function(currentItem,currentHandle){
//				$('info4').set('html',currentItem.getFirst().innerHTML);
//				this.handles.removeClass('active');
//				currentHandle.addClass('active');
//			}
//		});

		
function test_rob(){
	alert();
	}

function check_factory(){
			var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=check_factory&line=1&building=<?php echo $this->buildings->id ; ?>" , 
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

 
//
//
//

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

	
