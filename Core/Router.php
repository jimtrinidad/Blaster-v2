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

	public function __construct($app)
	{

		$url_params		= explode( '/', substr( str_replace( $_SERVER[ 'SCRIPT_NAME' ], '', $_SERVER[ 'PHP_SELF' ] ), 1 ) );

		$this->verb 		= strtolower($_SERVER['REQUEST_METHOD']);

		foreach(array('module','controller','action') as $k => $v) {

			if (AUTHENTICATE && $app->auth->isGuest()) {
				$this->{$v} = Utilities::format_name($app->defaults->auth[$v]);
			} else {
				if (isset($url_params[$k]) && trim($url_params[$k])) {
					$this->{$v} = Utilities::format_name($url_params[$k]);
				} else if ($app->defaults->{$v}) {
					$this->{$v} = Utilities::format_name($app->defaults->{$v});
				} else {
					$this->{$v} = false;
				}
			}
		}

		$request_data 		= array_merge($_GET, $_POST, $_FILES);
		$this->segments 	= array_slice($url_params, 3);


		foreach($request_data as $key => $value) {
			$this->params[$key] = $value;
		}

	}
	
	public function verb()
	{
		/**
		* run verb through this,
		* so we can redirect other verb to different function
		*/
		switch ($this->verb) {
			default:
				return $this->verb;
		}
	}

	public function segment($index)
	{
		$index = $index - 1;
		return isset($this->segments[$index]) ? $this->segments[$index] : false;
	}

}