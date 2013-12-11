<?php defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div id="inventory">
	<div id="left" style="width: 49.5%; float: left;">
		<div id="building_inventory_table">
				<div class="name"> Buy Bullets</div>
				

				<input type="text" class="inputboxquantity" size="4" id="quantity_adjust" name="quantity_adjust" placeholder="quantity" style="vertical-align: middle;" onchange="alterQuantity(this.form)"/>


<input type="button" class="quantity_box_button quantity_box_button_up" onclick="var qty_el = document.getElementById('quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;" value="+" />
<input type="button" class="quantity_box_button quantity_box_button_down" onclick="var qty_el = document.getElementById('quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) qty_el.value--;return false;" value="-" />
<a onclick="display_alert_deposit()" href = '#' id = 'buy_bullets' class = 'deposit'>Buy Bullets</a>
<br />  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="controller" value="buildings" />
  <input type="hidden" name="task" value="buy_bullets" />

</div>
				
				
		</div>

	</div>
	<!--end of left -->
	<div id="middle" style="width: 49.5%; float: left;">
		
	</div>
	<!-- end of middle -->
<div>
<!-- end of inventory -->
<!--end inventory-->

