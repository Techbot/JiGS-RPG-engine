<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
/*
echo'xxx<pre>';
 print_r($this->flats);
echo'</pre>';
*/
?>
<form action="index.php" method="get" name="flat" id="flat">
  <fieldset class="adminform">
    <legend>Stand</legend>
    <table class="admintable">
  <?php echo $this->row->id; ?> 
 <?php for($i=1;$i<=8;$i++){ ?>
    <tr>
  	<td><?php echo $i . " : " . $this->flats['status_flat_'. $i] ?></td>
  	<td><?php echo      " : " . $this->flats['resident_'   . $i] ?></td>
   	<td><?php echo      " : " . $this->flats['timestamp_'  . $i] ?></td>
    </tr>
  <?php   	
  }
 ?> 
    </table>
  </fieldset>
  <input type="hidden" name="building" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="unused" value="0" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="controller" value="buildings" />
  <input type="hidden" name="task" value="save_flats" />
  <?php echo JHTML::_( 'form.token' ); ?>
  <input type="submit" value="update" />
 </form>
<?php
