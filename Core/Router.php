<?php

namespace Loki\Core;

use Loki\Core;

/**
* Request routing handler
*/
class Router
{
	
	public $_verb;
	public $_params;
	public $_module;
	public $_action;

	public function __construct()
	{

		$url_params		= explode( '/', substr( str_replace( $_SERVER[ 'SCRIPT_NAME' ], '', $_SERVER[ 'PHP_SELF' ] ), 1 ) );

        $this->_verb 	= strtolower($_SERVER['REQUEST_METHOD']);
        $this->_module	= isset($url_params[0]) ? $url_params[0] : false;
        $this->_action	= isset($url_params[1]) ? $url_params[1] : false;
		
		$request_data 	= array_merge($_GET, $_POST, $_FILES);

        foreach($request_data as $key => $value) {
        	$this->_params[$key] = $value;
        }

        Core\Response::show($_SERVER);

	}
}