<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->row->id)
{
	JToolBarHelper::title( JText::_( 'Edit Car Profile' ), 'addedit.png' );
}
else
{
	JToolBarHelper::title( JText::_( 'Add Car Profile' ), 'addedit.png' );
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
	Name:
      </td>
      <td>
	<input class="text_area" type="text" name="name" id="name" size="50" maxlength="250" value="<?php echo $this->row->name;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
       Reservoir:
      </td>
      <td>
	<input class="text_area" type="text" name="reservoir" id="reservoir" size="50" maxlength="250" value="<?php echo $this->row->reservoir;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
	Consumation:
      </td>
      <td>
	 <input class="text_area" type="text" name="consommation" id="consommation" size="50" maxlength="250" value="<?php echo $this->row->consommation;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
	Comment:
      </td>
      <td>
	  <textarea class="text_area" name="commentaire" id="commentaire" rows="5" cols="100"><?php echo $this->row->commentaire;?></textarea>
      </td>
    </tr>
	<tr>
      <td width="100" align="right" class="key">
	Rapidite:
      </td>
      <td>
	    <input class="text_area" type="text" name="rapidite" id="rapidite" size="50" maxlength="250" value="<?php echo $this->row->rapidite;?>" />
      </td>
    </tr>
    </table>
  </fieldset>
 <?php echo JHTML::_( 'form.token' ); ?>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />	
  <input type="hidden" name="option" value="com_battle" />
  <input type="hidden" name="controller" value="cars" />
  <input type="hidden" name="task" value="" />
</form>
