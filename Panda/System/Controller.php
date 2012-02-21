<?php

	/**
	 * Controller
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */	

	namespace Panda\System;

	abstract class Controller
	{
		
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

		protected function route()
		{
			
		}
	}