<?php

namespace Loki\Core;

use Loki\Core;

/**
* Request routing handler
*/
class Router
{
	
	public $verb;
	public $module;
	public $controller;
	public $action;
	public $segments;
	public $params;

	public function __construct()
	{

		$url_params		= explode( '/', substr( str_replace( $_SERVER[ 'SCRIPT_NAME' ], '', $_SERVER[ 'PHP_SELF' ] ), 1 ) );

		$this->verb 		= strtolower($_SERVER['REQUEST_METHOD']);
		$this->module		= isset($url_params[0]) && trim($url_params[0]) != '' ? ucfirst(strtolower($url_params[0])) : false;
		$this->controller	= isset($url_params[1]) && trim($url_params[1]) != '' ? ucfirst(strtolower($url_params[1])) : false;
		$this->action		= isset($url_params[2]) && trim($url_params[2]) != '' ? ucfirst(strtolower($url_params[2])) : false;

		$request_data 		= array_merge($_GET, $_POST, $_FILES);

		foreach ($url_params as $k => $param) {
			if ($k > 2) {
				$this->segments[] = $param;
			}
		}


		foreach($request_data as $key => $value) {
			$this->params[$key] = $value;
		}

	}
	

	public function segment($index)
	{
		$index = $index - 1;
		return isset($this->segments[$index]) ? $this->segments[$index] : false;
	}

}