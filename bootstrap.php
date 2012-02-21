<?php

    /**
     * PHP Bootstrap
     *
     * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
    */

    if(PHP_VERSION_ID < 50303) throw new Exception('Your trying to run me on a PHP version below PHP 5.3.3... how dare you !');  

	// Real programming erors
	set_error_handler(function($errno, $errstr, $errfile, $errline ) {
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    });

	// Disable magic quotes (Lovely magic quotes enabled on the server.... a developers worst nightmare)
	if(get_magic_quotes_gpc()) ini_set('magic_quotes_gpc', 0);
	
	// This is mainly when running under CLI, its better to just NULL them then get undefined index all over the place..
	if(!isset($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'])){
		$_SERVER['REQUEST_URI'] = null;
		$_SERVER['HTTP_HOST'] = null;
	}