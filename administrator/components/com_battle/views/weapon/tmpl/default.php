<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->row->id)
{
	JToolBarHelper::title( JText::_( 'Edit Weapon Profile' ), 'addedit.png' );
}
else
{
	JToolBarHelper::title( JText::_( 'Add Weapon Profile' ), 'addedit.png' );
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
        Weapon:
      </td>
      <td>
        <input class="text_area" type="text" name="name" id="name" size="50" maxlength="250" value="<?php echo $this->row->nom;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        muntions:
      </td>
      <td>
        <input class="text_area" type="text" name="address" id="address" size="50" maxlength="250" value="<?php echo $this->row->munitions;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        attack:
      </td>
      <td>
         <input class="text_area" type="text" name="address" id="address" size="50" maxlength="250" value="<?php echo $this->row->attaque;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        Comment:
      </td>
      <td>
          <input class="text_area" type="text" name="address" id="address" size="250" maxlength="250" value="<?php echo $this->row->commentaire;?>" />
      </td>
    </tr>
        <tr>
      <td width="100" align="right" class="key">
        Defense:
      </td>
      <td>
            <input class="text_area" type="text" name="address" id="address" size="50" maxlength="250" value="<?php echo $this->row->defense;?>" />
      </td>
    </tr>
    </table>
  </fieldset>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="controller" value="weapons" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
