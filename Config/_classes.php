<?php

/**
* Include class paths
*/ 
set_include_path( implode( PATH_SEPARATOR, array(
	get_include_path(),
	SYSTEM_DIR,
	VENDORS_DIR
)));

/**
* Core classes
*/
$core_class = array(
	'Loki',
	'Router',
	'Response',
	'Loader',
	'Controller',
	'Model',
	'Utilities',
	'Auth'
);

/**
* Additional 3rd party classes
*/
$third_parties	= array(
	'MySQLi' => 'mysqli_db.class',
);


$_classes = array_merge($third_parties, $core_class);
foreach($_classes as $class) {
	require_once $class . '.php';
}