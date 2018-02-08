<label>Hobbit Workforce</label>

<input type="text" class="inputboxquantity" size="4" id="hobbits_total" name="hobbits_total" value="1" style="vertical-align: middle;"/>


<input type="button" class="quantity_box_button quantity_box_button_up" onclick="var qty_el = document.getElementById('hobbits_total'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;get_hobbit_names('up',1);return false;" value="+" />





<input type="button" class="quantity_box_button quantity_box_button_down" onclick="var qty_el = document.getElementById('hobbits_total'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) qty_el.value--;get_hobbit_names('down',1);return false;" value="-" />

