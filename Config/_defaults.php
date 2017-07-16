<?php

$system_defaults = array(

	// default module to load. set false if require
	'module'		=> false,

	// default controller class. set false if require
	'controller'	=> false,

	// default controller method, set false will use index
	'action'		=> false,

	/**
	* redirect for not authenticated
	*/
	'auth'			=> array(
			'module'		=> 'User',
			'controller'	=> 'Authenticate',
			'action'		=> 'Login'
		)

);