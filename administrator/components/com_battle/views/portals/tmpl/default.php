<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JToolBarHelper::title( JText::_( 'Portals' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_battle');
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you sure you want to delete potals?');
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
      <th class="title">Id</th>
      <th class="title">from_x</th>      
      <th width="15%">from_y</th>
      <th width="10%">from_map</th>
      <th width="10%">from_grid</th>  
      <th width="10%">to_x</th>
      <th width="10%">to_y</th>
      <th width="10%">to_map</th>
      <th width="10%">to_grid</th>  
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
	$link = JFilterOutput::ampReplace( 'index.php?option=com_battle&task=edit&controller=portals&cid[]='. $row->id );
?>
    <tr class="<?php echo "row$k"; ?>">
      <td>
	<?php echo $checked; ?>
      </td>
     <td>
     <a href="<?php echo $link; ?>"> <?php echo $row->id; ?> </a> 
	</td>    
	   <td>
       <?php echo $row->from_x; ?>
       </td>
      <td>
	<?php echo $row->from_y; ?>
      </td>
	   <td>
	<?php echo $row->from_map; ?>
      </td>
       <td>
	<?php echo $row->from_grid; ?>
      </td>
      <td>
	<?php echo $row->to_x; ?>
      </td>
	<td>
	<?php echo $row->to_y; ?>
      </td>    
       <td>
	<?php echo $row->to_map; ?>
      </td>
       <td>
	<?php echo $row->to_grid; ?>
      </td>
    </tr>
<?php
	$k = 1 - $k;
}
?>
</table>
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="controller" value="portals" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
