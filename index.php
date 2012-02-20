<?php

    /**
     * Index.php the target for our web server.
     *
     * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
    */

    use \System\Panda\Panda;
	use \System\Panda\Request;

	$root = realpath(dirname(__FILE__)) . '/';

	require_once $root . 'Bootstrap.php';
	require_once $root . 'System/Panda/Registry.php';
	require_once $root . 'System/Panda/Panda.php';

	$panda = Panda::getInstance(array(
		'root' => $root,
		'application' => 'Index',
		
		'request' => $_SERVER['REQUEST_URI'],
		'host' => $_SERVER['HTTP_HOST'],
		'file' => $_SERVER['SCRIPT_NAME'],
		'memory' => PANDA_MEMORY,
		'time' => PANDA_TIME,
	));
	
	var_dump($panda);
	
	/*$request = new Request($panda);
	$request->handleRequest();*/