<?php

namespace Loki\Core;

class Response
{

	public static function show( $data, $kill = true )
	{

		$debug = isset( $_GET['debug'] ) ? true : false;

		if( $debug ) {
			header("Content-type: text/html; charset=utf-8");
			echo '<pre>';
			print_r( $data );
			echo '</pre>';
			exit;
		}
		
		header("Access-Control-Allow-Origin: *");
		header("Content-type: application/json; charset=utf-8");
		echo json_encode( $data );

		if( $kill === true ) {
			die();
		}
	}

	public static function logger($message)
	{
		if (SYSTEM_ENV == 'prod') {
			syslog(LOG_INFO, date('Y-m-d H:i:s') . ' - ' . $message);
		} else {
			throw new Exception($message);
		}
	}

}