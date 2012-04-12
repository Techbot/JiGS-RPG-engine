<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access
defined('_JEXEC') or die('Restricted access');



?> <ul><?php
foreach ($list as $unit) {
	?>
	<li>
		<?php require(JModuleHelper::getLayoutPath('mod_items','_item')); ?>

	</li>
	<?php
}

?></ul>