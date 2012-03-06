<?php

	namespace Libraries;

	class Dummy
	{

		public function __construct()
		{
			echo '<pre>' . print_r(__METHOD__, true) . '</pre>';
		}
	}