<?php

class secure{
	// cipher Method
	private static $ciphering = "aes-256-cbc-hmac-sha256";
	//It holds the bitwise disjunction of the flags OPENSSL_RAW_DATA and OPENSSL_ZERO_PADDING. 
	private static $options = 0;
	//It holds the encryption key.
	private static $decryption_encryption_key = "Any secrete key";
	// Non-NULL Initialization Vector for encryption 
	private static $decryption_encryption_iv = '1234567891011121'; 

	public static function encrypt($data){
		static $encrypt;

		$encryption = openssl_encrypt($data, self::$ciphering, self::$decryption_encryption_key, self::$options, self::$decryption_encryption_iv);

		$encrypt = base64_encode($encryption);

		return $encrypt;
	}

	public static function decrypt($encryptData){
		static $decrypt;
		$data_rand = base64_decode($encryptData);

		$decrypt = openssl_decrypt ($data_rand, self::$ciphering, self::$decryption_encryption_key, self::$options, self::$decryption_encryption_iv); 

		return $decrypt;
	} 
}

?>