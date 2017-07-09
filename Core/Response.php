<?php

namespace Loki\Core;

class Response {

	static public function show( $data, $kill = true ) {

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

}