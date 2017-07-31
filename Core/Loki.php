<?php

namespace Loki\Core;

use Loki\Core;
use Loki\Module;
use Loki\Model;

class Loki 
{
	
	public $defaults;

	/**
	* class instances holder
	*/
	public $request;
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
		$this->request = new Request($this);

		$module = $this->load_module();

		if ($module !== false) {

			$className = $this->load_controller($module);

			if ($className !== false) {

				$controller = new $className();
				$response = $this->call_function($controller);
				if (is_array($response)) {
					Response::show($response);
				} else {
					Response::show(array(
							$response
						));
				}

			} else {
				Response::show(array(
						'status'	=> false,
						'message'	=> 'Application controller required.'
					), 404);
			}

		} else {
			Response::show(array(
					'status'	=> false,
					'message'	=> 'Application module required.'
				), 404);
		}

	}


	/**
	* Get and load application module
	*/
	private function load_module()
	{

		if ($this->request->module) {
			if (is_dir(MODULE_DIR . $this->request->module)) {
				return $this->request->module;
			} else {
				Response::show(array(
						'status'	=> false,
						'message'	=> 'Module not found.'
					), 404);
			}
		}

		return false;

	}

	/**
	* Load and initialize controller
	*/
	private function load_controller($module)
	{

		if ($this->request->controller) {

			$controller_file = MODULE_DIR . $module . DS . $this->request->controller . '.php';

			if (file_exists($controller_file)) {

				$className 	= 'Loki\Module\\' . $module . '\\' . $this->request->controller;

				if (class_exists($className)) {
					return $className;
				} else {
					Response::show(array(
							'status'	=>false,
							'message'	=> 'Controller class not found.'
						), 404);
				}

			} else {
				Response::show(array(
						'status'	=> false,
						'message'	=> 'Controller file not found.'
					), 404);
			}

		}

		return false;

	}

	/**
	* Call controller function
	*/
	private function call_function($controller)
	{
		
		if ($this->request->action) {
			$action = $this->request->action;
		} else {
			$action = 'Index'; 
		}

		// prefix verb call
		$functionName = $this->request->verb() . $action;
		if (method_exists($controller, $functionName)) {
			return call_user_func_array(array($controller, $functionName), $this->request->func_args);
		} else {
			Response::show(array(
					'status'	=> false,
					'message'	=> 'Controller function not found.'
				), 404);
		}

	}

}