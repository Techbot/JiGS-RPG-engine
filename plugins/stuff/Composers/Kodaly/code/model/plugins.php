<?php
/**
 * @package     Kodaly.Application
 * @subpackage  Model
 *
 * @copyright   Copyright (C) {COPYRIGHT}. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Default model for the Kodaly Application.
 *
 * @package     Kodaly.Application
 * @subpackage  Model
 * @since       1.0
 */
class KodalyModelPlugins extends JModelDatabase
{
	/**
	 * A dummy method to make this look like a dispatcher.
	 *
	 * @return	void
	 */
	public function attach()
	{
		// Do nothing.
	}

	/**
	 * Loads the plugins from the CMS location.
	 *

	 */
	public function load($cmsPath, $group = 'cron')
	{
		// Initialiase variables.
		jimport('joomla.filesystem.path');
		jimport('joomla.html.parameter');
		jimport('joomla.plugin.plugin');

		// Must do a lot of manual work. Can't afford to trip the session (mainly a call to JFactory::getUser()).
		$query = $this->db->getQuery(true);
		
		
		
		
		
		

		// Get a list of the plugins from the database.
		$query->select('p.*')
			->from('saas_extensions AS p')
			->where('p.enabled = 1')
			->where('p.type = ' . $this->db->quote('plugin'))
			->where('p.folder = ' . $this->db->quote('cron'))
			->order('p.ordering');
		$this->db->setQuery($query);

		$plugins = $this->db->loadObjectList();

		$result = array();

		// Convert the parameters for each plugin.
		foreach ($plugins as $plugin)
		{
		//	$className = 'plg' . ucfirst($plugin->folder) . ucfirst($plugin->element);
		
		$className = 'plgSaasmarketsMerchants';
		

			// Preload the plugins.
			$path = JPath::clean(sprintf('%s/plugins/%s/%s/%s.php', $cmsPath, $plugin->folder, $plugin->element, $plugin->element));
			require_once $path;

			if (class_exists($className))
			{
				$result[] = new $className($this, array('params' => new JRegistry($plugin->params)));
			}
		}

		return $result;
	}
}
