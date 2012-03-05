<?php

	namespace Controllers;

	class Home extends Controller
	{
		
		public function index()
		{
			// Do we have some file cache ?
			if((!$githubFeed = $this->panda('file')->get('feed'))){
				// Lets get the RSS feed
				$githubFeed = $this->library('rss')->get('https://github.com/gsdevme/GiantPanda/commits/develop.atom', 'entry');

				// Lets cache the RSS feed now for 1 hour
				$this->panda('file')->set('feed', $githubFeed, 3600);
			}
			
			$this->view('home', array(
				'feed' => $githubFeed
			))->render(false, false);

			$this->panda('file')->get('feed');
		}
	
	}