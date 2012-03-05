<?php

	/**
	 * Controller
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	use \Exception;
	use \Panda\ViewFactory;

	/**
	 * Abstract class for every controller to give it some simple methods mostly as shortcuts to other parts of the MVC 
	 */
	abstract class Controller
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
		 * This is used to close the HTTP connection early yet keep open the PHP instance,
		 * this basically allows you render a view while also processing something in the background
		 * 
		 * This might be useful if you need to CURL an API yet its not that important to the end user
		 * 
		 * @param string $memory
		 * @param int $seconds 
		 */
		protected function close($memory = null, $seconds = null)
		{
			if ($memory !== null) {
				ini_set('memory_limit', $memory);
			}

			if ($seconds !== null) {
				set_time_limit($seconds);
			}

			$size = ob_get_length();

			header("Content-Length: $size");
			header('Connection: close');

			// Abit nasty but its all required :(
			try { ob_end_flush(); } catch (Exception $e) { }
			try { ob_flush(); } catch (Exception $e) { }
			try { flush(); } catch (Exception $e) { }
			try { session_write_close(); } catch (Exception $e) { }
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