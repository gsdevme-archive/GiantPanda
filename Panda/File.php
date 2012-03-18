<?php

	namespace Panda;

	use \Panda\System\Panda;

	use \RuntimeException;    
	use \Exception;
	use \ErrorException;
	use \GlobIterator;
	use \FilesystemIterator;
	use \SplFileObject;

	class File implements iCache
	{

		private static $_instance;
		private $_path;

		/**
		 * Checks if the value is writeable
		 * @param string $path 
		 */
		private function __construct()
		{
			$panda = Panda::getInstance();
			$this->_path = $panda->root . $panda->application . '/Cache/';

			if (!is_writable($this->_path)) {
				throw new Exception('Cache path is not writeable, Resolved Path: ' . $this->_path);
			}
		}

		public static function getInstance()
		{
			if (!self::$_instance instanceof self) {
				self::$_instance = new self;
			}

			return self::$_instance;
		}

		/**
		 * Sets a value to a cache file
		 * @param mixed $key
		 * @param mixed $data
		 * @param int $time
		 * @return bool 
		 */
		public function set($key, $data, $time)
		{
			try {
				$file = new SplFileObject($this->_path . sprintf('%u', crc32($key)) . '.cache', 'w+');
				$file->fwrite(time() + $time . "\n");
				$file->fwrite(serialize($data));

				return ( bool ) true;
			} catch (RuntimeException $e) {
				throw new Exception('Failed to create cache file', 500, $e);
			}
		}

		/**
		 * Gets a value from cache, also if callback is given will load the callback if cache not found
		 * @param mixed $key
		 * @param closure $callback
		 * @return mixed
		 */
		public function get($key, $callback=null, array $args=null)
		{
			try {
				$crc32key = sprintf('%u', crc32($key));
				$file = new SplFileObject($this->_path . $crc32key . '.cache', 'r');

				if ($file->current() >= time()) {
					$file->next();

					try {
						$data = null;

						for($file;$file->valid();$file->next()){
							$data .= $file->current();
						}

						return unserialize($data);
					} catch (ErrorException $e) {

					}
				}
			} catch (RuntimeException $e) {
				if ($callback !== null) {
					if ($args !== null) {
						array_unshift($args, $key);
					} else {
						$args = array($key);
					}

					return call_user_func_array($callback, $args);
				}
			}

			return null;
		}

		/**
		 * Deletes a certain cache file
		 * @param mixed $key
		 */
		public function delete($key)
		{
			if (file_exists($this->_path . sprintf('%u', crc32($key)) . '.cache')) {
				return ( bool ) unlink($key);
			}

			return ( bool ) false;
		}

		/**
		 * deletes all cache files
		 * @return type 
		 */
		public function flush()
		{
			$glob = new GlobIterator($this->_path . '*.cache', FilesystemIterator::KEY_AS_FILENAME);

			for ($glob; $glob->valid(); $glob->next()) {
				unlink($glob->current());
			}

			return;
		}

	}

	