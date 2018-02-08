<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

foreach ($this->comments as $comment) {
	?>
	<p>&nbsp;</p>
	<p><strong><?php echo htmlspecialchars($comment->full_name); ?></strong>
	<em><?php echo JHTML::Date($comment->comment_date); ?></em></p>
	<p><?php echo htmlspecialchars($comment->comment_text); ?></p>
	<?php
} 
