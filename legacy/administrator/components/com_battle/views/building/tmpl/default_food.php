<?php
defined( '_JEXEC' ) or die( 'Restricted access' );


?>
<form action="index.php" method="get" name="mine" id="mine">
<table class="admintable">
<?php 

$i =0;

foreach($this->mines as $mine){ 



?>
  <tr>
  <td>
 statusmine <?php echo $i;?>: 
 
 <input class="text" type="text" name="status_mines_<?php echo $i;?>" id="status_mines_<?php echo $i;?>" size="10" maxlength="10" value="<?php echo $mine->status;?>" />
  </td> 
   <td>
 timestamp <?php echo $mine->timestamp; ?> 
  </td> 
<?php 


$i++;
  	
}
?> 
  <td>
  <br />
    <input type="submit" value="update" />	
  </td>	
</tr>
</table>
<input type="hidden" name="building" value="<?php echo $this->row->id; ?>" />
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="controller" value="buildings" />
<input type="hidden" name="task" value="save_mines" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>
