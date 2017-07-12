<?php

$third_parties	= array(
	'MySQLi' => VENDORS_DIR . 'mysqli_db.class.php',
);

foreach($third_parties as $class) {
	require_once $class;
}