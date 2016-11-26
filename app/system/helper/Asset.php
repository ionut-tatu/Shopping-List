<?php

class Asset
{
	
	protected $stylesheets;
	protected $javascripts;

	public function __construct($assets)
	{
		$this->stylesheets = isset($assets['stylesheets']) ? $assets['stylesheets'] : [];
		$this->javascripts = isset($assets['javascripts']) ? $assets['javascripts'] : [];
	}

	public function getStylesheets() 
	{
		return $this->stylesheets;
	}

	public function getJavascripts() 
	{
		return $this->javascripts;
	}

}