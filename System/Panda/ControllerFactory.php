<?php

	namespace System\Panda;

	class ControllerFactory
	{
		
		public static function create(array $route)
		{
			echo '<pre>' . print_r($route, true) . '</pre>';

		}
	}