<?php
	
    define('PANDA_MEMORY', memory_get_usage());  
    define('PANDA_TIME', microtime(true));

    use \System\Panda\Panda;
	use \System\Panda\Request;

	$root = realpath(dirname(__FILE__)) . '/../';

	require_once $root . 'System/Panda/Registry.php';
	require_once $root . 'System/Panda/Panda.php';

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
	