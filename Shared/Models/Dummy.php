<?php

	namespace Models;

	class Dummy extends Model
	{

		public function __construct()
		{
			echo '<pre>' . print_r(__METHOD__, true) . '</pre>';
		}
	}