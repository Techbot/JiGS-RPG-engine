
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$factories=$this->factories;

//	 echo '<pre>' ;
// print_r($factories);
//	 echo '</pre>';



$x=count($factories);
foreach ($factories as $row){

}
// Imagelist
$javascript			= 'onchange="changeDisplayImage(blueprints);"';
$directory			= '/images/banners';
$lists['blueprints']	=  JHTML::_('select.genericlist',$factories , 'blueprints',$javascript, 'id', 'name', 'select','select');
?>

<div id="factory_noob" class="sample">
<div class="mask3">
<div id="box4">
<div>
<div id='conveyor_progress' style='visibility: hidden;'>
<p>
<label title="when manufactoring began">Started: </label><span id="since"></span></p>
<p>
<label>Current Time: </label><span id="now"><?php echo date('l jS \of F Y h:i:s A',$now) ; ?></span>
</p>
<div id="time_elapsed" class='wrapper sec'>
<label title="since manufactoring began">Time Elapsed: </label> <span id="elapsed"> </span> secs
</div>

<div id="time_remaining" class='wrapper sec'>
<label title="until manufactoring is complete">Time Remaining: </label>
<span id="remaining"> </span>secs
</div>

</div>
<!-- end of conveyor_progress -->
<h3>Conveyor 1</h3>
<?php
// print_r ($x);

?>
<form class="conveyor" action="index.php" method="get" name="adminForm" id="adminForm"><fieldset class="object">

<legend>Object</legend>

<input type="text" title="Object ID" name="id1" id="id1"value="<?php echo $factories[0]->id ;?>" size="1" style="width: 10px;" maxlength="2" readonly="readonly" />
<?php echo '' .  $lists['blueprints'] . '';?>




<label title="Quantity of Objects Required" for="quantity_adjust">qty:</label>

<input type="text" id="quantity_adjust" name="quantity_adjust" value="0" style="width:20px;" size="2" onchange="alterQuantity(this.form)" /> 

<input title="Increase Quantity" type="button" id="quantity_box_button_up" value="+" size="4" /> 

<input title="Decrease Quantity" type="button" id="quantity_box_button_down" value="-" size="4" /> 

<span title="Start Manufacturing" id='submit_c'>Submit</span>
</fieldset>

<fieldset class="metal">

						<legend title="What the object is made from">Material</legend>

<fieldset>
<label title="Type of Metal required" for="n1">Metal:</label> 
<input class="inputbox" type="text" size="4" maxlength="6" name="n1" id="n1" style="width: 70px;" value="<?php echo $factories[0]->metal_1_name ;?>" /> 
<label title="Units per Object" for="q1">units:</label> 

<input class="inputbox" type="text" size="1" maxlength="2" name="q1" id="q1" style="width: 20px;" value="<?php echo $factories[0]->quantity_1 ;?>" /> 

<label title="Total Units" for="q1t">total:</label>
 <input class="inputbox" type="text" size="1" maxlength="2" value="<?php echo $factories[0]->metal_1_stock ;?>" name="q1t" id="q1t" style="width: 20px;" /> 
<label title="In Stock" for="q2t">In Stock:</label>

<input class="inputbox" type="text" size="1" maxlength="2" name="stock" id="stock"  style="width: 20px;" />
 </fieldset>

<fieldset>
<label title="Type of Metal required" for="n2">Metal:</label>
<input class="inputbox" type="text" size="4" maxlength="6" name="n2" id="n2" style="width: 70px;" value="<?php echo $factories[0]->metal_2_name ;?>" /> 
 <label title="Units per Object" for="q2">units:</label>
 
  <input class="inputbox" type="text" size="1" maxlength="1" name="q2" id="q2" style="width: 20px;" value="<?php echo $factories[0]->quantity_2 ;?>" /> 
<label title="Total Units" for="q2t">total:</label>
 <input class="inputbox" type="text" size="1" maxlength="2" value="<?php echo $factories[0]->metal_2_stock ;?>" name="q2t" id="q2t"  style="width: 20px;" />
 <label title="In Stock" for="q2t">In Stock:</label> 
<input class="inputbox" type="text" size="1" maxlength="2" name="stock2" id="stock2"  style="width: 20px;" />



						</fieldset>

					</fieldset>
					<input type="hidden" name="c" value="banner" /> <input
						type="hidden" name="id" value="" /> <input type="hidden"
						name="name" value="" /> <input type="hidden" name="task" value="" />
				</form>

			</div>
			<div>
				<h3>Conveyor 2</h3>
				<div id="meter">

					<img src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg"><img
						src="/components/com_battle/images/meter01.jpg">
				</div>
				<!--end of meter-->
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>

			</div>

			<div>
				<h3>Conveyor 3</h3>
				<ul>
					<li>Number of Employees: 7</li>
					<li>Employees Morale: 70%</li>
					<li>Employee Efficiency: 95%</li>
				</ul>
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

			<div>
				<h3>Conveyor 4</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img4.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

			<div>
				<h3>Conveyor 5</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img5.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>

			</div>

			<div>
				<h3>Conveyor 6</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img6.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>

			</div>

			<div>
				<h3>Conveyor 7</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img7.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>

			</div>

			<div>
				<h3>Conveyor 8</h3>
				<img
					src="<?php echo $this->baseurl ?>/components/com_battle/includes/img8.jpg"
					alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and
					wealth increase.</p>
			</div>

		</div>
	</div>
	<p class="buttons" id="handles4">
		<span title="Conveyor 1">C 1</span> <span title="Conveyor 2">C 2</span>
		<span title="Conveyor 3">C 3</span> <span title="Conveyor 4">C 4</span>
		<span title="Conveyor 5">C 5</span> <span title="Conveyor 6">C 6</span>
		<span title="Conveyor 7">C 7</span> <span title="Conveyor 8">C 8</span>
	</p>
</div>

<script type="text/javascript">

var metals = new Array();

request_metals();
prepare();
prepare2();
work_conveyer();
check_factory.periodical(5000);
 changeDisplayImage()
//noobslide


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

	var cost_el_2 = document.getElementById('q2'); 
	var cost_2 = cost_el_2.value;
	
	document.adminForm.q1t.value = (cost * (parseInt(qty) + 1));
	document.adminForm.q2t.value = (cost_2 * (parseInt(qty) + 1));

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

	document.adminForm.q1t.value = cost * (qty-1);
	document.adminForm.q2t.value = cost_2 * (qty-1);

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
		url: "index.php?option=com_battle&format=raw&task=work_conveyer&quantity=1&building_id=<?php echo $this->buildings->id ?>&line=1&type=" + document.adminForm.id1.value  ,
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
	var mystock1 = 0;
	var mystock2 = 0; 
			var q_1 = new Array();
			var q_2 = new Array();			
			<?php 
			$i=1;
			foreach ($factories as $row){
			
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
            var nS4 = new noobSlide({
			box: $('box4'),
			items: $$('#box4 div'),
			size: 640,
			handles: $$('#handles4 span'),
			onWalk: function(currentItem,currentHandle){
				$('info4').set('html',currentItem.getFirst().innerHTML);
				this.handles.removeClass('active');
				currentHandle.addClass('active');
			}
		});
		
function test_rob(){
	alert();
	}

function check_factory(){
			var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=check_factory&line=1&building=<?php echo $this->buildings->id ; ?>" , 
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
</script>
