<?php

/**
 *	Handles all classes within app
 */
final class Registry 
{

	protected $data = [];

	/**
	 *	@param string $key
	 *	@return bool
	 */
	public function get($key) 
	{
		return (isset($this->data[$key]) ? $this->data[$key] : null);
	}

	/**
	 *	@param string $key
	 *	@param object $value
	 *	@return void
	 */
	public function set($key, $value) 
	{
		if(!$this->has($key)) {
			$this->data[$key] = $value;
		}
	}

	/**
	 *	Check if Registry has this key already
	 *
	 *	@param string $key
	 *	@return bool
	 */
	public function has($key) 
	{
		return isset($this->data[$key]);
	}

}