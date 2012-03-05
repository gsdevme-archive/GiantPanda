<?php

	namespace Controllers;

	use \Panda\System\Panda;

	class Home extends Controller
	{
		
		public function index()
		{			
			$this->view('home', array(
				'root' => Panda::getInstance()->root,
				'application' => Panda::getInstance()->root . Panda::getInstance()->application . '/',
				'version' => Panda::getInstance()->version,
				'writeable' => is_writeable(Panda::getInstance()->root),
				'user' => get_current_user(),
			))->render(false, false);
		}
	
	}