<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<div class="componentheading">People</div>
<ul>
	<?php
	
	foreach ($this->rows as $row)
	{
		$link = JRoute::_('index.php?option=com_battle&id=' . $row->id . '&view=single');
		echo '<li><a href="' . $link . '">' . $row->nom . '</a></li>';
	}
	
	?>
<ul>