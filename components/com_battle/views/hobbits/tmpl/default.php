<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<div class="componentheading">Hobbits</div>


<table width="100%" class='shade-table' border='1px'>
	
	
	
	
	<?php
	
		echo '<tr><th>Name</th>';
		
		echo '<th>Health </th>';	
		echo '<th>Strength </th>';	
		echo '<th>Intelligence </th></tr>';	
	
	
	foreach ($this->rows as $row)
	{
		$link = JRoute::_('index.php?option=com_battle&id=' . $row->id . '&view=hobbit');
		
		echo '<tr><td><a href="' . $link . '">' . $row->name . '</a></td>';
		
		echo '<td><a href="' . $link . '">' . $row->health . '</a></td>';	
		echo '<td><a href="' . $link . '">' . $row->strength . '</a></td>';	
		echo '<td><a href="' . $link . '">' . $row->intelligence . '</a></td></tr>';	
	
	}
	
	?>
</table>
