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
		var_dump($this->app->loader->model('user'));
		var_dump($this->app->loader->core('Response'));
		var_dump($this->app->loader->controller('user','authenticate'));
		var_dump($this->app->loader->config());
		var_dump($this->app->loader->defaults());
	}

	public function postLogin() {
		echo 'post login';
	}

}