<?php

namespace Loki\Core;

class Auth
{
	/**
	* check if user is logged in or a guest
	*/
	public function isGuest()
	{
		return true;
	}

	/**
	* do login
	*/
	public function authenticate($params)
	{

	}

	/**
	* do logout
	*/
	public function destroy()
	{

	}
}