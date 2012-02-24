<?php

	require_once realpath(dirname(__FILE__)) . '/../../bootstrap.php';
	
	use \Panda\System\Panda;
	
	class PandaTest extends PHPUnit_Framework_TestCase
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

		public function testPandaGetInstance()
		{
			$this->assertTrue((Panda::getInstance() instanceof \Panda\System\Panda));
		}

		public function testRegistry()
		{
			$this->_panda->foo = true;
			$this->assertTrue($this->_panda->foo);
		}

		public function testRegistryIsset()
		{
			$this->assertTrue((isset($this->_panda->foo)));
		}	

		public function testRegistryArray()
		{
			$this->_panda->moo = array(1,1000);
			$this->assertTrue((gettype($this->_panda->moo) == 'array'));
		}			
			
	}
	