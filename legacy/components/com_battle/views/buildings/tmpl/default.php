<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<div class="componentheading">Buildings</div>
<ul>
	<?php
	
	foreach ($this->rows as $row)
	{
		$link = JRoute::_('index.php?option=com_battle&id=' . $row->id . '&view=building');
		echo '<li><a href="' . $link . '">' . $row->name . '</a></li>';
	}
	
	?>
<ul>