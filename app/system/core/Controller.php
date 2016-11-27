<?php

/**
 * 	Main Controller to handle models and views.
 *	@todo: Split Model and View to separate controllers.
 */

class Controller
{
	protected $registry;

	/**
	 *	@param Registry $registry
	 *	@return void
	 */
	public function __construct($registry) 
	{
		$this->registry = $registry;
	}

	/**
	 *	@param string $key
	 *	@return bool
	 */
	public function __get($key) 
	{
		return $this->registry->get($key);
	}

	/**
	 *	@param string $key
	 *	@param string $value
	 *	@return void
	 */
	public function __set($key, $value) 
	{
		$this->registry->set($key, $value);
	}
	
	/**
	 *	Load model.
	 *
	 *	@param string $model
	 *	@return $model() instance
	 */
	public function model($model) 
	{
		require_once('../app/models/' . $model . '.php');

		return new $model($this->registry);
	}

	/**
	 *	Load view.
	 *
	 *	@param string $view
	 *	@param array $data
	 *	@return void
	 */
	public function view($view, $data = []) 
	{
		require_once '../app/views/' . $view . '.php';
	}

}