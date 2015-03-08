<?php
/**
 * @package	Joomla.Administrator
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die("Restricted Access");

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

JToolBarHelper::title( JText::_( 'Awards' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_battle');
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you sure you want to delete award?');
JToolBarHelper::addNew();

?>

<form action="<?php echo JRoute::_('index.php?option=com_battle&view=awards'); ?>" method="get" name="adminForm" id="adminForm">
<div class="clr"> </div>

<table class="adminlist">
  <thead>
    <tr>
      <th class="title" width="5%">
	<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->rows ); ?>);" />
      </th>
      <th class="title" width="5%">id</th>
      <th class="title" width="10%">name</th>
      <th class="title" width="10%">user</th>
    </tr>
  </thead>
  <tbody>
<?php
$k = 0;
for ($i=0; $i < count($this->rows); $i++) 
{
	$row = &$this->rows[$i];
	$checked = JHTML::_('grid.id', $i, $row->id );
	$published = JHTML::_('grid.published', $row, $i );
	$link = JFilterOutput::ampReplace( 'index.php?option=com_battle&task=edit&controller=awards&cid[]='. $row->id );
?>
    <tr class="<?php echo "row$k"; ?>">
      <td> <?php echo $checked; ?> </td>
      <td> <?php echo $row->id; ?> </td>
      <td> <a href="<?php echo $link; ?>"><?php echo $row->username; ?></a> </td>
      <td> <a href="<?php echo $link; ?>"><?php echo $row->award_name; ?></a> </td>
    </tr>
<?php
	$k = 1 - $k;
}
?>
  </tbody>
</table>
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="controller" value="awards" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
