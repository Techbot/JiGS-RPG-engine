<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend>Stand</legend>
    <table class="admintable">
    <tr>
      <td width="100" align="right" class="key">
        Name:
      </td>
      <td>
        <input class="text_area" type="text" name="name" id="name" size="50" maxlength="250" value="<?php echo $this->row->name;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        Protection:
      </td>
      <td>
        <input class="text_area" type="text" name="protection" id="protection" size="50" maxlength="250" value="<?php echo $this->row->protection;?>" />
      </td>
    </tr>
	<tr>
      <td width="100" align="right" class="key">
       price:
      </td>
      <td>
        <?php echo $this->row->price; ?>
      </td>
    </tr>    
<tr>
	<td width="100" align="right" class="key">
      timer:
      </td>
      <td>
        <?php echo $this->row->timer; ?>
      </td>
    </tr>   
	<tr>  <td width="100" align="right" class="key">
       access:
      </td>
      <td>
        <?php echo $this->row->access; ?>
      </td>
    </tr>
  <tr>
      <td width="100" align="right" class="key">
        Notes:
      </td>
      <td>
        <textarea class="text_area" cols="20" rows="4" name="notes" id="notes" style="width:500px"><?php echo $this->row->comment; ?></textarea>
      </td>
    </tr>
    </table>
  </fieldset>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
      <input type="hidden" name="controller" value="buildings" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php
