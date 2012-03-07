<?php

	/**
	 * Cryptography
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 */

	namespace Panda;

	use \ErrorException;

	/**
	 * Simple cryptography class, this requires MCRYPT and uses BlowFish
	 */
	class Cryptography
	{
		/**
		 * This will contain any errors which occour during encryption or decrption
		 * @var string
		 */
		public static $error;

		/**
		 * This will use BlowFish encryption to convert your value
		 * You can either pass a public key or let it create one
		 * 
		 * @param string $privateKey     
		 * @param string $value          
		 * @param string $publicKey=null 
		 * @return object, {publicKey: NaN, value: NaN}
		 */
		public static function encrypt($privateKey, $value, $publicKey=null)
		{
			try{
				if($publicKey===null){
					$publicKey = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC), MCRYPT_DEV_RANDOM);	
				}

				return (object)array(
					'publicKey' => $publicKey,
					'value' => mcrypt_encrypt(MCRYPT_BLOWFISH, $privateKey, $value, MCRYPT_MODE_CBC, $publicKey)
				);				
			}catch(ErrorException $e){
				self::$error = $e->getMessage();
			}

			return (bool)false;
		}

		/**
		 * Decrypt will decrypt a Blowfish encrypted string, you must private both Private & Public keys
		 * 
		 * @param string $privateKey
		 * @param string $publicKey
		 * @param string $data
		 * @return string
		 */
		public static function decrypt($privateKey, $publicKey, $data)
		{
			try{
				return mcrypt_decrypt(MCRYPT_BLOWFISH, $privateKey, $data, MCRYPT_MODE_CBC, $publicKey);
			}catch(ErrorException $e){
				self::$error = $e->getMessage();
			}

			return (bool)false;
		}
	}