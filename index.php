<?php
	
    define('PANDA_MEMORY', memory_get_usage());  
    define('PANDA_TIME', microtime(true));

    /**
     * Index.php the target for our web server.
     *
     * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
    */

    use \System\Panda\Panda;
	use \System\Panda\Request;

	$root = realpath(dirname(__FILE__)) . '/';

	require_once $root . 'bootstrap.php';
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
	
	$request = new Request($panda);
	$request->handleRequest();
	
	echo '<pre>' . var_dump($request->getRequest()) . '</pre>';
	
	echo '<pre>' . print_r(((memory_get_usage()-PANDA_MEMORY)/1024) . ' kb', 1) . '</pre>';
	echo '<pre>' . print_r(microtime(true)-PANDA_TIME, 1) . '</pre>';