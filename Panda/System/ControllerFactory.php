<?php

	namespace Panda\System;

	class ControllerFactory
	{
		
		public static function create(array $route)
		{
			echo '<pre>' . print_r($route, true) . '</pre>';

		}
	}