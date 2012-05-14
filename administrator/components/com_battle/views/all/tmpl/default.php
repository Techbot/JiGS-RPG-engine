<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JToolBarHelper::title( JText::_( 'All' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_battle');
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you sure you want to delete reviews?');
JToolBarHelper::addNew();
?>
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
      <th class="title">Name</th>
      <th width="15%">Health</th>
      <th width="10%">Money</th>
      <th width="10%">Humour</th>
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
	$link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&task=edit&cid[]='. $row->id );
?>
    <tr class="<?php echo "row$k"; ?>">
      <td>
	<?php echo $checked; ?>
      </td>
      <td>
	<a href="<?php echo $link; ?>"><?php echo $row->nom; ?></a>
      </td>
      <td>
	<?php echo $row->vie; ?>
      </td>
      <td>
	<?php echo $row->argent; ?>
      </td>
      <td>
	<?php echo $row->humeur; ?>
      </td>
    </tr>
<?php
	$k = 1 - $k;
}
?>
</table>
<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
