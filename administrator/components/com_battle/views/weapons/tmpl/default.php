<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JToolBarHelper::title( JText::_( 'Weapons' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_restaurants');
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you sure you want to delete reviews?');
JToolBarHelper::addNew();
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
      <th class="title">Weapons</th>
       <th class="20%">Image</th>
	   <th class="20%">Name</th>
      <th width="15%">Munitions</th>
      <th width="10%">attack</th>
      <th width="10%">defence</th>
      <th width="10%">Precision</th>
      <th width="10%">Detente</th>
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
	$link = JFilterOutput::ampReplace( 'index.php?option=com_battle&task=edit&controller=weapons&cid[]='. $row->id );
?>
    <tr class="<?php echo "row$k"; ?>">
      <td>
	<?php echo $checked; ?>
      </td>
      <td>
	<a href="<?php echo $link; ?>"><?php echo $row->id; ?></a>
      </td>
       <td>
       <a href="<?php echo $link; ?>"> <img src="<?php echo JURI::root(); ?>/components/com_battle/images/weapons/<?php echo $row->image ?>" height = '50px' width='50px' ></a> 
	</td>
	      <td>
	<?php echo $row->name; ?>
      </td>
      <td>
	<?php echo $row->ammunition; ?>
      </td>
      <td>
	<?php echo $row->attack; ?>
      </td>
      <td>
	<?php echo $row->defence; ?>
      </td>
     <td>
	<?php echo $row->precision; ?>
      </td>
      <td>
	<?php echo $row->detente; ?>
      </td>
    </tr>
<?php
	$k = 1 - $k;
}
?>
</table>
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="controller" value="weapons" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
