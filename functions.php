<?php

	/**
	 * Functions
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */	

	/**
     * This function adds the purposed language construct detailed here
     * https://wiki.php.net/rfc/ifsetor
     * 
     * @param mixed $value
     * @param mixed $or
     * @return mixed 
     */
	function ifsetor(&$value, $or=null)
	{
		return (isset($value)) ? $value : $or;
	}	

	/**
	 * Detects if its HTTP or CLI
	 *
	 * @return bool
	*/
	function isCli()
	{
		return (bool)((defined('PHP_SAPI')) && (PHP_SAPI === 'cli'));
	}