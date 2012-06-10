<?php // @version $Id: default_message.php 11917 2009-05-29 19:37:05Z ian $
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<h3>
	<?php echo $this->escape($this->message->title); ?>
</h3>

<p class="message">
	<?php echo $this->escape($this->message->text); ?>
</p>
