<?php
	
	require_once realpath(dirname(__FILE__)) . '/../../bootstrap.php';
	
	use \Panda\System\Request;
	use \Panda\System\Panda;
	
	class RequestTest extends PHPUnit_Framework_TestCase
	{
		
		private $_request;
		
		public function setUp()
		{
			$this->_request = new Request(Panda::getInstance());

			$_SERVER['argv'][1] = 'controller/method/args';
			$_SERVER['argv'][2] = 'Index';
		}
		
		public function testRequestInstance()
		{					
			$this->assertTrue(($this->_request instanceof \Panda\System\Request));
		}

		public function testCommandHandle()
		{
			$this->_request->handleRequest();

			$this->assertTrue(($this->_request->getApplication() == 'Index'));
		}
			
	}
	