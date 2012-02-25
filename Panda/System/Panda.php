<?php

	/**
	 * Panda
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	use \stdClass;
	use \Panda\System\Exceptions\ClassNotFoundException;

	/**
	 * Panda class used as a registry store configuration options for the Framework
	 */
	class Panda extends Registry
	{

		private static $_instance;

		/**
		 * Okay lets assign the configuration within our Panda registry
		 * 
		 * @param array $configuration 
		 */
		private function __construct(array $configuration, $phpunit=false)
		{
			$this->registry = ( object ) $configuration;

			if($phpunit){
				spl_autoload_register(array($this, '_autoloader'), true);
			}else{
				spl_autoload_register(array($this, '_autoloader'), true, true);
			}
			
		}

		/**
		 * Well we dont want multiple configurations, so singleton class is the solution !
		 * 
		 * @static
		 * @param array $configuration
		 * @return Panda 
		 */
		public static function getInstance(array $configuration = null, $phpunit=false)
		{
			if (!self::$_instance instanceof self) {
				self::$_instance = new self($configuration, $phpunit);
			}

			return self::$_instance;
		}

		/**
		 * autoloader method for loading classes and such
		 * 
		 * @param type $class
		 * @return type
		 * @throws ClassNotFoundException 
		 */
		private function _autoloader($class)
		{
			// Reverse namespace into a file path
			$file = $this->registry->root . str_replace('\\', '/', $class) . '.php';
			$applicationFile = $this->registry->root . $this->registry->application . '/' . str_replace('\\', '/', $class) . '.php';

			// Could use is_readable() although its twice as slow... and really its not likely PHP wont be able to read it
			if (file_exists($file)) {
				return require_once $file;
			}

			if (file_exists($applicationFile)) {
				return require_once $applicationFile;
			}

			throw new ClassNotFoundException('Could not find class: ' . $class . ' Resolved file path: ' . $file);
		}

		/**
		 * This will merge the Application within the main registry within Panda
		 */
		public function loadApplicationConfig()
		{
			$this->registry = ( object ) array_merge(( array ) $this->registry, ( array ) include($this->registry->root . $this->registry->application . '/AppConfig.php'));
		}

	}