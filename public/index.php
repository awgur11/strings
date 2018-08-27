<?php
ini_set('display_errors', 1);

define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

spl_autoload_register(function ($class) {
	$paths = [
	  'application/classes/',
	  'application/controllers/',
	  'application/models/',
	        ];

	foreach($paths as $path)
	{
	  	if(file_exists(DOCROOT.$path.$class.'.php')) include DOCROOT.$path.$class.'.php';
	}
});

require DOCROOT.'application/config/database.php';

require_once DOCROOT.'application/bootstrap.php';
