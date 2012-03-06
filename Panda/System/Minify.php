<?php

	namespace Panda\System;

	require_once realpath(dirname(__FILE__)) . '/ThirdParty/MinifyHTML.php';

	use \MinifyHTML;

	/**
	 * Simple facade class around the minify class found on google apps
	 */
	class Minify
	{

		private $_minifyHtml;

		/**
		 *
		 * @param type $html 
		 */
		public function __construct($html)
		{
			$this->_minifyHtml = new MinifyHTML($html);
		}

		/**
		 *
		 * @return type 
		 */
		public function process()
		{
			return $this->_minifyHtml->process();
		}

	}

	