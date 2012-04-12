<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

JToolBarHelper::title( JText::_( 'Cars' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_battle');
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
       <th class="title">Image</th>
      <th class="title">Name</th>
      <th width="15%">Reservoir</th>
      <th width="10%">xp</th>
      <th width="10%">consommation</th>
    
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
	$link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&task=edit&controller=cars&cid[]='. $row->id );
    ?>
    <tr class="<?php echo "row$k"; ?>">
      <td>
        <?php echo $checked; ?>
      </td>
        <td>
       <a href="<?php echo $link; ?>"> <img src="<?php echo JURI::root(); ?>/components/com_battle/images/cars/<?php echo $row->image ?>" height = '50px' width='50px' ></a>  
          </td>  
      
      <td>
        <a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
      </td>
      <td>
        <?php echo $row->reservoir; ?>
      </td>
      <td>
        <?php echo $row->xp; ?>
      </td>
      <td>
        <?php echo $row->consommation; ?>
      </td>
 
    </tr>
    <?php
    $k = 1 - $k;
  }
  ?>
</table>
<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="controller" value="cars" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>