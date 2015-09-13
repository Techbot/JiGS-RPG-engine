<?php

namespace \emc23\models;

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

/**
 * Class BattleModelAwardNames
 */
class BattleModelAwardNames extends JModel
{
    /**
     * @param $idAwardNames
     * @return mixed
     */

    public function getAwardName($idAwardNames)
    {
        $dba = JFactory::getDBO();
        $query = " SELECT name, published
            FROM   #__jigs_award_names
            WHERE  id = $idAwardNames
            ";

        $dba->setQuery($query);
        $result = $dba->loadAssoc();

        return $result;
    }

    public function removeAwardName($idAwardNames)
    {
        $dba = JFactory::getDBO();

        $query = "
            DELETE FROM #__jigs_award_names
            WHERE id = $idAwardNames
            AND NOT EXISTS (
                SELECT *
                FROM #__jigs_awards
                WHERE  name_id = $idAwardNames
            )";

        $dba->setQuery($query);
        $dba->query();
    }
}
