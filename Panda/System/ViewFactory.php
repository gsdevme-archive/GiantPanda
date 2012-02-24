<?php

	/**
	 * ViewFactory
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */	

	namespace Panda\System;

	use \Panda\System\Exceptions\ViewException;

	abstract class ViewFactory
	{

		protected static $instance;
		protected $views, $view;

		public static function getInstance()
		{
			if (!static::$instance instanceof static) {
				static::$instance = new static;
			}

			return static::$instance;
		}

		public function addView($view, array $args = null, $shared = false, $static = false)
		{
			$file = (($shared === false) ? 'Views/' : 'Shared/Views/') . $view . (($static === false) ? '.php' : '.html');

			if(file_exists($file)){
				$this->view = sprintf('%u', crc32($file));
				$this->views[$this->view] = ( object ) array('file' => $file, 'args' => $args, 'name' => $view);

				return self::$instance;
			}

			throw new ViewException('Could not find ' . $view . ' View, resolved path ' . $file, null, null, 500);
		}

	}