<?php

namespace Loki\Core;

use Loki\Core;

class Loki 
{
	
	public $router;
	public $defaults;

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

		if ($module) {

			$controller 	= $module . DS . ($this->router->controller !== false ? $this->router->controller : $this->defaults->controller) . '.php';

			if (file_exists($controller)) {

			} else {
				Core\Response::show(array(
						'status'	=> false,
						'message'	=> 'Controller not found.'
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
			if (is_dir(MODULE_DIR . $this->router->module)) {
				return MODULE_DIR . $this->router->module;
			} else {
				Core\Response::show(array(
						'status'	=> false,
						'message'	=> 'Module not found.'
					));
			}
		} 
		else if ($this->defaults) {
			if (is_dir(MODULE_DIR . $this->defaults->module)) {
				return MODULE_DIR . $this->defaults->module;
			} else {
				Core\Response::show(array(
						'status'	=> false,
						'message'	=> 'Default module not found.'
					));
			}
		}

		return false;
	}

	/**
	* Load and initialize controller
	*/
	private function load_controller()
	{
		if ($this->router->controller) {
			$controller_file = $this->get_module() . DS . $this->router->controller . '.php';
			if (file_exists($controller_file)) {

			} else {
				Core\Response::show(array(
						'status'	=> false,
						'message'	=> 'Controller file not found.'
					));
			}
		}
	}

}