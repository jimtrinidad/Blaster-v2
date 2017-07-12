<?php

namespace Loki\Core;
use Loki\Core;

/**
* Loader class
*/
class Loader
{
	/**
	* Initialize Core Class
	*/
	public function core($class)
	{
		$class 		= ucfirst(strtolower($class));
		$className 	= "\Loki\Core\\$class";

		if (class_exists($className)) {
			return new $className();
		} else {
			Core\Response::logger($className . ' -  core class not found.');
		}

		return false;
	}

	/**
	* Load Module Controller
	*/
	public function controller($module, $class)
	{
		$module 			= ucfirst(strtolower($module));
		$class 				= ucfirst(strtolower($class));
		$className 			= "\Loki\Module\\$module\\$class";
		$controller_file	= MODULE_DIR . $module . DS . $class . '.php';

		if (file_exists($controller_file)) {
			
			require_once $controller_file;

			if (class_exists($className)) {
				return new $className();
			} else {
				Core\Response::logger($className . ' -  controller class not found.');
			}

		} else {
			Core\Response::logger($className . ' -  controller file not found.');
		}

		return false;
	}

	/**
	* Load Model Class
	*/
	public function model($class)
	{
		$class 			= ucfirst(strtolower($class));
		$className 		= "\Loki\Model\\$class";
		$model_file		= MODEL_DIR . $class . '.php';

		if (file_exists($model_file)) {
			
			require_once $model_file;

			if (class_exists($className)) {
				return new $className();
			} else {
				Core\Response::logger($className . ' -  model class not found.');
			}
			
		} else {
			Core\Response::logger($className . ' -  model file not found.');
		}

		return false;
	}

	/**
	* Get System Config from Config/_system.php
	*/
	public function config($config = 'all')
	{
		global $system_config;
		
		if ($config == 'all') {
			return $system_config;
		}

		if (isset($system_config[$config])) {
			return $system_config[$config];
		}

		return false;

	}
}