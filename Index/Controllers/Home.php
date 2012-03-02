<?php

	namespace Controllers;

	class Home extends Controller
	{
		
		public function index()
		{
			$this->view('home')->render();
		}

		public function test()
		{
			echo 'hello';
		}
	
	}