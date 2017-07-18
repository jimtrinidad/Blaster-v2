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
		$module 			= Utilities::format_name($module);
		$class 				= Utilities::format_name($class);
		$className 			= "\Loki\Module\\$module\\$class";

		if (class_exists($className)) {
			return new $className();
		} else {
			Core\Response::logger($className . ' -  controller class not found.');
		}

		return false;
	}

	/**
	* Load Model Class
	*/
	public function model($class)
	{
		$class 			= Utilities::format_name($class);
		$className 		= "\Loki\Model\\$class";

		if (class_exists($className)) {
			return new $className();
		} else {
			Core\Response::logger($className . ' -  model class not found.');
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

	/**
	* Get System defaults from Config/_defaults.php
	*/
	public function defaults($key = 'all')
	{
		global $system_defaults;
		
		if ($key == 'all') {
			return $system_defaults;
		}

		if (isset($system_defaults[$key])) {
			return $system_defaults[$key];
		}

		return false;

	}

}