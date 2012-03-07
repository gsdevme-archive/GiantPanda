<?php

	/**
	 * ViewFactory
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	use \Panda\System\Exceptions\ViewException;
	use \Panda\View;
	use \SplFileObject;

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
			// File location, changes based on shared or static
			$file = $this->panda->root . (($shared === false) ? $this->panda->application . '/Views/' : 'Shared/Views/') . $view . (($static === false) ? '.php' : '.html');

			if (file_exists($file)) {
				// Create a checksum of the file & build an object to store
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
		 * @param bool $simpleMinify
		 * @return bool
		 * @throws ViewException 
		 */
		public function render($cache = false, $xssfilter = true, array $headers = null, $simpleMinify = false)
		{
			if (!empty($this->views)) {
				if ($headers !== null) {
					foreach (( array ) $headers as $header) {
						header($header);
					}
				}

				if ($cache !== false) {
					// Create checksum based on argument data & views
					$checksum = sprintf('%u', crc32(serialize($this->views)));
					header('ETag: ' . $checksum);

					// Cache file location
					$cacheFile = $this->panda->root . $this->panda->application . '/ViewCache/' . $checksum . '.html';
					$readable = ( bool ) is_readable($cacheFile);

					// Check if the user already has it
					if (($readable) && (isset($_SERVER['HTTP_IF_NONE_MATCH'])) && ($_SERVER['HTTP_IF_NONE_MATCH'] == $checksum)) {
						header("HTTP/1.1 304 Not Modified");
						return;
					}

					// Check if we have a cached HTML
					if ($readable) {
						// Start buffer output, just incase we need to capture any errors
						ob_start();

						require $cacheFile;
						return;
					}

					$appRoot = $this->panda->root . $this->panda->application . '/';

					ob_start(function($buffer) use ($appRoot, $checksum, $cacheFile) {
							// Check can we create a cached HTML
							if (!is_writable($appRoot . 'ViewCache')) {
								// Change the ETag so the user isn't stuck with a broken page
								header('ETag: ' . 'error');

								// Since we cant throw within an ob_start, its best to just return a simple error                                
								return 'ViewCache folder is not writeable, make sure you have a ViewCache folder within your application root ' . $appRoot . 'ViewCache';
							}

							// Minify
							$minify = new Minify($buffer);
							$buffer = $minify->process();

							//Write File
							$file = new SplFileObject($cacheFile, 'w');
							$file->fwrite($buffer);
							return $buffer;
						}, 0, true);
				} elseif ($simpleMinify !== false) {
					ob_start(function($buffer) {
							// This regex was taken from http://stackoverflow.com/questions/5312349/minifying-final-html-output-using-regular-expressions-with-codeigniter
							return preg_replace('/<!--(.*?)-->/', null, preg_replace('#(?ix)(?>[^\S ]\s*|\s{2,})(?=(?:(?:[^<]++|<(?!/?(?:textarea|pre)\b))*+)(?:<(?>textarea|pre)\b|\z))#', null, $buffer));
						});
				} else {
					ob_start();
				}

				// Load each view
				foreach ($this->views as $view) {
					new View($this->panda, $view->file, $view->args, $xssfilter);
				}

				return true;
			}

			throw new ViewException('No views where found, make sure you use $this->view() before $this->render()', null, null, 500);
		}

	}