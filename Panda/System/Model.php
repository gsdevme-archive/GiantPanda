<?php

	/**
	 * Model
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	/**
	 * Abstract class for every model  
	 */
	abstract class Model
	{

		/**
		 * This method is used so we can quickly load & use classes, so if you want to use the database class 
		 * within your model you can do $this->db->query() and it will route it the class 
		 * 
		 * @param string $class
		 * @return mixed
		 */
		public function __get($class)
		{
			return Factory::panda($class);
		}
		
	}