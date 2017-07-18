<?php

/**
* Class Mapping
* Used for not well formated namespace.
*/

$class_mapping = array(
		
		'Core'				=> array(''),
		'Model'				=> array('Application','Models'),
		'Module'			=> array('Application','Modules'),

		'Mysqli\DbManager'	=> 'mysqli_db.class'

	);

/**
* Include class paths
*/ 
set_include_path( implode( PATH_SEPARATOR, array(
	get_include_path(),
	SYSTEM_DIR,
	VENDORS_DIR,
)));

spl_autoload_register(function ($name) use ($class_mapping) {

	$tmp 	= explode('\\', $name);
	if (isset($tmp[1]) && array_key_exists($tmp[1], $class_mapping) && is_array($class_mapping[$tmp[1]])) {
		$name = ltrim(implode('/', $class_mapping[$tmp[1]]) . '/' . implode('/', array_slice($tmp, 2)), '/');
	} else if (isset($class_mapping[$name])) {
		$name = $class_mapping[$name];
	} else {
		$name = str_replace('\\', '/', $name);
	}

    include_once $name . '.php';

});
