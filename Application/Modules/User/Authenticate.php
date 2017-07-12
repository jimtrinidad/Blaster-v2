<?php

namespace Loki\Module\User;

use Loki\Core\Controller;

/**
* Authenticate class
*/
class Authenticate extends Controller
{
	
	private $auth;

	function __construct()
	{
		parent::__construct();
		$this->auth = $this->app->loader->model('auth');
	}

	public function getLogin() {
		echo 'get login';
		var_dump($this->auth);
	}

	public function postLogin() {
		echo 'post login';
	}

}