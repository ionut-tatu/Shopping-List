<?php

class Session
{

	public $session_id = '';
	public $data = [];

	/**
	 *	Open Session
	 *	@todo: Modify ini settings if needed
	 *
	 *	@return void
	 */
	public function __construct()
	{
		session_start();
	}

	/**
	 *	Start Session. Check for existing session id.
	 *	
	 *	@param string $key
	 *	@param string $value
	 *	@return string $this->session_id
	 */
	public function start($key = 'default', $value = '') 
	{
		if ($value) {
			$this->session_id = $value;
		} elseif (isset($_COOKIE[$key])) {
			$this->session_id = $_COOKIE[$key];
		} else {
			$this->session_id = $this->createId();
		}	
		
		if (!isset($_SESSION[$this->session_id])) {
			$_SESSION[$this->session_id] = array();
		}
		
		$this->data = &$_SESSION[$this->session_id];
		
		if ($key != 'PHPSESSID') {
			setcookie($key, $this->session_id, ini_get('session.cookie_lifetime'), ini_get('session.cookie_path'), ini_get('session.cookie_domain'), ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
		}

		return $this->session_id;
	}	

	/**
	 *	Create session id.
	 *	
	 *	@return string
	 */
	public function createId() 
	{
		if (function_exists('random_bytes')) {
        	return substr(bin2hex(random_bytes(26)), 0, 26);
		} elseif (function_exists('openssl_random_pseudo_bytes')) {
			return substr(bin2hex(openssl_random_pseudo_bytes(26)), 0, 26);
		} else {
			return substr(bin2hex(mcrypt_create_iv(26, MCRYPT_DEV_URANDOM)), 0, 26);
		}
	}

	/**
	 *	Destroy session.
	 *	
	 *	@param string $key
	 *	@return void
	 */
	public function destroy($key = 'default') {
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}
		
		setcookie($key, '', time() - 42000, ini_get('session.cookie_path'), ini_get('session.cookie_domain'));
	}

}