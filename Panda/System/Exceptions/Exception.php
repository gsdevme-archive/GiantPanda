<?php

	namespace Panda\System\Exceptions;

	abstract class Exception extends \Exception
	{
		
		private $_pandaCode;

		public function __construct($message, $code=null, \Exception $e=null, $pandaCode=500)
		{
			$this->_pandaCode = $pandaCode;

			parent::__construct($message, $code, $e);
			
		}

		public function getPandaCode()
		{
			return $this->_pandaCode;
		}
	}