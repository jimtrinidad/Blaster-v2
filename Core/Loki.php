<?php

namespace Loki\Core;

use Loki\Core;
use Loki\Module;
use Loki\Model;

class Loki 
{
	
	public $defaults;

	public $router;
	public $loader;
	public $auth;

	public function __construct() 
	{
		global $system_defaults;

		$this->defaults = (object) $system_defaults;
		$this->loader 	= new Loader();
		$this->auth 	= new Auth();
	}

	/**
	* Core function to initialize application
	*/
	public function run()
	{

		//excute request routing
		$this->router = new Router($this);

		$module 		= $this->load_module();

		if ($module !== false) {

			$className = $this->load_controller($module);

			if ($className !== false) {

				$controller = new $className();
				$this->call_function($controller);

			} else {
				Response::show(array(
						'status'	=> false,
						'message'	=> 'Application controller required.'
					));
			}

		} else {
			Response::show(array(
					'status'	=> false,
					'message'	=> 'Application module required.'
				));
		}

	}


	/**
	* Get and load application module
	*/
	private function load_module()
	{

		if ($this->router->module) {
			if (is_dir(MODULE_DIR . $this->router->module)) {
				return $this->router->module;
			} else {
				Response::show(array(
						'status'	=> false,
						'message'	=> 'Module not found.'
					));
			}
		}

		return false;

	}

	/**
	* Load and initialize controller
	*/
	private function load_controller($module)
	{

		if ($this->router->controller) {

			$controller_file = MODULE_DIR . $module . DS . $this->router->controller . '.php';

			if (file_exists($controller_file)) {

				include_once $controller_file;

				$className 	= 'Loki\Module\\' . $module . '\\' . $this->router->controller;

				if (class_exists($className)) {
					return $className;
				} else {
					Response::show(array(
							'status'	=>false,
							'message'	=> 'Controller class not found.'
						), true);
				}

			} else {
				Response::show(array(
						'status'	=> false,
						'message'	=> 'Controller file not found.'
					));
			}

		}

		return false;

	}

	/**
	* Call controller function
	*/
	private function call_function($controller)
	{
		
		if ($this->router->action) {
			$action = $this->router->action;
		} else {
			$action = 'Index'; 
		}

		// prefix verb call
		$functionName = $this->router->verb() . $action;
		if (method_exists($controller, $functionName)) {
			call_user_func(array($controller, $functionName));
		} else {
			Response::show(array(
					'status'	=> false,
					'message'	=> 'Controller function not found.'
				));
		}

	}

}