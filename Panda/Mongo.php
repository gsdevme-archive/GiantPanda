<?php

	namespace Panda;

	use Panda\System\Panda;

	class Mongo
	{

		private static $_instance;

		private function __construct()
		{

		}

		public static function getInstance($server='mongodb://localhost:27017', array $options=null)
		{
			if (!self::$_instance instanceof \Mongo) {
				self::$_instance = new \Mongo($server, $options);
			}

			return self::$_instance;
		}

	}