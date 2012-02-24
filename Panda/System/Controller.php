<?php

	/**
	 * Controller
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */	

	namespace Panda\System;

	abstract class Controller
	{
		
		/**
		 * This is a simple HTTP Redirect, using the header() either 301 or 307
		 * 
		 * @param string $url
		 * @param bool $permanently 
		 */
		protected function redirect($url, $permanently=true)
		{
			if($permanently){
				header("HTTP/1.1 301 Moved Permanently"); 
			}else{
				header("HTTP/1.1 307 Temporary Redirect"); 
			}

			 header ('Location: '. $url);
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
		protected function close($memory=null, $seconds=null)
		{
			if($memory !== null){
				ini_set('memory_limit', $memory);
			}
			
			if($seconds !== null){
				set_time_limit($seconds);
			}
			
			$size = ob_get_length();

			header("Content-Length: $size");
			header('Connection: close');

			// Abit nasty but its all required :(
			try{ob_end_flush();}catch(Exception $e){}
			try{ob_flush();}catch(Exception $e){}
			try{flush();}catch(Exception $e){}
			try{session_write_close();}catch(Exception $e){} 		
		}

		/**
		 * This routes within the framework, it will not show to the enduser 
		 * 
		 * @param array $route
		 * @param bool $directory 
		 */
		protected function route(array $route=null, $directory=false)
		{
			return ControllerFactory::create($route, $directory);
		}
	}