<?php

	namespace System\Panda;

	/**
	 * Request class, handles the HTTP or CLI request
	 */
	class Request
	{

		private $_panda, $_request, $_application;

		/**
		 *
		 * @param Panda $panda 
		 */
		public function __construct(Panda $panda)
		{
			$this->_panda = $panda;

			$this->_application = null;
			$this->_request = null;
		}

		/**
		 * Handles the HTTP Request
		 * 
		 * @return bool 
		 */
		public function handleRequest()
		{
			// If we are in a console environment
			if ((defined('PHP_SAPI')) && (PHP_SAPI === 'cli')) {
				return $this->_commandRequest();
			}

			return $this->_webRequest();
		}

		/**
		 * Http Detection for the Request
		 * http://Application/index.php/controller/method/args
		 */
		private function _webRequest()
		{
			// Get HTTP Reuqest
			$request = substr(str_replace($this->_panda->file, null, $this->_panda->request), 1);

			// Remove '/' Prefix
			if (substr($request, 0, 1) == '/') {
				$request = substr($request, 1);
			}

			// Remove '/' Suffix
			if (substr($request, strlen($request) - 1, 1) == '/') {
				$request = substr($request, 0, strlen($request) - 1);
			}

			$this->_request = $request;

			// If the http_host is not an IP address
			if (!filter_var($this->_panda->host, FILTER_VALIDATE_IP)) {
				// Main purpose to this is to avoid runnig preg_replace if we dont have to, as its pretty slow, so if the alpha numberic check comes back ok we can avoid it
				$application = str_replace(' ', null, ucwords(str_replace(array('.'), ' ', ucwords($this->_panda->host))));
				$application = (!ctype_alnum($application)) ? str_replace(' ', null, ucwords(preg_replace("/[^A-Z0-9]+/i", ' ', $application))) : $application;

				// Ensure the first letter is valid as a folder name
				if (ord(substr($application, 0, 1)) < 65) {
					$this->_application = $application;
				}
			}
		}

		/**
		 * CLI Detection for the Request
		 * php -f index.php controller/method/args Application
		 */
		private function _commandRequest()
		{
			if (isset($_SERVER['argv'][1])) {
				$this->_request = $_SERVER['argv'][1];
			}

			if (isset($_SERVER['argv'][2])) {
				$this->_application = $_SERVER['argv'][2];
			}
		}

		/**
		 * @return String
		 */
		public function getApplication()
		{
			return $this->_application;
		}

		/**
		 * @return String
		 */
		public function getRequest()
		{
			return $this->_request;
		}

	}