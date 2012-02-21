<?php

	require_once realpath(dirname(__FILE__)) . '/../../bootstrap.php';
	
	use \Panda\System\Panda;
	
	class PandaTest extends UnitTestCase
	{
		
		private $_panda;
		
		public function setUp()
		{
			$this->_panda = Panda::getInstance();
		}
		
		public function testPandaInstance()
		{					
			$this->assertTrue(($this->_panda instanceof \Panda\System\Panda));
		}
			
	}
	