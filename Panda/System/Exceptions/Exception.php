<?php
	
	/**
	 * Exception
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */	

	namespace Panda\System\Exceptions;

	/**
	 * Abstract exception for the framework, adds fourth param to the constructor for some kind of HTTP Code 
	 */
	abstract class Exception extends \Exception
	{
		
		private $_pandaCode;

		/**
		 * 
		 * 
		 * @param string $message
		 * @param long $code
		 * @param \Exception $e
		 * @param int $pandaCode 
		 */
		public function __construct($message, $code=null, \Exception $e=null, $pandaCode=500)
		{
			$this->_pandaCode = $pandaCode;

			parent::__construct($message, $code, $e);
			
		}

		/**
		 *
		 * @return int
		 */
		public function getPandaCode()
		{
			return $this->_pandaCode;
		}
	}