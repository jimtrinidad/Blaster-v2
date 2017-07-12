<?php
include_once 'Config/_config.php';

use Loki\Core;

switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(E_ALL);
		ini_set('display_errors', true);
		define( 'DB_DEBUG', TRUE );
	break;

	case 'production':
		error_reporting(E_ALL);
	    ini_set('display_errors', false);
	    ini_set('log_errors', 'On');
	break;

	default:
		exit('The application environment is not set correctly.');
}

/**
* Include class paths
*/ 
set_include_path( implode( PATH_SEPARATOR, array(
	get_include_path(),
	SYSTEM_DIR
)));


$_classes = array(
	'Loki',
	'Router',
	'Response',
	'Loader',
	'Controller',
	'Model'
);

foreach($_classes as $class) {
	require_once $class . '.php';
}

$app = new Core\Loki();
$app->run();