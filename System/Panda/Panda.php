<?php

	namespace System\Panda;

	use \stdClass;
	use \System\Exceptions\ClassNotFoundException;

	/**
	 * Singleton Class for the configuration of the MVC
	 */
	class Panda
	{
		
		private static $_instance;	

		/**
		 * Okay lets assign the configuration within our Panda registry
		 * 
		 * @param array $configuration 
		 */
		private function __construct(array $configuration)
		{
			$this->registry = (object)$configuration;
		}		

		/**
		 * Well we dont want multiple configurations, so singleton class is the solution !
		 * 
		 * @static
		 * @param array $configuration
		 * @return Panda 
		 */
		public static function getInstance(array $configuration)
		{
			if(!self::$_instance instanceof self){
				self::$_instance = new self($configuration);
			}

			return self::$_instance;
		}

		/**
		 *
		 * @return Panda 
		 */
		public function registerAutoloader()
		{
			spl_autoload_register(array($this, '_autoloader'), true, true);	
			
			return self::$_instance;		
		}

		/**
		 *
		 * @param string $class
		 * @return bool
		 */
		private function _autoloader($class)
		{
			$file = $this->registry->root . str_replace('\\', '/', $class) . '.php';
			 
			if(is_readable($file)){
				return require_once $file;
			}

			throw new ClassNotFoundException('Could not find class: ' . $class . ' Resolved file path: ' . $file);			
		}
	}