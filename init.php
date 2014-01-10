<?php

include 'config.php';

$base_dir = dirname(__FILE__);

$sql = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

spl_autoload_register(function($class) {
	global $base_dir;
	include $base_dir . '/lib/class.' . $class . '.php';
});
