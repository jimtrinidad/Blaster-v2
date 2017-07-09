<?php

include_once '_config.php';

use Loki\Core;

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
			ini_set('display_errors','On');
			define( 'DB_DEBUG', TRUE );
		break;
	
		case 'production':
			error_reporting(E_ALL);
		    ini_set('display_errors','Off');
		    ini_set('log_errors', 'On');
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

$app = new Core\Loki();