<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JToolBarHelper::title( JText::_( 'Maps' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_battle');
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you sure you want to delete reviews?');
JToolBarHelper::addNew();
// print_r($this->rows);
?>
<form action="index.php" method="post" name="adminForm">
<table class="adminlist">
  <thead>
    <tr>
      <th width="20">
	<input type="checkbox" name="toggle" 
	value="" onclick="checkAll(<?php echo 
	count( $this->rows ); ?>);" />
      </th>
      <th class="title">id </th>
      <th width="5%">Grid</th>
      <th width="10%">Grid Index</th>
    </tr>
  </thead>
<?php
	jimport('joomla.filter.output');
$k = 0;
for ($i=0, $n=count( $this->rows ); $i < $n; $i++) 
{
	$row = &$this->rows[$i];
	$checked = JHTML::_('grid.id', $i, $row->id );
	$published = JHTML::_('grid.published', $row, $i );
	$link = JFilterOutput::ampReplace( 'index.php?option=com_battle&task=edit&controller=maps&cid[]='. $row->id );
?>
    <tr class="<?php echo "row$k"; ?>">
      <td>
	<?php echo $checked; ?>
      </td>
      <td>
	<a href="<?php echo $link; ?>"><?php echo $row->id; ?></a>
      </td>
      <td>
	<?php echo $row->grid; ?>
      </td>
      <td>
	<?php echo $row->grid_index; ?>
      </td>
      </td>
    </tr>
<?php
	$k = 1 - $k;
}
?>
</table>
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="controller" value="maps" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
