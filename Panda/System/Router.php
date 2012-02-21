<?php

	namespace Panda\System;

	use \SplFixedArray;

	class Router
	{

		private $_request, $_panda;

		public function __construct(Request $request, Panda $panda)
		{
			$this->_request = $request;
			$this->_panda = $panda;

			// Get application name
			$application = $this->_request->getApplication();

			// If application directory exists
			if (($application !== null) && (is_dir($this->_panda->root . $this->_request->getApplication()))) {
				$this->_panda->application = $this->_request->getApplication();
			}

			// Loads of the application configuration into the Panda registry
			$this->_panda->loadApplicationConfig();
		}

		public function getRoute()
		{
			// If there is a request, explode into array based upon slash, else load default controller/method
			$route = ( array ) (($this->_request->getRequest()) ? explode('/', $this->_request->getRequest()) : array($this->_panda->defaultController, $this->_panda->defaultMethod));

			// Check if the first is a folder and not a controller
			if (is_dir($this->_panda->root . $this->_panda->application . '/Controllers/' . ucfirst($route[0]))) {
				// If we dont have a controller defined
				if (count($route) == 1) {
					array_push($route, $this->_panda->defaultController);
				}

				// If we dont have a method defined
				if (count($route) == 2) {
					array_push($route, $this->_panda->defaultMethod);
				}
			}

			// If we dont have a mrthod defined
			if (count($route) == 1) {
				array_push($route, $this->_panda->defaultMethod);
			}

			return $route;
		}

	}