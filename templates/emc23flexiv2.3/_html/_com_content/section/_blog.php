<?php
defined('_JEXEC') or die('Restricted access');

// An array of the Section ID's that you want to show in TOC format
$showAsToc = array(1);

if (in_array($this->section->id, $showAsToc)) :
	// Load the new sub-template
	echo $this->loadTemplate('toc');
else :
	// Load a copy of the normal Joomla layout
	echo $this->loadTemplate('default');
endif;

?>