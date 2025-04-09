<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// CREATE COOKIE
	$value  = "1";
	$expire = time() + ( 90 * 60 * 60 * 24 ); // 90 dia(s)
	// $expire = time() + ( 60 * 10 ); // 10 min
	$cookie = setcookie($_param['accept-cookies'], $value, $expire, '/');

	if( $cookie )
	{
		echo "1";
	}else{
		echo "0";
	}

} else header ('HTTP/1.1 404 Not Found');