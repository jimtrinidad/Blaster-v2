<?php

namespace Loki\Core;

use Loki\Core;

class Loki 
{
	
	public $Router;

	public function __construct() 
	{
		$this->Router = new Core\Router;
	}

}