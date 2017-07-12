<?php

namespace Loki\Core;

/**
* Loader class
*/
class Loader
{
	
	protected $app;

	function __construct()
	{
		global $app;
		$this->app = $app;
	}

}