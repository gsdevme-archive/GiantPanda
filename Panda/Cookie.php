<?php

	/**
	 * Cookie
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda;

	/**
	 * Simple facade around cookie functions
	 */
	class Cookie
	{

		/**
		 * Wraps around setcookie
		 * 
		 * @param string $name   
		 * @param string $value          
		 * @param string $expire=null 
		 * @param string $path='/' 
		 * @param string $domain 
		 * @param bool $secure 
		 * @param bool $httponly 
		 * @return bool
		 */
		public static function set($name, $value, $expire = 0 , $path='/', $domain=null, $secure = false, $httponly = false)
		{
			return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
		}

		/**
		 * Reads the global $_COOKIE
		 * 
		 * @param string $name  
		 * @return mixed
		 */
		public static function get($name)
		{
			return (isset($_COOKIE[$name])) ? $_COOKIE[$name] : null;
		}
	}
