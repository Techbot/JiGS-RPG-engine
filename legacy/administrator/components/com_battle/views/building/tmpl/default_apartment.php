<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
/*
echo'xxx<pre>';
print_r($this->flats);
echo'</pre>';
*/
?> 
<form action="index.php" method="get" name="flat" id="flat">
<table class="admintable">
<?php for($i=0;$i<=7;$i++){ ?>
  <tr>
  <td>
 Flat Number: <input class="text" type="text" name="flat_<?php echo $i;?>" id="flat_<?php echo $i;?>" size="10" maxlength="10" value="<?php echo $i;?>" />
  </td> 
  <td>
 Building Number: <input class="text" type="text" name="building_<?php echo $i;?>" id="building_<?php echo $i;?>" size="10" maxlength="10" value="<?php echo $this->row->id ;?>" />
  </td> 
  <td width="100" align="right" class="key">Resident:</td>
  <td>
    <input class="text" type="text" name="resident_<?php echo $i;?>" id="resident_<?php echo $i;?>" size="10" maxlength="10" value="<?php echo intval($this->flats[$i]->resident);?>" />
  </td>
  <td>
Status: <input class="text" type="text" name="status_<?php echo $i;?>" id="status_<?php echo $i;?>" size="10" maxlength="10" value="<?php echo intval($this->flats[$i]->status); ?>" />
  </td>
  <td>
timestamp: <input class="text" type="text" name="timestamp_<?php echo $i;?>" id="timestamp_<?php echo $i;?>" size="10" maxlength="10" value="<?php echo intval($this->flats[$i]->timestamp);?>" />
  </td> 
<?php   	
}
?> 
  <td>
    <input type="submit" value="update" />	
  </td>	
</tr>
</table>
<input type="hidden" name="building" value="<?php echo $this->row->id; ?>" />
<input type="hidden" name="unused" value="0" />
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="controller" value="buildings" />
<input type="hidden" name="task" value="save_flats" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>
