<?php
	
    define('PANDA_MEMORY', memory_get_usage());  
    define('PANDA_TIME', microtime(true));

    /**
     * Index.php the target for our web server.
     *
     * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
    */

    use \Panda\System\Panda;
	use \Panda\System\Request;
	use \Panda\System\Router;
	use \Panda\System\ControllerFactory;

	$root = realpath(dirname(__FILE__)) . '/';

	require_once $root . 'bootstrap.php';
	require_once $root . 'functions.php';
	require_once $root . 'Panda/System/Registry.php';
	require_once $root . 'Panda/System/Panda.php';

	$panda = Panda::getInstance(array(
		'root' => $root,
		'application' => 'Index',
		
		'request' => $_SERVER['REQUEST_URI'],
		'host' => $_SERVER['HTTP_HOST'],
		'file' => $_SERVER['SCRIPT_NAME'],
		'memory' => PANDA_MEMORY,
		'time' => PANDA_TIME,

		// The properties below are to be overrided within your AppConfig
		'debug' => (bool)false,

		'defaultController' => 'Home',
		'defaultMethod' => 'index',

		'appRegistry' => (bool)true,		
	));
	
	$request = new Request($panda);
	$request->handleRequest();

	$router = new Router($request, $panda);
	ControllerFactory::create($router->getRoute(), $router->isDirectory());
	
	echo '<pre>' . ((memory_get_usage()-PANDA_MEMORY)/1024) . ' kb</pre>';
	echo '<pre>' . (microtime(true)-PANDA_TIME) . '</pre>';