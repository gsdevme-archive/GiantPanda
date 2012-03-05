<?php

	return array(
		/**
		 * Debug: This simple enables and disables debugging through the framework, you should leave this turned on
		 * while developing your application, once you have developed it make sure you customize the debugCallback as 
		 * it is called when an error occours instead of debugging. 
		 */
		'debug' => (bool)true,
		
		/**
		 * debugCallback: Called upon an error when debug is disabled, perhaps make it call a controller ? or maybe load 
		 * some HTML with a 404 or 500 error... who know's its upto you 
		 */
		'debugCallback' => (function($errors, $panda){
			echo 'Your Error Here :), perhaps call an Error Controller ?';	
			exit;

			// Something like this perhaps?
			//\Panda\System\ControllerFactory::create(array('home', 'test'));					
		}),
			
		/**
		 * If the requqest is null, or perhaps they are visiting the root of your website what controller should we call ? 
		 */
		'defaultController' => 'Home',
			
		/**
		 * When only the controller is given whats the default method ? say you visit example.com/home what method is that ?
		 * Setting index would mean example.com/home == example.com/home/index 
		 */
		'defaultMethod' => 'index',

		/**
		 * Do you want the framework to use a registry store for models, serviceLayers and libraries 
		 * 
		 * So when you call $this->model() within your controller is that storing the instance or is it just returning
		 * 
		 * For most cases you never really need more then 1 instance of a model, so you generally should leave appRegistry enabled		 * 
		 * This way you can chain it up like this
		 * 
		 * $this->model('Users')->getUser('mike');
		 * $this->model('Users')->deleteUser('bob');
		 * 
		 * If enabled the example above would have the users constructor called once
		 * 
		 * If you have it disabled then your going to have to do
		 * 
		 * $model = $this->model('Users');
		 * $model->getUser('mike');
		 * $model->deleteUser('bob'); 
		 * 
		 * You could also do, giving you direct access instead of using the shortcut $this->model()
		 * 
		 * use \Panda\System\Factory;
		 * 
		 * $model = Factory::model('Users');
		 */
		'appRegistry' => (bool)true,

		/**
		 * Some example rewrites
		 */
		/*'rewrites' => array(
		    'pattern' => array(
		        '/^profile\/(.*?)/i',
		        '/^news\/(.*?)\/([0-9]{1,11}$)/i',
		        '/^topic\/(.*?)\/([0-9]{1,11}$)/i',
		    ),
		    'replacement' => array(
		        'profile/index/$1',
		        'news/article/$1/$2',
		        'news/topic/$1/$2',
		    ),
		)*/		
	);