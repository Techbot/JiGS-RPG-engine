<?php
/**
* Blog Tab Class for handling the CB tab api
* @version $Id: cb.mamblogtab.php 1812 2012-06-20 07:50:34Z beat $
* @package Community Builder
* @subpackage cb.mamblog.php
* @author JoomlaJoe - Thanks to Jeffrey Hill for pagination and search additions
* @copyright (C) JoomlaJoe and Beat, www.joomlapolis.com
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
*/

// ensure this file is being included by a parent file
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

jimport('joomla.application.component.model');

class getBlogTab2 extends cbTabHandler {
	
	function getBlogTab2() {
		$this->cbTabHandler();
	}

	function getDisplayTab($tab,$user,$ui) {

		JLoader::import('awards', JPATH_ROOT . '/components/com_battle/models');

		$model  = JModel::getInstance('awards', 'BattleModel');
		$result = $model->getUserAwards();
	
		$return  =  '<div style="width:250px;float:left;">';
		$return .=  '<table class="shade-table">';
		
		foreach ($result as $row){
			$return .=  "<tr><td>$row->id</td><td>$row->award_name</td></tr>";
		}
		
		$return .= '</table></div>';
		return $return;
	}
}
?>
