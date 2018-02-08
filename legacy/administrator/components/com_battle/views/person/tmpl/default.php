<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->row->id)
{
	JToolBarHelper::title( JText::_( 'Edit Character Profile' ), 'addedit.png' );
}
else
{
	JToolBarHelper::title( JText::_( 'Add Character Profile' ), 'addedit.png' );
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
                level :
            </td>
            <td>
                <input class="text_area" type="text" name="level" id="level" size="50" maxlength="250" value="<?php echo $this->row->level  ;?>" />
            </td>
        </tr>



    <tr>
      <td width="100" align="right" class="key">
        Health:
      </td>
      <td>
        <input class="text_area" type="text" name="health" id="health" size="50" maxlength="250" value="<?php echo $this->row->health;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        Money:
      </td>
      <td>
         <input class="text_area" type="text" name="money" id="money" size="50" maxlength="250" value="<?php echo $this->row->money;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        Comment:
      </td>
      <td>
          <textarea class="text_area" type="text" name="comment" id="comment" cols="100" rows ="10"  ><?php echo $this->row->comment;?></textarea>
      </td>
    </tr>



        <tr>
            <td width="100" align="right" class="key">
                Latitude:
            </td>
            <td>
                <input class="text_area" type="text" name="posx" id="posx" size="50" maxlength="250" value="<?php echo $this->row->posx;?>" />
            </td>
        </tr>
        <tr>
            <td width="100" align="right" class="key">
                Longitude:
            </td>
            <td>
                <input class="text_area" type="text" name="posy" id="posy" size="50" maxlength="250" value="<?php echo $this->row->posy;?>" />
            </td>
        </tr>


        <tr>
            <td width="100" align="right" class="key">
                map:
            </td>
            <td>
                <input class="text_area" type="text" name="map" id="map" size="50" maxlength="250" value="<?php echo $this->row->map;?>" />
            </td>
        </tr>
        <tr>
            <td width="100" align="right" class="key">
                grid:
            </td>
            <td>
                <input class="text_area" type="text" name="grid" id="grid" size="50" maxlength="250" value="<?php echo $this->row->grid;?>" />
            </td>
        </tr>









        <tr>
      <td width="100" align="right" class="key">
        Humour:
      </td>
      <td>
            <input class="text_area" type="text" name="mood" id="mood" size="50" maxlength="250" value="<?php echo $this->row->mood;?>" />
      </td>
    </tr>
    
       </tr>
        <tr>
      <td width="100" align="right" class="key">
        History:
      </td>
      <td>
            <textarea class="text_area" type="text" name="history" id="history" cols="50" rows ="10"  ><?php echo $this->row->history;?></textarea>
      </td>



        <tr>
            <td width="100" align="right" class="key">
                xp :
            </td>
            <td>
                <input class="text_area" type="text" name="xp" id="xp" size="50" maxlength="250" value="<?php echo $this->row->xp  ;?>" />
            </td>
        </tr>




    </tr>


        <tr>
            <td width="100" align="right" class="key">
                Image
            </td>
            <td>
                <input class="text_area" type="text" name="image" id="image" size="50" maxlength="250" value="<?php echo $this->row->avatar ;?>" />
            </td>
        </tr>
    
    
    
    
    </table>
  </fieldset>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="controller" value="people" />
  <input type="hidden" name="option" value="com_battle" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
