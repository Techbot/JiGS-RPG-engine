<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->id)
{
	JToolBarHelper::title( JText::_( 'Edit Award Profile' ), 'addedit.png' );
}
else
{
	JToolBarHelper::title( JText::_( 'Add Award Profile' ), 'addedit.png' );
}
JToolBarHelper::save();
JToolBarHelper::apply();
if ($this->id)
{
	JToolBarHelper::cancel( 'cancel', 'Close' );
}
else
{
	JToolBarHelper::cancel();
}
?>
<form action="index.php" method="get" name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend>Details</legend>
    <table class="admintable">    
<?php if($this->id) : ?>
    <tr>
      <td width="100" align="right" class="key"> id: </td>
      <td>
	<?php echo $this->id;?>
      </td>
    </tr>
<?php endif; ?>
    <tr>
      <td width="100" align="right" class="key"> Name: </td>
      <td>
	<input type="text" size="20" maxlength="20" name="name" id="name" value="<?php echo $this->name ?>" />
      </td>
    </tr>
    </table>
  </fieldset>
  <input type="hidden" name="cid" value="<?php echo $this->id; ?>" />
  <input type="hidden" name="option" value="com_battle" />
  <input type="hidden" name="controller" value="awardnames" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
