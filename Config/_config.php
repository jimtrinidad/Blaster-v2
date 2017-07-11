<?php

date_default_timezone_set('Asia/Singapore');

define('ENVIRONMENT', 'development');
define('AUTHENTICATE', true);

include_once '_constants.php';
include_once '_defaults.php';

$config = array(

'base_url'	=> '',

/**
* DATABASE CONFIG
*/
'db' => array(
		'mysql'	=> array(
				'host'	=> '',
				'port'	=> '',
				'user'	=> '',
				'pass'	=> ''
			),
		'mongo' => array()
	)

);