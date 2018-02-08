<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->row->id)
{
    JToolBarHelper::title( JText::_( 'Edit Terminal Profile' ), 'addedit.png' );
}
else
{
    JToolBarHelper::title( JText::_( 'Add Terminal Profile' ), 'addedit.png' );
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
                <td width="100" align="right" class="key">id:</td>
                <td><?php echo $this->row->id;?></td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">posx:</td>
                <td><input class="text_area" type="text" name="posx" id="posx" size="50" maxlength="250" value="<?php echo $this->row->posx;?>" /></td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">posy:</td>
                <td>
                    <input class="text_area" type="text" name="posy" id="posy" size="50" maxlength="250" value="<?php echo $this->row->posy;?>" />
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">type:</td>
                <td><input class="text_area" type="text" name="type" id="type" size="50" maxlength="250" value="<?php echo $this->row->type;?>" />
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">details:</td>
                <td><input class="text_area" type="text" name="details" id="details" size="50" maxlength="250" value="<?php echo $this->row->details;?>" />
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">image:
                </td>
                <td>
                    <input class="text_area" type="text" name="image" id="image" size="50" maxlength="250" value="<?php echo $this->row->image;?>" />
                </td>
            </tr>
            <tr><td width="100" align="right" class="key">grid:
                </td>
                <td>
                    <input class="text_area" type="text" name="grid" id="grid" size="50" maxlength="250" value="<?php echo $this->row->grid;?>" />
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">map:</td>
                <td>
                    <input class="text_area" type="text" name="map" id="map" size="50" maxlength="250" value="<?php echo $this->row->map;?>" /></td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">owner:</td>
                <td>
                    <input class="text_area" type="text" name="owner" id="owner" size="50" maxlength="250" value="<?php echo $this->row->owner;?>" />
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">owner team:</td>
                <td>
                    <input class="text_area" type="text" name="owner_team" id="owner_team" size="50" maxlength="250" value="<?php echo $this->row->owner_team;?>" />
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">price:</td>
                <td>
                    <input class="text_area" type="text" name="price" id="price" size="50" maxlength="250" value="<?php echo $this->row->price;?>" />
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">timer:</td>
                <td>
                    <input class="text_area" type="text" name="timer" id="timer" size="50" maxlength="250" value="<?php echo $this->row->timer;?>" />
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">access</td>
                <td>
                    <input class="text_area" type="text" name="map3333" id="grid" size="50" maxlength="250" value="" /></td>
            </tr>
        </table>
    </fieldset>
    <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
    <input type="hidden" name="option" value="com_battle" />
    <input type="hidden" name="controller" value="terminals" />
    <input type="hidden" name="task" value="" />
    <?php echo JHTML::_( 'form.token' ); ?>
</form>
