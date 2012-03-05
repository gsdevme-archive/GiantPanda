<?php

	namespace Controllers;

	class Home extends Controller
	{
		
		public function index()
		{
			$githubFeed = $this->library('rss')->get('https://github.com/gsdevme/GiantPanda/commits/develop.atom', 'entry');

			$this->view('home', array(
				'feed' => $githubFeed
			))->render(false, false);
		}
	
	}