<?php

namespace Loki\Core;

class Utilities
{


	/**
	*format routes to File and Class naming format
	*/
	public static function format_name($string)
	{
		return ucfirst(strtolower($string));
	}

}