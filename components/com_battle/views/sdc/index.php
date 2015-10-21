<?php
/**
 * Initial page for sdcAdventure player.
 * Loads the UI components.
 * Subsequent actions/page updates will be done via javascript and ajax.
 */
use sdcAdventure\core;
require_once('pasetup.php');
$gameUI = new core\gameUI();

include __DIR__.'/gameTemplate.php';
die;
