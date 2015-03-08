<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<form action="index.php" method="post" name="AdminForm" id="AdminForm">
  <fieldset class="Factoryform">
    <legend>Factory Lines</legend>
    <table class="admintable">
<?php  for($i=0; $i<= 7;$i++){ ?>
      <tr>
      <td width="100" align="right" class="key">
	Line:
      </td>
      <td>
	<input class="text_area" type="text" name="line_<?php echo $i ?>" id="line_<?php echo $i ?>" size="10" maxlength="250" readonly="readonly" value="<?php echo $i+1 ?>" />
      </td>
     <td width="100" align="right" class="key">
	type:
      </td>
      <td>
	<input class="text_area" type="text" name="type_<?php echo $i ?>" id="type_<?php echo $i ?>" size="10" maxlength="250" value="<?php echo $this->factories[$i]->type;?>" />
      </td> 
      <td width="100" align="right" class="key">
	Timestamp:
      </td>
      <td>
	<input class="text_area" type="text" name="timestamp_<?php echo $i ?>" id="timestamp_<?php echo $i ?>" size="10" maxlength="250" value="<?php echo $this->factories[$i]->timestamp;?>" />
      </td>
      <td width="100" align="right" class="key">
	Quantity:
      </td>
      <td>
	<input class="text_area"type="text" name="quantity_<?php echo $i ?>" id="quantity_<?php echo $i ?>" size="10" value="<?php echo $this->factories[$i]->quantity; ?>" /> 
       </td> 
      </tr>
<?php }?>
    </table>
  </fieldset>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="controller" value="buildings" />
  <input type="hidden" name="option" value="com_battle" />
  <input type="hidden" name="task" value="factories_save" />
  <input type="submit" name="submit" value="submit" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
