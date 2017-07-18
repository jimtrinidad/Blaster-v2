<?php

include_once 'Config/_config.php';

use Loki\Core;

switch (SYSTEM_ENV)
{
	case 'dev':
		error_reporting(E_ALL);
		ini_set('display_errors', true);
		define( 'DB_DEBUG', TRUE );
	break;

	case 'prod':
		error_reporting(E_ALL);
	    ini_set('display_errors', false);
	    ini_set('log_errors', 'On');
	break;

	default:
		exit('The application environment is not set correctly.');
}

$app = new Core\Loki();
$app->run();