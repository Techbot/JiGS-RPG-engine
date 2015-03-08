<?php
defined('_JEXEC') or die;
jimport('joomla.plugin.plugin');

class plgUserBattle_add_player extends JPlugin
{

/*
        public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
        //JFormHelper::addFieldPath(dirname(__FILE__) . '/fields');
    }
*/		

    public function onUserAfterSave($user, $isnew, $success, $msg )
    {
        $user_id            = $user['id'];
        $user_username      = $user['username'];
        $db                 = JFactory::getDBO();
        $query              = "INSERT INTO #__jigs_players (id,name) VALUES ($user_id,'$user_username')";
        $db->setQuery($query);
        $db->query();

        $groups = $this->get_groups($user_id);

        if (count($groups)==1)
        {
          $group_id = $this->chooseFaction();
            $query	= "INSERT INTO  #__user_usergroup_map (user_id,group_id )VALUES ($user,$group_id)";
            $db->setQuery($query);
            $db->query();
        }

        $groups = $this->get_groups($user_id);

        if (count($groups)==2)
        {
            $f_groups=array();
            if (in_array(35, $groups))// cyberian
            {
                $f_groups       = $this->select_groups(35);
            }
            elseif (in_array(36, $groups))// Gaia
            {
                $f_groups       = $this->select_groups(36);
            }
            elseif (in_array(42, $groups))// Fanatasia
            {
                $f_groups       = $this->select_groups(42);
            }
            $count          = count($f_groups)-1;
            $index          = rand(0,$count);
            echo "rand:" . $index;
            $group_id       = $f_groups[$index];
            $query          = "INSERT INTO  #__user_usergroup_map (user_id,group_id )VALUES ($user,$group_id)";
            //echo $query;

            $db->setQuery($query);
            $db->query();
        }

        return true;
    }

    function get_groups($user)
    {
        $db         = JFactory::getDBO();
        $query      = "SELECT group_id FROM #__user_usergroup_map WHERE user_id = $user";
        $db->setQuery($query);
        $groups     = $db->loadResultArray();

        return $groups;
    }

    function select_groups($faction_id)
    {
        $db             = JFactory::getDBO();
        $query          = "SELECT id FROM #__usergroups WHERE parent_id = $faction_id";
        $db->setQuery($query);
        $f_g            =  $db->loadResultArray();
        //print_r($f_g);
        return $f_g;
    }

    private function chooseFaction()
    {
        $dice = rand(1, 3);
        if ($dice == 1) {
            $group_id = 35;//cyberian
        } elseif ($dice == 2) {
            $group_id = 36;//Gaian
        } else {
            $group_id = 45;//Fantasia
        }
        return $group_id;
    }


    function onUserAfterDelete($user, $success, $msg)
        {
            if (!$success) {
                    return false;
            }
            $userId = JArrayHelper::getValue($user, 'id', 0, 'int');
            if ($userId)
            {
                try
                {
                    $db = JFactory::getDbo();
                    $db->setQuery(
                            'DELETE FROM #__jigs_players WHERE id = '.$userId
                                  );
                    if (!$db->query()) {
                            throw new Exception($db->getErrorMsg());
                    }
                }
                catch (JException $e)
                {
                        $this->_subject->setError($e->getMessage());
                        return false;
                }
            }
            return true;
        }
}
