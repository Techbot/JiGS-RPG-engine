<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->row->id)
{
	JToolBarHelper::title( JText::_( 'Edit Building Profile' ), 'addedit.png' );
}
else
{
	JToolBarHelper::title( JText::_( 'Add Building Profile' ), 'addedit.png' );
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
<form action="index.php" method="get" name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend>Details</legend>
    <table class="admintable">    
   
      <td width="100" align="right" class="key">
	Name:
      </td>
      <td>
	<input class="text_area" type="text" name="name" id="name" size="50" maxlength="250" value="<?php echo $this->row->name;?>" />
      </td>
    </tr>
     <tr>
      <td width="100" align="right" class="key">
	X:
      </td>
      <td>
	<input class="text_area" type="text" name="posx" id="posy" size="10" maxlength="10" value="<?php echo $this->row->posx;?>" />
      </td>
	    <td width="100" align="right" class="key">
	Y:
      </td>
      <td>
	<input class="text_area" type="text" name="posy" id="posy" size="10" maxlength="10" value="<?php echo $this->row->posy;?>" />
      </td>
    </tr>
	 <tr>
      <td width="100" align="right" class="key">
	Map:
      </td>
      <td>
	<input class="text_area" type="text" name="map" id="map" size="10" maxlength="10" value="<?php echo $this->row->map;?>" />
      </td>
	    <td width="100" align="right" class="key">
	Grid:
      </td>
      <td>
	<input class="text_area" type="text" name="grid" id="grid" size="10" maxlength="10" value="<?php echo $this->row->grid;?>" />
      </td>
    </tr>
	  <tr>
      <td width="100" align="right" class="key">
	Public:
      </td>
      <td>
	<input class="text" type="text" name="public" id="public" size="10" maxlength="10" value="<?php echo $this->row->public;?>" />
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
	Coffre:
      </td>
      <td>
	<?php echo $this->row->coffre; ?>
      </td>
    </tr>
  <tr>
      <td width="100" align="right" class="key">
	type:
      </td>
      
      
      <td>
      

	<?php echo $this->dropdown; ?>
      
      </td>
    </tr>
    
    
    
    
    
    <tr>
      <td width="100" align="right" class="key">
	image:
      </td>
      <td> <input class="text_area" type="text" name="image" id="image" size="50" maxlength="250" value="<?php echo $this->row->image; ?>" />
      </td>
    </tr> 
  <tr>
      <td width="100" align="right" class="key">
	coleur:
      </td>
      <td>
	<?php echo $this->row->coleur; ?>
      </td>
    </tr>  <tr>
      <td width="100" align="right" class="key">
	xp:
      </td>
      <td>
     <input class="text_area" type="text" name="xp" id="xp" size="50" maxlength="250" value="<?php echo $this->row->xp;?>" />
      </td>
    </tr>  <tr>
      <td width="100" align="right" class="key">
	owner:
      </td>
      <td>
     <input class="text_area" type="text" name="owner" id="owner" size="50" maxlength="250" value="<?php echo $this->row->owner;?>" />
      </td>
    </tr>  <tr>
      <td width="100" align="right" class="key">
       owner faction:
      </td>
      <td>
	<?php echo $this->row->proprio_equipe; ?>
      </td>
    </tr>
	<tr>
      <td width="100" align="right" class="key">
       price:
      </td>
      <td>
      <input class="text_area" type="text" name="price" id="price" size="50" maxlength="250" value=" <?php echo $this->row->price; ?>" />  
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

	<textarea class="text_area" cols="20" rows="4" name="comment" id="comment" style="width:500px"><?php echo $this->row->comment; ?></textarea>
      </td>
     
    </tr>
    
    
      <tr>
      <td width="100" align="right" class="key">
	Messages:
      </td>
      <td>

	<textarea class="text_area" cols="20" rows="4" name="messages" id="messages" style="width:500px"><?php echo $this->row->messages; ?></textarea>
      </td>
     
    </tr>

    </table>
  </fieldset>
  <input type="hidden" name="cid" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="com_battle" />
  <input type="hidden" name="controller" value="buildings" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php
if (!$this->row->id) { echo "can add specifics after save"; }
else
{
	jimport( 'joomla.application.component.view' ) ;
	echo $this->loadTemplate ( $this->row->type ) ; 
}
?>
