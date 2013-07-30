<?php
/**
 * @package     Kodaly.Application
 * @subpackage  Application
 *
 * @copyright   Copyright (C) {COPYRIGHT}. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Kodaly CLI Application Class
 *
 * @package     Kodaly.Application
 * @subpackage  Application
 * @since       1.0
 */
class KodalyApplicationCli extends JApplicationCli
{
	/**
	 * A database driver for the application to use.
	 *
	 * @var    JDatabaseDriver
	 * @since  1.0
	 */
	protected $db;

	/**
	 * Execute the application.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function doExecute()
	{
		// Check if help is needed.
		if ($this->input->get('h', $this->input->get('help')))
		{
			$this->_help();

			return;
		}

		// Initialise the database connection if not already.
		if (empty($this->db))
		{
			$this->loadDatabase();
		}

		// Check command line switches.
		$group = $this->input->get('g') || $this->input->get('group') || 'cron';

		if (empty($this->input->args))
		{
			$this->_help();

			return;
		}

		$cmsPath = $this->input->args[0];

		// Create a registry for the model state.
		$state = new JRegistry;

		$model = new KodalyModelPlugins($state, $this->db);

		// Load the plugins.
		$plugins = $model->load($cmsPath, $group);

		$x= serialize($plugins);
		$this->out($x);




  		// Run the plugins.
		foreach ($plugins as $plugin)
		{
			JLog::add(sprintf('Running "%s"', $plugin->getName()));

		$message =	$plugin->run();
			
		$this->out($message);
			
		}
	}

	/**
	 * Allows the application to load a custom or default database driver.
	 *
	 * @param   JDatabaseDriver  $driver  An optional database driver object. If omitted, the application driver is created.
	 *
	 * @return  JApplicationBase This method is chainable.
	 *
	 * @since   12.1
	 */
	public function loadDatabase(JDatabaseDriver $driver = null)
	{
		if ($driver === null)
		{
			$this->db = JDatabaseDriver::getInstance(
				array(
					'driver' => $this->get('db_driver'),
					'host' => $this->get('db_host'),
					'user' => $this->get('db_user'),
					'password' => $this->get('db_pass'),
					'database' => $this->get('db_name'),
					'prefix' => $this->get('db_prefix')
				)
			);

			// Select the database.
			$this->db->select($this->get('db_name'));
		}
		// Use the given database driver object.
		else
		{
			$this->db = $driver;
		}

		// Set the database to our static cache.
		JFactory::$database = $this->db;

		return $this;
	}

	/**
	 * Fetch the configuration data for the application.
	 *
	 * @return  object  An object to be loaded into the application configuration.
	 *
	 * @since   1.0
	 * @throws  RuntimeException if file cannot be read.
	 */
	protected function fetchConfigurationData()
	{
		// Initialise variables.
		$config = array();

		// Ensure that required path constants are defined.
		if (!defined('JPATH_CONFIGURATION'))
		{
			$path = getenv('Kodaly_CONFIG');
			if ($path)
			{
				define('JPATH_CONFIGURATION', realpath($path));
			}
			else
			{
				define('JPATH_CONFIGURATION', realpath(dirname(JPATH_BASE) . '/config'));
			}
		}

		// Set the configuration file path for the application.
		if (file_exists(JPATH_CONFIGURATION . '/config.json'))
		{
			$file = JPATH_CONFIGURATION . '/config.json';
		}
		else
		{
			// Default to the distribution configuration.
			$file = JPATH_CONFIGURATION . '/config.dist.json';
		}

		if (!is_readable($file))
		{
			throw new RuntimeException('Configuration file does not exist or is unreadable.');
		}

		// Load the configuration file into an object.
		$config = json_decode(file_get_contents($file));

		return $config;
	}

	/**
	 * Display the help text for the command line application.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	private function _help()
	{
		$this->out('Kodaly 1.0.');
		$this->out();
		$this->out('An application to run a group of Joomla CMS plugins.');
		$this->out();
		$this->out('Usage:    run [switches] path-to-Joomla-CMS');
		$this->out();
		$this->out('  -h | --help    Prints this usage information.');
		$this->out('  -g | --group   The plugin group to trigger (default is "cron").');
		$this->out();
		$this->out('Examples: ./run -h');
		$this->out('Examples: ./run -g cron7 /var/www/joomla');
		$this->out();
	}
}
