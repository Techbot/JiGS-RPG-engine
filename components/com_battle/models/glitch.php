<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelGlitch extends JModelLegacy
{

	
	function get_images()
	{
		$directory = '/var/www/meme/components/com_battle/images/assets/temporary';
		$scanned_directory = array_diff(scandir($directory), array('..', '.'));
        return $scanned_directory;
	}


    function hi(){


        return 'hellooooooooooo';

    }



}
