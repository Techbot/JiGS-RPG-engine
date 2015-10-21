<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

//print_r ($this->fields);



?>




<form action="index.php" method="get" name="field" id="field">
<table class="admintable">
<?php for($i=0;$i<=7;$i++){ ?>
  <tr>
  <td>
  
 status_field <?php echo $i;?>: 
 <input 
 
 class="text" type="text" 
 name="status_field_<?php echo $i;?>" 
 id="status_field_<?php echo $i;?>" size="10" maxlength="10" 
 value="<?php echo $this->fields[$i]->status;?>"
 
 
  />
  </td> 
   <td>
 timestamp <?php echo $this->fields[$i]->timestamp; ?> 
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
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="controller" value="buildings" />
<input type="hidden" name="task" value="save_fields" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>
