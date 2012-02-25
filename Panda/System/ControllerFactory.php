<?php

	/**
	 * ControllerFactory
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	use \ReflectionClass;
	use \ReflectionMethod;
	use \ReflectionException;
	use \Panda\System\Exceptions\RouterException;
	use \Panda\System\Exceptions\ClassNotFoundException;

	class ControllerFactory
	{

		/**
		 *
		 * @static
		 * @param array $route
		 * @param bool $isDirectory
		 * @return object
		 * @throws RouterException 
		 */
		public static function create(array $route, $isDirectory = false)
		{
			// setup namespace for controller, this might depend if the controller is within a directory
			$namespace = ($isDirectory !== false) ? '\Controllers\\' . ucfirst(urldecode(array_shift($route))) . '\\' : '\Controllers\\';

			// Lets get our controller name and pop the namespace onto it
			$controller = $namespace . ucfirst(urldecode(array_shift($route)));

			try {
				// Create reflection class for our controller
				$class = new ReflectionClass($controller);

				// Create reflection method for our method
				$method = new ReflectionMethod($controller, urldecode(array_shift($route)));
			} catch (ClassNotFoundException $e) {
				throw new RouterException('Failed to create an instance of the controller/method', null, $e, 404);
			}

			// Lets check our Method is public and our class is instantiable :)
			if (($method->isPublic()) && ($class->isInstantiable())) {
				// Get Panda instance
				$panda = Panda::getInstance();

				// Store Controller Namespace, Controller and Method Name
				$panda->controllerNS = $class->getNamespaceName();
				$panda->controller = str_replace($class->getNamespaceName() . '\\', null, $class->getName());
				$panda->method = $method->getName();

				// is there any arguments ?					
				if ((count($route) == 0) && ($method->getNumberOfRequiredParameters() == 0)) {
					return $method->invoke($class->newInstance(), null);
				}

				// are we sending the correct amount of parameters ?
				if (count($route) >= $method->getNumberOfRequiredParameters()) {
					// Walk the array through URLDecode
					array_walk($route, (function(&$value, &$key) {
							$value = urldecode($value);
						}));

					return $method->invokeArgs($class->newInstance(), $route);
				}

				throw new RouterException('The controller method was not sent the correct amount of parameters', null, null, 404);
			}

			throw new RouterException('The method is either not public or the class is not isInstantiable', null, null, 404);
		}

	}