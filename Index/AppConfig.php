<?php

	return array(
		'debug' => (bool)true,
		'debugCallback' => (function($errors, $panda){
			echo 'Your Error Here :), perhaps call a Error Controller ?';	
			exit;		
		}),

		'defaultController' => 'Home',
		'defaultMethod' => 'index',

		'appRegistry' => (bool)true,
	);