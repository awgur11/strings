<?php

function dd($var)
{ header('Content-Type', 'text/xml');
	//echo '<pre>';
	print_r($var);
	//echo '</pre>';
	die();
}


require_once 'core/Model.php';

require_once 'core/Controller.php';

require_once 'core/route.php';

Route::start(); // 