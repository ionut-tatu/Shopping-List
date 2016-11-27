<?php
/**
 *	APP_URL can be found in app/config/app.php.
 */
class Url 
{
	protected $app_url = APP_URL;

	/**
	 *	Build HTTP url.
	 *
	 * 	@param string $path
	 *	@return string
	 */
	public function buildUrl($path) {
		return $this->app_url . '/' . $path;
	}
}