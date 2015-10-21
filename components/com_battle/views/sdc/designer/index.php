<?php
/**
 * Initial page for sdcAdventure designer.
 * Loads the UI components.
 * Subsequent actions/page updates will be done via javascript and ajax.
 */
use sdcAdventure\core;
require_once('../pasetup.php');
$designerUI = new core\designerUI();

include __DIR__.'/designerTemplate.php';
die;
