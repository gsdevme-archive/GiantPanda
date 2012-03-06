<?php
	
    define('PANDA_MEMORY', memory_get_usage());  
    define('PANDA_TIME', microtime(true));

	$root = realpath(dirname(__FILE__)) . '/../';

	require_once $root . 'functions.php';
	require_once $root . 'bootstrap.php';
	require_once $root . 'Panda/System/Exceptions/Exception.php';
	require_once $root . 'Panda/System/Exceptions/ClassNotFoundException.php';
	require_once $root . 'Panda/System/Registry.php';
	require_once $root . 'Panda/System/Panda.php';

	$panda = \Panda\System\Panda::getInstance(array(
		'root' => $root,
		'application' => 'Index',
		'request' => $_SERVER['REQUEST_URI'],
		'host' => $_SERVER['HTTP_HOST'],
		'file' => $_SERVER['SCRIPT_NAME'],
		'memory' => PANDA_MEMORY,
		'time' => PANDA_TIME,
		// The properties below are to be overrided within your AppConfig
		'debug' => ( bool ) false,
		'defaultController' => 'Home',
		'defaultMethod' => 'index',
		'appRegistry' => ( bool ) true,
	), true);

	/**
	* Change this to your location !
	*/
	if(!file_exists('/Applications/MAMP/bin/php/php5.3.6/lib/php/PHPUnit/Autoload.php')){
		die('Open tests/bootstrap and change the location of PHPUnit');
	}

	require_once '/Applications/MAMP/bin/php/php5.3.6/lib/php/PHPUnit/Autoload.php';