<?php

class Response 
{
	/**
	 *	HTTP redirect
	 *	
	 *	@param string $url
	 *	@todo: Check URL
	 */
	public function redirect($url)
	{
		header('Location: ' . $url);
		exit();
	}
}