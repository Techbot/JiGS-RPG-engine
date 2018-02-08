<?php
/**
 * Generic PHP entry point for AJAX calls.
 * Outputs JSON encoded version of output array.
 * Required input in $_POST / $_GET:
 *      @param module string The requested ajax class.
 * All other request args are passed into the class as arguments.
 */
use \sdcAdventure\core;




require_once("pasetup.php");



$ajaxOutput = core\paMain::call(array_merge($_POST,$_GET));




print json_encode($ajaxOutput);
exit;
