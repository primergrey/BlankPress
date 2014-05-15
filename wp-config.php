<?php

// User Configuration

$DBName = ''; // e.g. primergrey
$URL = ''; // e.g. local.domain.tld

// WordPress Settings

define('DB_NAME', $DBName);
define('WP_SITEURL', 'http://' . $URL . '/lib');
define('WP_HOME', 'http://' . $URL);

define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
define('WP_CONTENT_URL', WP_HOME . '/wp-content');

define('WP_DEBUG', true);
define('SCRIPT_DEBUG', true);
define('CONCATENATE_SCRIPTS', false);

if (!defined('ABSPATH'))
	define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
