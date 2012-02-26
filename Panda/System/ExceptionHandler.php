<?php

	/**
	 * ExceptionHandler
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda\System;

	use \Panda\System\Exceptions\Exception;
	use \Panda\System\Panda;
	use \SplFileObject;

	/**
	 *  Exception Handler class, this will handle exceptions and conver them into nice pretty errors with use of the Error View
	 */
	class ExceptionHandler
	{

		private $_exception, $_panda, $_outputArray;

		/**
		 * Set Exception & Panda
		 * 
		 * @param \Exception $e
		 * @param Panda $panda 
		 */
		public function __construct(\Exception $e, Panda $panda)
		{
			$this->_exception = $e;
			$this->_panda = $panda;
			$this->_outputArray = array();
		}

		/**
		 * Clears the buffer, and rebuilds the Exception object into a structure, with a 20 line section of the problem file
		 */
		public function handle()
		{
			$status = ob_get_status(true);

			if (!empty($status)) {
				// Just incase for some reason is doesn't clean
				try {
					ob_end_clean();
					unset($status);
				} catch (\Exception $e) {
					
				}
			}

			// Rebuild exception into a nice structure
			array_push($this->_outputArray, ( object ) array(
					'class' => substr(get_class($this->_exception), strrpos(get_class($this->_exception), '\\')),
					'message' => $this->_exception->getMessage(),
					'line' => $this->_exception->getLine(),
					'file' => $this->_exception->getFile(),
					'trace' => $this->_exception->getTrace(),
					'htmlFile' => $this->_getPHPLines($this->_exception->getFile(), $this->_exception->getLine()),
			));

			if ($this->_exception->getPrevious() !== null) {
				array_push($this->_outputArray, ( object ) array(
						'class' => substr(get_class($this->_exception), strrpos(get_class($this->_exception), '\\')),
						'message' => $this->_exception->getPrevious()->getMessage(),
						'line' => $this->_exception->getPrevious()->getLine(),
						'file' => $this->_exception->getPrevious()->getFile(),
						'trace' => $this->_exception->getPrevious()->getTrace(),
						'htmlFile' => $this->_getPHPLines($this->_exception->getPrevious()->getFile(), $this->_exception->getPrevious()->getLine()),
				));
			}

			// Build trace
			if ($this->_exception->getTrace() !== null) {
				foreach ($this->_exception->getTrace() as $trace) {
					if (isset($trace['line'], $trace['file'], $trace['args'], $trace['class'], $trace['function'])) {
						array_push($this->_outputArray, ( object ) array(
								'class' => substr($trace['class'], strrpos($trace['class'], '\\')),
								'message' => $trace['function'] . $this->_buildParameters($trace['args']),
								'line' => $trace['line'],
								'file' => $trace['file'],
								'trace' => null,
								'htmlFile' => $this->_getPHPLines($trace['file'], $trace['line']),
						));
					}
				}
			}
		}

		/**
		 * This either calls the debug callback or will load an exception view and kill the script with exit()
		 */
		public function shutdown()
		{
			// If its a console theres just var_dump
			if ((defined('PHP_SAPI')) && (PHP_SAPI === 'cli')) {
				var_dump($this->_exception);
				exit;
			}

			if (!$this->_panda->debug) {
				if (isset($this->_panda->debugCallback)) {
					$callback = $this->_panda->debugCallback;
					return $callback($this->_exception, $this->_panda);
				}
			}

			extract(array('errors' => $this->_outputArray));
			include $this->_panda->root . 'Panda/System/Exceptions/Views/ExceptionHandler.php';

			exit();
		}

		/**
		 * 
		 * 
		 * @param mixed $args
		 * @return string 
		 */
		private function _buildParameters($args)
		{
			array_walk($args, function(&$value, $key) {
					switch (gettype($value)) {
						case 'object':
							$value = get_class($value) . ' Object';
							break;
						case 'array':
							$value = var_export($value, true);
							break;
						case 'NULL':
							$value = 'null';
							break;
						case 'boolean':
							$value = ($value) ? 'true' : 'false';
							break;
						case 'string':
							$value = '"' . $value . '"';
							break;
						default:
							$value = '';
							break;
					}
				});

			return '( ' . implode(', ', $args) . ' )';
		}

		/**
		 * For the file and line number will extract 10 lines before the error and 10 after
		 * 
		 * @param string $file
		 * @param intger $line
		 * @return string 
		 */
		private function _getPHPLines($file, $line)
		{
			$return = null;
			$file = new SplFileObject($file);

			if ($line >= 11) {
				$file->seek($line - 11);
			}

			while (($file->valid()) && ($file->key() <= $line + 9)) {
				if ($file->key() == $line - 1) {
					$return .= '<span style="background:#FF8C69;">' . ($file->key() + 1) . "\t" . htmlspecialchars(htmlentities($file->current(), ENT_QUOTES, 'UTF-8', false), ENT_QUOTES, 'UTF-8', false) . '</span>';
				} else {
					$return .= ($file->key() + 1) . "\t" . htmlspecialchars(htmlentities($file->current(), ENT_QUOTES, 'UTF-8', false), ENT_QUOTES, 'UTF-8', false);
				}


				$file->next();
			}

			return $return;
		}

	}