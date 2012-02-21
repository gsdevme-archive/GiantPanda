<?php

	require_once realpath(dirname(__FILE__)) . '/../../bootstrap.php';
	
	use \System\Panda\Request;
	use \System\Panda\Panda;
	
	class RequestTest extends UnitTestCase
	{
		
		private $_panda;
		
		public function setUp()
		{
			$this->_panda = Panda::getInstance();
			
			$_SERVER['argv'] = array();
			$_SERVER['argv'][1] = 'controller/method/args';
			$_SERVER['argv'][2] = 'ExampleCom';
		}
		
		public function testRequestInstance()
		{
			$request = new Request($this->_panda);
					
			$this->assertTrue(($request instanceof System\Panda\Request));
		}
		
		public function testWebRequest()
		{			
			$request = new Request($this->_panda);
			$request->handleRequest();
			
			$this->assertEqual($request->getRequest(), 'test');		
		}
			
	}
	