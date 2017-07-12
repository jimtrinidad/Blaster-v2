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

	public function __construct() 
	{
		global $defaults;
		$this->defaults = (object) $defaults;
	}

	/**
	* Core function to initialize application
	*/
	public function run()
	{

		//excute request routing
		$this->router = new Core\Router;

		$module 		= $this->load_module();

		if ($module !== false) {

			$className = $this->load_controller($module);

			if ($className !== false) {

				$controller = new $className();
				$this->call_function($controller);

			} else {
				Core\Response::show(array(
						'status'	=> false,
						'message'	=> 'Application controller required.'
					));
			}

		} else {
			Core\Response::show(array(
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
			$module = $this->router->module;
		} else if ($this->defaults->module) {
			$module = $this->defaults->module;
		} else {
			return false;
		}

		if ($module !== false) {
			if (is_dir(MODULE_DIR . $this->router->module)) {
				return MODULE_DIR . $this->router->module;
			} else {
				Core\Response::show(array(
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
			$controller = $this->router->controller;
		} else if ($this->defaults->controller) {
			$controller = $this->defaults->controller;
		} else {
			return false;
		}

		if ($controller !== false) {

			$controller_file = $module . DS . $this->router->controller . '.php';
			if (file_exists($controller_file)) {

				include_once $controller_file;

				$className 	= 'Loki\Module\\' . $this->router->module . '\\' . $this->router->controller;

				if (class_exists($className)) {
					return $className;
				} else {
					Core\Response::show(array(
							'status'	=>false,
							'message'	=> 'Controller class not found.'
						), true);
				}

			} else {
				Core\Response::show(array(
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
		} else if ($this->defaults->action) {
			$action = $this->defaults->action;
		} else {
			return false; 
		}

		if ($action !== false) {

			// prefix verb call
			$functionName = $this->router->verb() . $action;
			if (method_exists($controller, $functionName)) {
				call_user_func(array($controller, $functionName));
			} else {
				Core\Response::show(array(
						'status'	=> false,
						'message'	=> 'Controller function not found.'
					));
			}

		} else {
			Core\Response::show(array(
					'status'	=> false,
					'message'	=> 'Controller function required.'
				));
		}

	}

}