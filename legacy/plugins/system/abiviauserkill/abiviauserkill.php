<?php
/**
* @package Abivia Non-Activated User Killer
* @copyright Copyright (c)2010 Abivia Inc., J!1.7 port by Bean Lucas bean@lucas.net
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
//defined('_JEXEC') or die('Restricted access');

if (version_compare(phpversion(), '5.2') < 0) {
    return;
}

jimport('joomla.plugin.plugin');

/**
 * Abivia Non-Activated User Killer Plugin
 */
class plgSystemAbiviauserkill extends JPlugin {

	function onAfterInitialise() {
        $debugLevel = (int) $this -> params -> get('debugLevel', '0');
        $app = JFactory::getApplication();
        if ($debugLevel == 1 && !$app -> isAdmin()) {
            return;
        }
        /*
         * See if we're scheduled to run.
         */
        $now = time();
		$runInterval = (int) round((float) $this -> params -> get('runHours', 24) * 3600);
        $config = JFactory::getConfig();
        $runFile = $config -> getValue('config.tmp_path') . DS . 'abiviauserkill.ini';
        $lastRun = (int) @file_get_contents($runFile);
        if (empty($lastRun) || $lastRun > $now) {
            $lastRun = 0;
        }
        if ($lastRun + $runInterval > $now) {
            if ($debugLevel) {
                $app -> enqueueMessage(
                    'UserKill: next run after ' . ($lastRun + $runInterval)
                    . ' current time  ' . $now
                );
            }
            return;
        }
		$db = JFactory::getDBO();
        $where = array();
		$days = (float) $this -> params -> get('activeDays', '7');
        if ($days == 0) {
            $activeTime = false;
        } else {
            $activeTime = JFactory::getDate($now - (int) round($days * 24 * 3600));
            $where[] = '(registerDate < ' . $db -> Quote($activeTime -> toMySql())
                . ' AND block=1)';
        }
		$days = (float) $this -> params -> get('loginDays', '60');
        if ($days == 0) {
            $loginTime = false;
        } else {
            $loginTime = JFactory::getDate($now - (int) round($days * 24 * 3600));
            $where[] = '(registerDate < ' . $db -> Quote($loginTime -> toMySql())
                . ' AND lastvisitDate =' . $db -> Quote($db -> getNullDate())
                . ' AND block=0)';
        }
        if (!$activeTime && !$loginTime) {
            if ($debugLevel) {
                $app -> enqueueMessage(
                    'UserKill: No run scheduled. Adjust params.'
                );
            }
            return;
        }
		$excludes = $this -> params -> get('excludes', '');
        $excludes = explode(',', $excludes);
        foreach ($excludes as $key => &$userName) {
            $user = trim($userName);
            if ($userName == '') {
                unset($excludes[$key]);
                continue;
            }
            $userName = $db -> Quote($userName);
        }
        if (empty($excludes)) {
            $excludes = '';
        } else {
            $excludes = ' AND username NOT IN(' . implode(',', $excludes) . ')';
        }
		$query = 'SELECT id FROM #__users'
            . ' WHERE (' . implode(' OR ', $where) . ')'
            . $excludes;
        $killMax = (int) $this -> params -> get('killMax', '100');
        if ($killMax > 0) {
            $query .= ' LIMIT ' . $killMax;
        }
        if ($debugLevel) {
            $app -> enqueueMessage(
                'UserKill: ' . $query
            );
        }
		$db -> setQuery($query);
		$rows = $db -> loadObjectList();
		 
		/*
         * Delete expired users (but not admins), firing all plugins.
         */
        if ($debugLevel) {
            $app -> enqueueMessage(
                'UserKill: killing ' . count($rows) . ' users.'
            );
        }
        foreach ($rows as $row){
            $user = JUser::getInstance($row -> id);
            if ($user && !($user->authorise('core.login.admin'))) {
                $user -> delete();
            }
        }
        /*
         * Write a log of when we last ran. If our work might be incomplete, fake
         * the interval so we run in a few minutes.
         */
        $runTime = $now;
        if (!empty($rows)) {
            $stepSecs = 60 * (int) $this -> params -> get('stepMins', '5');
            $runTime -= $runInterval + $stepSecs;
        } else {
            $stepSecs = $runInterval;
        }
        if ($debugLevel) {
            $app -> enqueueMessage(
                'UserKill: next run in ' . $stepSecs . 's.'
            );
        }
        file_put_contents($runFile, $runTime);
	}
    
}
