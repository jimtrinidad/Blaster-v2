<?php

namespace Loki\Core;

/**
* 
*/
class Controller
{
	
	protected $app;

	function __construct()
	{
		global $app;
		$this->app = $app;
	}

}