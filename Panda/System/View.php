<?php

	/**
	 * View
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	use \Panda\System\Exceptions\ViewException;	

	/**
	 * Abstract View Class For every view a view object will be created which allows the data to be filtered for XSS attacks, 
	 * it also provides it with methods such as the element() method
	*/
	abstract class View
	{

		protected $args, $panda;

		/**
		 * View class is set with the file and arguments it requires
		 * @param string $file
		 * @param array $args
		 * @param bool $xssFilter
		 */
		public function __construct(Panda $panda, $file, array $args = null, $xssFilter = true)
		{
			$this->panda = $panda;

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

					// Walk through the array and apply the XSS Filter
					array_walk($args, $recursiveFilter, $recursiveFilter);
				}

				$this->args = $args;

				extract($this->args);
			}

			require $file;
		}

		/**
		 * This will load an element within the view
		 * 
		 * @param string $name
		 * @param bool $shared
		 * @param array $args
		 * @param bool $static 
		 */
		public function element($name, $shared = false, array $args=null, $static = false)
		{
			$file = $this->panda->root . (($shared === false) ? $this->panda->application : 'Shared' ) . '/Elements/' . $name . (($static !== false) ? '.html' : '.php');

			if($args !== null) {
				if($this->args !== null){
					extract($this->args);
				}
			}

			if(file_exists($file)) {
				return require $file;
			}

			throw new ViewException('Could not find ' . $name . ' Element, resolved path ' . $file, null, null, 500);
		}

	}