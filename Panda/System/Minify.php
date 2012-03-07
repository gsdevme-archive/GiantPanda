<?php

	/**
	 * Model
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

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
		 * Creates a new instance and passes the raw html to the object
		 *
		 * @param string $html 
		 */
		public function __construct($html)
		{
			$this->_minifyHtml = new MinifyHTML($html);
		}

		/**
		 * Returns the minified string
		 *
		 * @return string
		 */
		public function process()
		{
			return $this->_minifyHtml->process();
		}

	}

	