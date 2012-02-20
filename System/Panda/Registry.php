<?php

	namespace System\Panda;

	abstract class Registry
	{

		protected $registry;

		public function __get($name)
		{
			return ($this->registry->$name) ? $this->registry->$name : null;
		}

		public function __set($name, $value)
		{
			return $this->registry->$name = $value;
		}

		public function __isset($name)
		{
			return isset($this->registry->$name);
		}
	}