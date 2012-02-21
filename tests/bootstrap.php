<?php
	
    define('PANDA_MEMORY', memory_get_usage());  
    define('PANDA_TIME', microtime(true));

    use \Panda\System\Panda;
	use \Panda\System\Request;

	$root = realpath(dirname(__FILE__)) . '/../';

	require_once $root . 'functions.php';
	require_once $root . 'Panda/System/Exceptions/Exception.php';
	require_once $root . 'Panda/System/Exceptions/ClassNotFoundException.php';
	require_once $root . 'Panda/System/Registry.php';
	require_once $root . 'Panda/System/Panda.php';

	$panda = Panda::getInstance(array(
		'root' => $root,
		'application' => 'Index',
		
		'request' => '/index.php/test',
		'host' => 'example.com',
		'file' => '/index.php',
		'memory' => PANDA_MEMORY,
		'time' => PANDA_TIME,
	));
	
	require_once(realpath(dirname(__FILE__)) . '/simpletest/autorun.php');
	