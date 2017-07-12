<?php

namespace Loki\Core;
use Mysqli\DbManager;
/**
* 
*/
class Model extends DbManager
{
	
	protected $app;

	function __construct()
	{
		global $app;
		$this->app = $app;

		$db_config = $this->app->loader->config('db')['mysql'];
		$this->connect($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['dbname']);
	}

}