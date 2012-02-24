<?php

	/**
	 * View
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	abstract class View
	{

		public function __construct($file, array $args = null, $xssFilter = true)
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

	}