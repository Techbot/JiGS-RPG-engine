<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<script>
function display_alert_deposit()
  {
  alert("Thank you for the deposit.\nYour money is safe with us.");
  }
function display_alert_withdraw()
  {
  alert("Thank you for your valued custom.\nWe hope to see you again soon.");
  }
</script>
<div id = "bank"> 
<div class="name">Teller</div>
<div id = "bank_left">



<input type="text" class="inputboxquantity" size="4" id="quantity_adjust" name="quantity_adjust" placeholder="credits" style="vertical-align: middle;" onchange="alterQuantity(this.form)"/>
<input type="button" class="quantity_box_button quantity_box_button_up" onclick="var qty_el = document.getElementById('quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;;alterQuantity(this.form);return false;" value="+" />
<input type="button" class="quantity_box_button quantity_box_button_down" onclick="var qty_el = document.getElementById('quantity_adjust'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) qty_el.value--;alterQuantity(this.form);return false;" value="-" />
<a onclick="display_alert_deposit()" href = '#' id = 'deposit' class = 'deposit'>Deposit</a>
<br />  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="controller" value="buildings" />
  <input type="hidden" name="task" value="withdraw" />
</div>

<div id = "bank_right">

<input type="text" class="inputboxquantity" size="4" id="quantity_adjust2" name="quantity_adjust2" placeholder="credits" style="vertical-align: middle;"/>
<input type="button" class="quantity_box_button quantity_box_button_up" onclick="var qty_el = document.getElementById('quantity_adjust2'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;" value="+" />
<input type="button" class="quantity_box_button quantity_box_button_down" onclick="var qty_el = document.getElementById('quantity_adjust2'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) qty_el.value--;return false;" value="-" />
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="controller" value="buildings" />
  <input type="hidden" name="task" value="withdraw" />

<a onclick="display_alert_withdraw()" href = '#' id = 'withdraw' class = 'withdraw'>Withdraw</a>
 </div>
 </div>
<?php 
/** This template is used for the quantity box of a product, which has a radio-style add to cart form */ 
?>

<script type='text/javascript'>

function deposit() {

	$$('#deposit').addEvent('click', function(){

		var qty_el = document.getElementById('quantity_adjust'); 
		var qty = qty_el.value; 
		var a = new Request.JSON({
			    url: "index.php?option=com_battle&format=raw&task=action&action=deposit&building_id=<?php echo $this->buildings->id ?>&amount=" + qty  ,
			    onSuccess: function(result){
			      
			   // $(result[0]).innerHTML = result[1];	
			   // $(result[2]).innerHTML = result[3];	
			  //  $(deposit).setStyle('visibility','hidden');
		  	    
			    	}
			    }).get();
		    
		
		});	
    }
function withdraw() {

    	$$('#withdraw').addEvent('click', function(){

    		var qty_el = document.getElementById('quantity_adjust2'); 
    		var qty = qty_el.value; 
    		var a = new Request.JSON({
    			    url: "index.php?option=com_battle&format=raw&task=action&action=withdraw&building_id=<?php echo $this->buildings->id ?>&amount=" + qty  ,
    			    onSuccess: function(result){
    			      
    			   // $(result[0]).innerHTML = result[1];	
    			   // $(result[2]).innerHTML = result[3];	
    			  //  $(deposit).setStyle('visibility','hidden');
    		  	    
    			    	}
    			    }).get();
    		    
    		
    		});	
        }	
    
deposit();
withdraw();


 </script>