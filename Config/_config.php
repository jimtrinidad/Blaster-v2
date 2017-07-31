<?php

date_default_timezone_set('Asia/Singapore');

/**
* CONSTANTS
*/

define('SYSTEM_ENV', 'dev');
define('AUTHENTICATE', false);

define('DS', 				DIRECTORY_SEPARATOR);
define('ROOT_DIR', 			dirname(dirname(__FILE__)));

define('SYSTEM_DIR', 		ROOT_DIR . DS . 'Core' . DS);
define('APPLICATION_DIR', 	ROOT_DIR . DS . 'Application' . DS);
define('MODULE_DIR', 		APPLICATION_DIR . 'Modules' . DS);
define('MODEL_DIR', 		APPLICATION_DIR . 'Models' . DS);
define('VENDORS_DIR', 		ROOT_DIR . DS . 'Vendors' . DS);
define('TEMP_DIR', 			ROOT_DIR . DS . '_tmp' . DS);


/*=================================================================*/


/**
* SYSTEM CONFIG
*/

$system_config = array(

	'base_url'	=> '',

	/**
	* DATABASE CONFIG
	*/
	'db' => array(
			'mysql'	=> array(
					'host'		=> 'localhost',
					'port'		=> '',
					'user'		=> 'jim',
					'pass'		=> '',
					'dbname'	=> 'db_mailer'
				)
		)

);


/*=================================================================*/


/**
* SYSTEM DEFAULTS
*/

$system_defaults = array(

	// default module to load. set false if require
	'module'		=> false,

	// default controller class. set false if require
	'controller'	=> false,

	/**
	* redirect for not authenticated
	*/
	'auth'			=> array(
			'module'		=> 'User',
			'controller'	=> 'Authenticate',
			'action'		=> 'Login'
		)

);


/*=================================================================*/


include_once '_classes.php';