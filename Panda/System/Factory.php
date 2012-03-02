<?php

	namespace Panda\System;

	use Panda\System\Exceptions\FactoryException;
	use \ReflectionClass;
	use \ReflectionMethod;
	use \Exception;
	use \Panda\System\Exceptions\ClassNotFoundException;

	/**
	 * Factory class, does as the pattern does, it creates objects, model() creates models etc 
	 */
	class Factory
	{

		private static $_panda;

		/**
		 *
		 * @param string $model
		 * @param string $shared
		 * @param array $args
		 * @return \Panda\System\Model
		 * @throws FactoryException 
		 */
		public static function model($model, $shared = false, array $args = null)
		{
			$model = self::_appLoader($model, '\Models\\', $args, $shared);

			if ($model instanceof Model) {
				return $model;
			}

			throw new FactoryException('Failed to load a Model, remember your model must extend the class \Panda\System\Model', 0, null, 500);
		}

		/**
		 *
		 * @param string $class
		 * @param array $args
		 * @return object
		 * @throws FactoryException 
		 */
		public static function panda($class, array $args = null)
		{
			return self::_loader($class, '\Panda\\', $args, false);
		}

		/**
		 *
		 * @param string $name
		 * @param string $namespace
		 * @param array $args
		 * @param bool $shared
		 * @return object 
		 */
		private static function _appLoader($class, $namespace, array $args = null, $shared = false)
		{
			$store = lcfirst(str_replace('\\', null, $namespace));

			// Is it already loaded within the application registry?
			if(($return = self::_registryStore($class, $store))){
				return $return;
			}

			// Get the object
			$object = self::_loader($class, $namespace, $args, $shared);

			// Store within the application registry
			self::_registryStore($class, $store, $object);

			return $object;
		}

		/**
		 *
		 * @param string $name
		 * @param string $namespace
		 * @param array $args
		 * @param bool $shared
		 * @return object 
		 */
		private static function _loader($class, $namespace, array $args = null, $shared = false)
		{
			$class = ucfirst($class);

			try {
				// If its shared the autoloader wont be able to find it, so lets quickly load it
				if ($shared !== false) {
					self::_getSharedFile($namespace . $class);
				}

				$e = null;
				$class = new ReflectionClass($namespace . $class);

				// Can we create an instance of it ?
				if ($class->isInstantiable()) {
					// Are you wanting to send arguments to the contructor?
					if ($args !== null) {
						return $class->newInstanceArgs($args);
					}

					return $class->newInstance();
				}

				// Is it singleton perhaps ? (public static function getInstance)
				$method = new ReflectionMethod($class->name, 'getInstance');

				// Are you wanting to send arguments to the contructor?
				if ($args !== null) {
					$method->invokeArgs(null, $args);
				}

				return $method->invoke(null);
			} catch (ReflectionClass $e) {
				
			} catch (ClassNotFoundException $e) {
				
			}

			throw new FactoryException('Failed to find the class ' . (($class instanceof ReflectionClass) ? $class->name : $class) . ' make sure its within the Panda namespace and has a constructor or getInstance() static method', 0, $e, 500);
		}

		/**
		 * The autoload within Panda will only check within the Root & Application Root, 
		 * therefore any Shared Models and such need to be loaded manually
		 * 
		 * @param string $class
		 * @return bool
		 * @throws ClassNotFoundException 
		 */
		private static function _getSharedFile($class)
		{
			$file = Panda::getInstance()->root . 'Shared/' . str_replace('\\', '/', $class) . '.php';

			if (file_exists($file)) {
				return require_once $file;
			}

			throw new ClassNotFoundException('Could not find class: ' . $class . ' Resolved file path: ' . $file);
		}

		private static function _registryStore($name, $store, $value = false)
		{
			if(!self::$_panda instanceof Panda){
				self::$_panda = Panda::getInstance();
			}	

			if(self::$_panda->appRegistry === true){
				if(is_object($value)){
					return self::$_panda->registry->$store->$name = $value;
				}		

				if(isset(self::$_panda->registry->$store->$name)){
					return self::$_panda->registry->$store->$name;
				}
			}

			return (bool)false;
		}		

	}