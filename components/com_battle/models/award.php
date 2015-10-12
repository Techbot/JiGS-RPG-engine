<?php
/**
 *
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

/**
 * Class BattleModelAward
 */
class BattleModelAward extends JModel
{
    function get_award($id)
    {
        $db	= JFactory::getDBO();
        $query	= "
            SELECT a.id , a.id,
                   n.name as award_name,
                   u.name, u.username
            FROM   #__jigs_awards a,
                   #__jigs_award_names n
                   #__users u
            WHERE  a.name_id = n.id
            AND    a.id  = u.id
            AND    a.id      = $id
            ";

        $db->setQuery($query);
        $result = $db->loadAssoc();

        return $result;
    }

    function insert_award($name_id)
    {
        $db	= JFactory::getDBO();
        $user	= JFactory::getUser();

        $query	= "
            INSERT INTO #__jigs_awards (id, name_id)
            VALUES($user->id, $name_id)
            ";

        $db->setQuery($query);
        $db->query();

        return $db->insertId();
    }

    function delete_award($id)
    {
        $db	= JFactory::getDBO();
        $user	= JFactory::getUser();

        $query	= "
            DELETE FROM #__jigs_awards
            WHERE id = $id
            ";

        $db->setQuery($query);
        $db->query();
    }

    function get_award_name($id)
    {
        $db	= JFactory::getDBO();
        $query	= "
            SELECT name
            FROM   #__jigs_award_names
            WHERE  id = $id
            ";

        $db->setQuery($query);
        $result	= $db->loadAssoc();

        return $result;
    }

    function get_award_id($name)
    {
        $db	= JFactory::getDBO();
        $query	= "
            SELECT id
            FROM   #__jigs_award_names
            WHERE  name = '$name'
            ";

        $db->setQuery($query);
        $result	= $db->loadAssoc();

        return $result;
    }

    function insert_award_name($name)
    {
        $db	= JFactory::getDBO();
        $user	= JFactory::getUser();

        $query	= "
            INSERT INTO #__jigs_award_names (name)
            VALUES ('$name')
            ";
        $db->setQuery($query);
        $db->query();

        return $db->insertId();
    }

    function update_award_name($id, $name)
    {
        $db	= JFactory::getDBO();
        $user	= JFactory::getUser();

        $query	= "
            UPDATE #__jigs_award_names SET
            name     = '$name'
            WHERE id = $id
            ";

        $db->setQuery($query);
        $db->query();
    }

    function delete_award_name($id)
    {
        $db	= JFactory::getDBO();
        $user	= JFactory::getUser();

        $query	= "
            DELETE FROM #__jigs_award_names
            WHERE id = $id
            AND NOT EXISTS (
                SELECT *
                FROM #__jigs_awards
                WHERE  name_id = $id
            )";

        $db->setQuery($query);
        $db->query();
    }
}
