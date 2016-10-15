<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelspells extends JModelLegacy
{
    function get_spells($user)
    {
        $db		= JFactory::getDBO();
        $parent = JRequest::getvar('parent');
        $user   = JFactory::getUser();
        $query	= "SELECT * FROM #__jigs_spells
          LEFT JOIN #__jigs_spell_types
          ON #__jigs_spells.spell_id = #__jigs_spell_types.id
          WHERE #__jigs_spells.player_id = $user->id
          AND #__jigs_spell_types.parent_id = '$parent'";
        $db->setQuery($query);
        $data	=  $db->loadAssocList();
        return $data;
    }

    function get_all_spells()
    {
        $db         = JFactory::getDBO();
        $parent     = JRequest::getvar('parent');
        $query      = "SELECT *
            FROM #__jigs_spell_types
            WHERE #__jigs_spell_types.parent_id = '$parent'";
        $db->setQuery($query);
        return  $db->loadAssocList();
    }

    function get_available_spells(){
        $user               = JFactory::getUser();
        $player_spells      = $this->get_skills($user);
        $available_spells   = $this->get_all_skills();
        foreach ($player_spells as $player_spell) {
            $player_spells_array[]  = $player_spell['spell_id'];
        }
        foreach ($available_skills as $skill)
        {
            if (!in_array($spell['id'], $player_spells_array)) {
                $to_buy_list[]      = $spell;
            }
        }
        $result['player_spell_list']    = $player_spells;
        $result['available_spell_list'] = $to_buy_list;
        return $result;
    }
}


