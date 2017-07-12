<?php

namespace Loki\Module\User;

use Loki\Core\Controller;

/**
* Authenticate class
*/
class Authenticate extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getLogin() {
		echo 'get login';
	}

	public function postLogin() {
		echo 'post login';
	}

}