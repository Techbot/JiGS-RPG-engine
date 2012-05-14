<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->row->id)
{
	JToolBarHelper::title( JText::_( 'Edit Drug Profile' ), 'addedit.png' );
}
else
{
	JToolBarHelper::title( JText::_( 'Add Drug Profile' ), 'addedit.png' );
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
       id:
      </td>
      <td>
        <input class="text_area" type="text" name="name" id="name" size="50" maxlength="250" value="<?php echo $this->row->id;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        iduser:
      </td>
      <td>
        <input class="text_area" type="text" name="iduser" id="iduser" size="50" maxlength="250" value="<?php echo $this->row->iduser;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        quantite1:
      </td>
      <td>
         <input class="text_area" type="text" name="quantite1" id="quantite1" size="50" maxlength="250" value="<?php echo $this->row->quantite1;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        prix1:
      </td>
      <td>
          <input class="text_area" type="text" name="prix1" id="prix1" size="250" maxlength="250" value="<?php echo $this->row->prix1;?>" />
      </td>
    </tr>
       <tr>
      <td width="100" align="right" class="key">
        quantite2:
      </td>
      <td>
         <input class="text_area" type="text" name="quantite2" id="quantite2" size="50" maxlength="250" value="<?php echo $this->row->quantite2;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        prix2:
      </td>
      <td>
          <input class="text_area" type="text" name="prix2" id="prix2" size="250" maxlength="250" value="<?php echo $this->row->prix2;?>" />
      </td>
    </tr><tr>
      <td width="100" align="right" class="key">
        quantite3:
      </td>
      <td>
         <input class="text_area" type="text" name="quantite3" id="quantite3" size="50" maxlength="250" value="<?php echo $this->row->quantite3;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        prix3:
      </td>
      <td>
          <input class="text_area" type="text" name="prix3" id="prix3" size="250" maxlength="250" value="<?php echo $this->row->prix3;?>" />
      </td>
    </tr><tr>
      <td width="100" align="right" class="key">
        quantite4:
      </td>
      <td>
         <input class="text_area" type="text" name="quantite4" id="quantite4" size="50" maxlength="250" value="<?php echo $this->row->quantite4;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        prix4:
      </td>
      <td>
          <input class="text_area" type="text" name="prix4" id="prix4" size="250" maxlength="250" value="<?php echo $this->row->prix4;?>" />
      </td>
    </tr><tr>
      <td width="100" align="right" class="key">
        quantite5:
      </td>
      <td>
         <input class="text_area" type="text" name="quantite5" id="quantite5" size="50" maxlength="250" value="<?php echo $this->row->quantite5;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        prix5:
      </td>
      <td>
          <input class="text_area" type="text" name="prix5" id="prix5" size="250" maxlength="250" value="<?php echo $this->row->prix5;?>" />
      </td>
    </tr><tr>
      <td width="100" align="right" class="key">
        quantite6:
      </td>
      <td>
         <input class="text_area" type="text" name="quantite6" id="quantite6" size="50" maxlength="250" value="<?php echo $this->row->quantite6;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        prix6:
      </td>
      <td>
          <input class="text_area" type="text" name="prix6" id="prix6" size="250" maxlength="250" value="<?php echo $this->row->prix6;?>" />
      </td>
    </tr><tr>
      <td width="100" align="right" class="key">
        quantite7:
      </td>
      <td>
         <input class="text_area" type="text" name="quantite7" id="quantite7" size="50" maxlength="250" value="<?php echo $this->row->quantite7;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        prix7:
      </td>
      <td>
          <input class="text_area" type="text" name="prix7" id="prix7" size="250" maxlength="250" value="<?php echo $this->row->prix7;?>" />
      </td>
    </tr>
  <tr>
      <td width="100" align="right" class="key">
       Timer:
      </td>
      <td>
          <input class="text_area" type="text" name="timer" id="timer" size="250" maxlength="250" value="<?php echo $this->row->timer;?>" />
      </td>
    </tr>
    </table>
  </fieldset>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="controller" value="drugs" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
