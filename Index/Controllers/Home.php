<?php

	namespace Controllers;

	class Home extends Controller
	{
		
		public function index()
		{
			$this->view('home', null, true);
		}
	
	}