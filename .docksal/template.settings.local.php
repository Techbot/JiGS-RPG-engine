<?php

// Docksal DB connection settings.
$databases['default']['default'] = array (
  'database' => 'default',
  'username' => 'user',
  'password' => 'user',
  'host' => 'db',
  'driver' => 'mysql',
);

// Be picky about error reporting.
$config['system.logging']['error_level'] = 'verbose';

// Disable CSS and JS aggregation.
$config['system.performance']['css']['preprocess'] = TRUE;
$config['system.performance']['js']['preprocess'] = TRUE;

// Override default port configuration for Solr.
$config['search_api.server.solr_server']['backend_config']['connector_config']['host'] = 'solr';
$config['search_api.server.solr_server']['backend_config']['connector_config']['port'] = '8983';

// Set the trused host variable (https://www.drupal.org/node/1992030)
$settings['trusted_host_patterns'] = array('localhost', 'drupal8.docksal');

// Stage File Proxy settings
#$config['stage_file_proxy.settings']['origin'] = 'http://SITE_GOES_HERE';

// skip file system permissions hardening.
$settings['skip_permissions_hardening'] = TRUE;

