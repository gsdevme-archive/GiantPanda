<?php

	namespace Controllers;

	class Home extends Controller
	{
		
		public function index()
		{
			$this->view('home');
			$this->render();
		}
	
	}