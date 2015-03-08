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

class getBlogTab extends cbTabHandler {
	
	function getBlogTab() {
		$this->cbTabHandler();
	}

	function getDisplayTab($tab,$user,$ui) {
		$return		= "";
		//global $_CB_database, $_CB_framework, $mainframe;

		$total_crop	= 0;
		$db		= JFactory::getDBO();
		$query		= "SELECT * FROM #__jigs_buildings WHERE #__jigs_buildings.owner = $user->id ORDER BY type;";
		$db->setQuery($query);
		$result		= $db->loadObjectList(); 
		
		$return = "<table class ='shade-table'>";
		
		
		foreach ($result as $row){
		//	$return .=  "<tr><td>" . $row->id . " " . $row->type . "</td></tr>";
		}
		$return .= "</table>";
		return $return; 
    	} 
}	// end class getBlogTab
?>
