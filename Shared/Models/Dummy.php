<?php

	namespace Models;

	class Dummy extends Model
	{

		public function myMethod()
		{
			echo 'Shared Model Called:<pre>' . print_r(__METHOD__, true) . '</pre>';
		}
	}