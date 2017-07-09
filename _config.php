<?php

date_default_timezone_set('Asia/Singapore');

define('ENVIRONMENT', 'development');

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_DIR', dirname(__FILE__));

define('SYSTEM_DIR', 		ROOT_DIR . DS . 'Core' . DS);
define('APPLICATION_DIR', 	ROOT_DIR . DS . 'Application' . DS);
define('CONTROLLER_DIR', 	APPLICATION_DIR . 'Controllers' . DS);
define('MODEL_DIR', 		APPLICATION_DIR . 'Models' . DS);
define('TEMP_DIR', 			ROOT_DIR . DS . '_tmp' . DS);

set_include_path( implode( PATH_SEPARATOR, array(
	get_include_path(),
	SYSTEM_DIR,
)));


$_classes = array(
	'Loki',
	'Router',
	'Response'
);

foreach($_classes as $class) {
	require_once $class . '.php';
}