<?php

	namespace Controllers;

	class Home extends Controller
	{
		
		public function index()
		{

			echo '<pre>' . print_r($this->model('test'), true) . '</pre>';
			echo '<pre>' . print_r(\Panda\System\Panda::getInstance(), true) . '</pre>';
		}

		public function test()
		{
			echo 'hello';
		}
	
	}