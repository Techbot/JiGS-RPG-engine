<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

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
  
 <div style = "width:100%;
    border:red dotted 1px;
    " >

     <div style = "width:33%;float:left;">

         <button type="button" class="btn btn-info btn-xs">Protection  +</button>
         <button type="button" class="btn btn-danger btn-xs">Protection -</button>
         <button type="button" class="btn btn-warning btn-xs">Invest in Bank</button>
         <button type="button" class="btn btn-success btn-xs">Apply For Loan</button>

     </div>
     <div style = "width:33%;float:left;">

            <p>Bank XP:4567</p>
            <p>Bank Level:12</p>
             <p>Bank Strength:456</p>

     </div>
     <div style = "width:33%;float:left;">
            <p class="bg-primary "> Generic Hacking Skill Level : 1 </p>
            <p class="bg-success text-success"> Bank Hacking Skill Level : 1 </p>
            <p class="bg-info text-warning"> Security Tracking Skill Level : 1 </p>
     </div>
 </div>
 
</div>

<?php 
/** This template is used for the quantity box of a product, which has a radio-style add to cart form */ 
?>

