<?php

class TokenProvider {

	private $token;
	private $tokenDuration; 

	public function __construct($tokenDuration = 300)
	{
		$this->tokenDuration = $tokenDuration;

		if (!isset($_SESSION["CSRFixerToken"]) && 
			!isset($_SESSION["CSRFixerTokenExpiration"]))
		{
			$secret = $this->generateSecret();
			$this->token = $this->constructToken($secret);
		}
		else
			$this->token = $this->findToken();
	}

	public function getToken()
	{
		return $this->token;
	}

	public function generateNewToken()
	{
		unset($_SESSION["CSRFixerToken"]);
		unset($_SESSION["CSRFixerTokenExpiration"]);
		$secret = $this->generateSecret();
		$this->token = $this->constructToken($secret);
	}

	protected function constructToken($secret)
	{
		$token = sha1(session_id() . $secret);
		$_SESSION["CSRFixerToken"] = $token;
		$_SESSION["CSRFixerTokenExpiration"] = (time() + $this->tokenDuration);
		return $token;
	}

	protected function generateSecret($size = 10)
	{
    	$c = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$string = "";
    	for ($i = 0; $i < $size; $i++)
        	$string .= $c[rand(0, strlen($c) - 1)];
    	return sha1($string);
	}

	private function findToken()
	{
		$tokenExpiration = $_SESSION['CSRFixerTokenExpiration'];
		
		// token is not valid anymore
		if (time() >= $tokenExpiration)
		{
			$secret = $this->generateSecret();
			return $this->constructToken($secret);
		}

		return $_SESSION['CSRFixerToken'];
	}
}

class CSRFixer {

	public static function isValid($token)
	{	
		if (!isset($_SESSION))
			session_start();
		$tp = new TokenProvider();
		if ($tp->getToken() == $token)
			return true;
		return false;
	}
}