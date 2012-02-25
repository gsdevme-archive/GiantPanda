<?php

	namespace Controllers;

	class Home extends Controller
	{
		
		public function index()
		{
			$this->view('home', array('foo' => 1))->render(true);
		}
	
	}