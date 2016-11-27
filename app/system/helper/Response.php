<?php

class Response 
{
	
	/**
	 *	HTTP redirect
	 *	
	 *	@param string $url
	 */
	public function redirect($url)
	{
		header('Location: ' . $url);
		exit();
	}

}