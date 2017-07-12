<?php

namespace Loki\Core;

/**
* 
*/
class Model
{
	
	protected $app;

	function __construct()
	{
		global $app;
		$this->app = $app;
	}

}