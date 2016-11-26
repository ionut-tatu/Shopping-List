<?php

class Url 
{
	
	protected $app_url = APP_URL;

	public static function parseUrlParams() 
	{

		if(isset($_GET['route'])) {
			$url = filter_var(rtrim($_GET['route'], '/'), FILTER_SANITIZE_URL);

			$url = explode('/', $url);

			return $url;
		}
	
	}

	public function buildUrl($path) {
		return $this->app_url . '/' . $path;
	}

}