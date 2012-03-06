<?php

	/**
	 * ServiceLayer
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	use \Panda\ViewFactory;

	/**
	 * Abstract class for every service layer to give it some simple methods mostly as shortcuts to other parts of the MVC 
	 */
	abstract class ServiceLayer
	{

		/**
		 *
		 * @param string $model
		 * @param string $shared
		 * @param mixed $args
		 * @return object
		 */
		protected function model($model, $shared = false, $args = null)
		{
			if(($args !== null) && (!is_array($args))){
				$args = array($args);
			}

			return Factory::model($model, $shared, $args);
		}

		/**
		 *
		 * @param string $library
		 * @param string $shared
		 * @param mixed $args
		 * @return object
		 */
		protected function library($library, $shared = false, $args = null)
		{
			if(($args !== null) && (!is_array($args))){
				$args = array($args);
			}

			return Factory::library($library, $shared, $args);
		}		

		/**
		 *
		 * @param string $class
		 * @param mixed $args
		 * @return object
		 */
		protected function panda($class, $args=null)
		{
			if(($args !== null) && (!is_array($args))){
				$args = array($args);
			}

			return Factory::panda($class, $args);
		}		

		/**
		 * This is a simple HTTP Redirect, using the header() either 301 or 307
		 * 
		 * @param string $url
		 * @param bool $permanently 
		 */
		protected function redirect($url, $permanently = true)
		{
			if ($permanently) {
				header("HTTP/1.1 301 Moved Permanently");
			} else {
				header("HTTP/1.1 307 Temporary Redirect");
			}

			header('Location: ' . $url);
			exit;
		}

		/**
		 * This routes within the framework, it will not show to the enduser 
		 * 
		 * @param array $route
		 * @param bool $directory 
		 */
		protected function route(array $route = null, $directory = false)
		{
			return ControllerFactory::create($route, $directory);
		}

		/**
		 * Used as a shortcut to load a view
		 *
		 * @param string $name
		 * @param array $args
		 * @param bool $shared
		 * @param bool $static 
		 */
		protected function view($name, array $args = null, $shared = false, $static = false)
		{
			return ViewFactory::getInstance()->addView($name, $args, $shared, $static);
		}

		/**
		 * Renders all views
		 * 
		 * @param bool $cache
		 * @param bool $xssfilter
		 * @param array $headers
		 * @return bool
		 */
		protected function render($cache = false, $xssfilter = true, array $headers = null)
		{
			return ViewFactory::getInstance()->render($cache, $xssfilter, $headers);
		}

	}