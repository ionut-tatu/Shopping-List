<?php
/**
 *	Set stylesheets and javascripts to be used within app.
 *	@todo: Add addStyle and addScript methods.
 */

class Asset
{	
	protected $stylesheets;
	protected $javascripts;

	/**
	 *	@param array $assets
	 *	@return void
	 */
	public function __construct($assets)
	{
		$this->stylesheets = isset($assets['stylesheets']) ? $assets['stylesheets'] : [];
		$this->javascripts = isset($assets['javascripts']) ? $assets['javascripts'] : [];
	}

	/**
	 *	@return array
	 */
	public function getStylesheets() 
	{
		return $this->stylesheets;
	}

	/**
	 *	@return array
	 */
	public function getJavascripts() 
	{
		return $this->javascripts;
	}
}