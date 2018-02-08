<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

    function compare_weights($a, $b) {
    if($a->xp == $b->xp) {
        return 0 ;
    } 
  return ($a->xp < $b->xp) ? -1 : 1;
} 

class BattleModelfactions extends JModelLegacy
{
    function get_groups()
    {
        $factions = array( 'cyberians' =>'35', 'gaians' => 36 , 'fantasians' => 42);
        $db = JFactory::getDBO();
        foreach ($factions as $faction_name=>$faction_id)
        {
            $faction_list->$faction_name->name          = $faction_name;
            $faction_list->$faction_name->groups        = $this->get_group_ids($faction_id);
            $faction_list->$faction_name->groupnames    = $this->get_group_names($faction_list->$faction_name->groups);
            $faction_list->$faction_name->groupstats    = $this->get_group_stats($faction_list->$faction_name->groups);
        }
        $faction_list	= $this->get_group_members($faction_list);
        return $faction_list;
    }

    function get_group_ids($faction_id)
    {
            $db         = JFactory::getDBO();
            $query      = "SELECT id FROM #__usergroups WHERE parent_id = " . $faction_id;
            $db->setQuery($query);
            return $db->loadcolumn();
    }

    function get_group_name($group)
    {
        $db         = JFactory::getDBO();
        $query             = "SELECT title FROM #__usergroups WHERE id = " . $group;
        $db->setQuery($query);
        $groupname         =  $db->loadResult();
        return $groupname;
    }

    function get_group_stats()
    {
        $db                     = JFactory::getDBO();
        $query                  = "SELECT * FROM #__jigs_groups Order by total_xp DESC";
        $db->setQuery($query);
        $groupstats              =  $db->loadObjectList();
        foreach ($groupstats as $group)
        {
            $group->name    = $this->get_group_name($group->gid);
            $group->avatar  = $this->get_avatar($group->captain);
        }
    return $groupstats;
    }

    function get_avatar($id)
    {
        $db         = JFactory::getDBO();
        $query      = "SELECT #__comprofiler.avatar FROM #__comprofiler WHERE #__comprofiler.id =" . $id;
        $db->setQuery($query);
        return $db->loadResult();
    }

    function get_group_members()
    {
        $db                             = JFactory::getDBO();
        $gid                            = JRequest::getVar('gid');
        $query                          = "SELECT user_id FROM #__user_usergroup_map WHERE group_id = $gid" ;
        $db->setQuery($query);
        $ids                            = $db->loadcolumn();
        $this->total['faction_members'] = $this->get_character_names($gid);
        $this->get_player_names($ids);
        $sorted                         = $this->sortArrayofObjectByProperty($this->total['faction_members'] ,'xp',$order="DESC")   ;
        return  $sorted ;
    }

    function sortArrayofObjectByProperty($array,$property,$order="ASC")
    {
        $cur = 1;
        $stack[1]['l'] = 0;
        $stack[1]['r'] = count($array)-1;
        do
        {
            $l = $stack[$cur]['l'];
            $r = $stack[$cur]['r'];
            $cur--;
             
            do
            {
                $i = $l;
                $j = $r;
                $tmp = $array[(int)( ($l+$r)/2 )];
                 
                // split the array in to parts
                // first: objects with "smaller" property $property
                // second: objects with "bigger" property $property
                do
                {
                    while( $array[$i]->{$property} < $tmp->{$property} ) $i++;
                    while( $tmp->{$property} < $array[$j]->{$property} ) $j--;
                     
                    // Swap elements of two parts if necesary
                    if( $i <= $j)
                    {
                        $w          = $array[$i];
                        $array[$i]  = $array[$j];
                        $array[$j]  = $w;
                        $i++;
                        $j--;
                    }
                 
                } while ( $i <= $j );
                 
                if( $i < $r ) {
                $cur++;
                $stack[$cur]['l'] = $i;
                $stack[$cur]['r'] = $r;
                }
                $r = $j;
             
            } while ( $l < $r );
         
        } while ( $cur != 0 );
        // Added ordering.
        if($order == "DESC"){ $array = array_reverse($array); }
        return $array;
    }

    function compare_weights($a, $b)
    {
       echo'<pre>';
       print_r( $a);
       echo'</pre>';
       if($a->money == $b->money) {
            return 0 ;
        }
        return ($a->money < $b->money) ? -1 : 1;
    }

    function get_player_names($group_ids)
    {
        $db     = JFactory::getDBO();
        $names  = array();

        foreach ($group_ids as $id)
            {
                $query                              = "SELECT  id, name, xp,  health, bank, type, money, level
                                                            FROM #__jigs_players
                                                            WHERE id = $id ORDER BY xp DESC";
                $db->setQuery($query);
                $x                                  = $db->loadObject();
                $x->id2 = $id;
                $query                              = "SELECT #__comprofiler.avatar FROM #__comprofiler WHERE #__comprofiler.id =" . $id;
                $db->setQuery($query);
                $x->avatar                          = $db->loadResult();
                $this->total['faction_members'][]   =  $x;
            }
        return;
    }

    function get_character_names($gid)
    {
        $db = JFactory::getDBO();
        $query = "SELECT id, name, xp,
                type,
                health,
                bank,
                money,
                gid,
                avatar,
                level 
                FROM #__jigs_characters WHERE gid = " . $gid . " ORDER BY xp DESC";
                $db->setQuery($query);
                $characters = $db->loadObjectList();
        return $characters;
    }
}
