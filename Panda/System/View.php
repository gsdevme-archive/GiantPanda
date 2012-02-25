<?php

	/**
	 * View
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	/**
	 * Abstract Class For every view you a view object will be created which allows the data to be filtered for XSS attacks, 
	 * it also provides it with methods such as the element() method
	*/
	abstract class View
	{

		protected $args;

		/**
		 * View class is set with the file and arguments it requires
		 * @param string $file
		 * @param array $args
		 * @param bool $xssFilter
		 */
		public function __construct(Panda $panda, $file, array $args = null, $xssFilter = true)
		{
			if ($args !== null) {
				if ($xssFilter === true) {
					$recursiveFilter = function(&$value, $key, $recursiveFilter) {
							switch (gettype($value)) {
								case "object":
								case "array":
									array_walk($value, $recursiveFilter, $recursiveFilter);
									break;
								case "string":
									$value = ( string ) htmlspecialchars(htmlentities(trim(($value)), ENT_QUOTES, 'UTF-8', false), ENT_QUOTES, 'UTF-8', false);
									break;
								case "bool":
									$value = ( bool ) $value;
									break;
								default:
									// Do nothing, as we dont know whats going on
									break;
							}
						};

					array_walk($args, $recursiveFilter, $recursiveFilter);
				}

				$this->args = $args;

				extract($this->args);
			}

			require $file;
		}

		public function element($name, array $args=null, $shared = false)
		{

		}

	}