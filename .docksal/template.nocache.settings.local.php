<?php

// Docksal DB connection settings.
$databases['default']['default'] = array (
  'database' => 'default',
  'username' => 'user',
  'password' => 'user',
  'host' => 'db',
  'driver' => 'mysql',
);

// Enable local development services.
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/default/development.services.yml';

// Be picky about error reporting.
$config['system.logging']['error_level'] = 'verbose';

// Disable CSS and JS aggregation.
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

// Disable the render cache (this includes the page cache).
$settings['cache']['bins']['render'] = 'cache.backend.null';

// Disable Dynamic Page Cache.
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

// Allow test modules and themes to be installed.
$settings['extension_discovery_scan_tests'] = TRUE;

// Enable access to rebuild.PHP
$settings['rebuild_access'] = TRUE;

// skip file system permissions hardening
$settings['skip_permissions_hardening'] = TRUE;

// Set the trused host variable (https://www.drupal.org/node/1992030)
$settings['trusted_host_patterns'] = array('localhost', 'drupal8.docksal');

// Stage File Proxy settings
#$config['stage_file_proxy.settings']['origin'] = 'https://SITE_GOES_HERE';

