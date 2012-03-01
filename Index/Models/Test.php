<?php

	namespace Models;
	
	class Test extends Model
	{
		
		public function __construct()
		{
			echo '<pre>' . print_r(array(__CLASS__, __METHOD__), 1) . '</pre>';
		}
	}