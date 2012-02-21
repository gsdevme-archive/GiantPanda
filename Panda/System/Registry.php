<?php

	namespace Panda\System;

	/**
	 * @abstract
	 * Registry class, which provides methods for getting, settings and isseting registry values
	 */
	abstract class Registry
	{

		protected $registry;

		/**
		 *
		 * @param string $name
		 * @return mixed 
		 */
		public function __get($name)
		{
			return ($this->registry->$name) ? $this->registry->$name : null;
		}

		/**
		 *
		 * @param string $name
		 * @param mixed $value
		 * @return bool 
		 */
		public function __set($name, $value)
		{
			return $this->registry->$name = $value;
		}

		/**
		 *
		 * @param string $name
		 * @return bool 
		 */
		public function __isset($name)
		{
			return isset($this->registry->$name);
		}

	}