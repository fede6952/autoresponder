<?php

namespace core;

/**
 * Init file
 * @author Mike Lopez <e@coderscult.com>
 */

include 'config.php';

$base_dir = dirname(__FILE__);

/**
 * MySQLi Object
 * @global mysqli $_GLOBALS['sql']
 */
$sql = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

spl_autoload_register(function($class) {
	global $base_dir;
	include $base_dir . '/lib/class.' . $class . '.php';
});
