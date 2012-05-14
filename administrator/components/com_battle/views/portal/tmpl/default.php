<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->row->id)
{
	JToolBarHelper::title( JText::_( 'Edit Portal' ), 'addedit.png' );
}
else
{
	JToolBarHelper::title( JText::_( 'Add Portal' ), 'addedit.png' );
}
JToolBarHelper::save();
JToolBarHelper::apply();
if ($this->row->id)
{
	JToolBarHelper::cancel( 'cancel', 'Close' );
}
else
{
	JToolBarHelper::cancel();
}
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend>Details</legend>
    <table class="admintable">
    <tr>
      <td width="100" align="right" class="key">
       Id:
      </td>
      <td>
	<?php echo $this->row->id;?>
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
       From X:
      </td>
      <td>
	<input class="text_area" type="text" name="from_x" id="from_x" size="50" maxlength="250" value="<?php echo $this->row->from_x;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
      From Y:
      </td>
      <td>
	 <input class="text_area" type="text" name="from_y" id="from_y" size="50" maxlength="250" value="<?php echo $this->row->from_y;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
	From Grid:
      </td>
      <td>
	  <input class="text_area" type="text" name="from_grid" id="from_grid" size="50" maxlength="250" value="<?php echo $this->row->from_grid;?>" />
      </td>
    </tr>
	<tr>
      <td width="100" align="right" class="key">
	From Map
      </td>
      <td>
	    <input class="text_area" type="text" name="from_map" id="from_map" size="50" maxlength="250" value="<?php echo $this->row->from_map ;?>" />
      </td>
    </tr>
	<tr>
      <td width="100" align="right" class="key">
       To X :
      </td>
      <td>
	    <input class="text_area" type="text" name="to_x" id="to_x" size="50" maxlength="250" value="<?php echo $this->row->to_x ;?>" />
      </td>
    </tr>
		<tr>
      <td width="100" align="right" class="key">
      To Y :
      </td>
      <td>
	    <input class="text_area" type="text" name="to_y" id="to_y" size="50" maxlength="250" value="<?php echo $this->row->to_y ;?>" />
      </td>
    </tr>	
			<tr>
      <td width="100" align="right" class="key">
      To grid :
      </td>
      <td>
	    <input class="text_area" type="text" name="to_grid" id="to_grid" size="50" maxlength="250" value="<?php echo $this->row->to_grid ;?>" />
      </td>
    </tr>		        <tr>
      <td width="100" align="right" class="key">
      To map :
      </td>
      <td>
	    <input class="text_area" type="text" name="to_map" id="to_map" size="50" maxlength="250" value="<?php echo $this->row->to_map;?>" />
      </td>
    </tr>	
    </table>
  </fieldset>
 <?php echo JHTML::_( 'form.token' ); ?>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />	
  <input type="hidden" name="option" value="com_battle" />
  <input type="hidden" name="controller" value="portals" />
  <input type="hidden" name="task" value="" />
</form>
