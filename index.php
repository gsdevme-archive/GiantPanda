<?php

	/**
	 * Index.php the target for our web server.
	 *
	 * In terms of license to use the Framework, use it as you want. 
	 * If you use it please send us a tweet it wil make my day
	 *
	 * Oh also don't sell my framework unless you want kittens to die
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 *
	 * @contributors -
	 */
	use \Panda\System\Panda;
	use \Panda\System\Request;
	use \Panda\System\Router;
	use \Panda\System\ControllerFactory;
	use \Panda\System\ExceptionHandler;

	if (PHP_VERSION_ID < 50303)
		throw new Exception('Your trying to run me on a PHP version below PHP 5.3.3... how dare you !');

	// Real programming erors
	set_error_handler(function($errno, $errstr, $errfile, $errline ) {
			throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
		});

	// Disable magic quotes (Lovely magic quotes enabled on the server.... a developers worst nightmare)
	if (get_magic_quotes_gpc())
		ini_set('magic_quotes_gpc', 0);

	// This is mainly when running under CLI, its better to just NULL them then get undefined index all over the place..
	if (!isset($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = null;
		$_SERVER['HTTP_HOST'] = null;
	}	

	$root = realpath(dirname(__FILE__)) . '/';

	require $root . 'functions.php';
	require $root . 'Panda/System/Registry.php';
	require $root . 'Panda/System/Panda.php';

	$panda = Panda::getInstance(array(
			'root' => $root,
			'application' => 'Index',
			'request' => $_SERVER['REQUEST_URI'],
			'host' => $_SERVER['HTTP_HOST'],
			'file' => $_SERVER['SCRIPT_NAME'],
			'memory' => memory_get_usage(),
			'time' => microtime(true),
			'version' => '1.0.0',

			// The properties below are to be overrided within your AppConfig
			'debug' => ( bool ) false,
			'defaultController' => 'Home',
			'defaultMethod' => 'index',
			'appRegistry' => ( bool ) true,
		));

	try {
		$request = new Request($panda);
		$request->handleRequest();

		$router = new Router($request, $panda);

		/*
		 * This will allow us to catch fatal errors
		*/
		register_shutdown_function(function($panda){
			$error = error_get_last();

			if(($error !== null) && ($error['type'] == E_ERROR)){
				$exception = new ExceptionHandler(new ErrorException('<u>Fatal Error</u> ' . $error['message'], 0, $error['type'], $error['file'], $error['line']), $panda);
				$exception->handle();
				$exception->shutdown();				
			}			
		}, $panda);

		ControllerFactory::create($router->getRoute(), $router->isDirectory());

		unset($request, $router);
	} catch (Exception $e) {
		$exception = new ExceptionHandler($e, $panda);
		$exception->handle();
		$exception->shutdown();
	}