<?php


defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');
/**
 * This models supports retrieving lists of plate stuff
 *
 * @package		JiGS
 * @subpackage	com_battle
 * @since		1.6
 */
class BattleModelPlate extends JModelLegacy
{
    public $data = null;

    public function getPlate($idPlate)
    {
        if (empty($this->_data)) {
            $query = "SELECT * FROM #__jigs_plate WHERE id = $idPlate ";
            $this->_data = $this->_getList($query);
        }

        return $this->data;
    }

    public function getMagicPlayers()
    {
        $dba            = JFactory::getDBO();
        $user           = JFactory::getUser();
        $query = "SELECT magic FROM #__jigs_magic WHERE iduser = $user->id";
        $dba->setQuery($query);
        $user->magic    = $dba->loadResult();
        $query          = "SELECT name
                            FROM #__jigs_players
                            LEFT JOIN #__jigs_magic
                            on #__jigs_players.id = #__jigs_magic.iduser
                            WHERE #__jigs_magic = $user->magic LIMIT 10";
        $dba->setQuery($query);
        $result         = $dba->loadAssoc();
        return $result;
    }








}
