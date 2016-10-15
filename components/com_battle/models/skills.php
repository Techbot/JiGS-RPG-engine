<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelskills extends JModelLegacy
{
    function get_skills($user)
    {
        $db		= JFactory::getDBO();
        $parent = JRequest::getvar('parent');
        $query	= "SELECT * FROM #__jigs_skills
          LEFT JOIN #__jigs_skill_types
          ON #__jigs_skills.skill_id = #__jigs_skill_types.id
          WHERE #__jigs_skills.player_id = 63
          AND #__jigs_skill_types.parent_id = 1";
        $db->setQuery($query);
        $data	=  $db->loadAssocList();
        return $data;
    }

    function get_all_skills()
    {
        $db         = JFactory::getDBO();
        $parent     = JRequest::getvar('parent');
        $query      = "SELECT *
            FROM #__jigs_skill_types
            WHERE #__jigs_skill_types.parent_id = '$parent'";
        $db->setQuery($query);
        return  $db->loadAssocList();
    }

    function get_available_skills(){
        $user               = JFactory::getUser();
        $player_skills      = $this->get_skills($user);
        $available_skills   = $this->get_all_skills();

        foreach ($player_skills as $player_skill) {
            $player_skills_array[]  = $player_skill['skill_id'];
        }
        foreach ($available_skills as $skill)
        {
            if (!in_array($skill['id'], $player_skills_array)) {
                $to_buy_list[]      = $skill;
            }
        }
        $result['player_skill_list']    = $player_skills;
        $result['available_skill_list'] = $to_buy_list;
        return $result;
    }
}
