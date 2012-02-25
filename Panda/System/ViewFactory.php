<?php

	/**
	 * ViewFactory
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */	

	namespace Panda\System;

	use \Panda\System\Exceptions\ViewException;
	use \Panda\View;

	/**
	 * Abstract ViewFactory Class, this holds all the views file, arguments, name and if its static or not
	*/
	abstract class ViewFactory
	{

		protected static $instance;
		protected $views, $view, $panda;

		/**
		 * 
		 */
		private function __construct()
		{
			$this->views = array();
			$this->panda = Panda::getInstance();
		}

		/**
		 * @static
		 * @return ViewFactory 
		 */
		public static function getInstance()
		{
			if (!static::$instance instanceof static) {
				static::$instance = new static;
			}

			return static::$instance;
		}

		/**
		 *
		 * @param string $view
		 * @param array $args
		 * @param bool $shared
		 * @param bool $static
		 * @return ViewFactory
		 * @throws ViewException 
		 */
		public function addView($view, array $args = null, $shared = false, $static = false)
		{
			$file = $this->panda->root . $this->panda->application . (($shared === false) ? '/Views/' : '/Shared/Views/') . $view . (($static === false) ? '.php' : '.html');

			if(file_exists($file)) {
				$this->view = sprintf('%u', crc32($file));
				$this->views[$this->view] = ( object ) array('file' => $file, 'args' => $args, 'name' => $view, 'static' => $static);

				return self::$instance;
			}

			throw new ViewException('Could not find ' . $view . ' View, resolved path ' . $file, null, null, 500);
		}

		/**
		 *
		 * @param bool $cache
		 * @param bool $xssfilter
		 * @param array $headers
		 * @return bool
		 * @throws ViewException 
		 */
		public function render($cache = false, $xssfilter = true, array $headers = null)
		{
			if (!empty($this->views)) {
				if ($headers !== null) {
                    foreach ((array)$headers as $header) {
                        header($header);
                    }
                }

                ob_start();

                // Load each view
                foreach ($this->views as $view) {
                    new View($this->panda, $view->file, $view->args, $xssfilter);
                }

                return true;       
			}

			throw new ViewException('No views where found, make sure you use $this->view() before $this->render()', null, null, 500);
		}

	}