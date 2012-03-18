<?php

	namespace Panda;

	interface iDb
	{
		public static function getInstance();

		public function query();
	}