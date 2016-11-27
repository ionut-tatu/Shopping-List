<?php

/**
 * Main Controller. It will handle models and views.
 */

class Controller
{
	protected $registry;

	public function __construct($registry) 
	{
		$this->registry = $registry;
	}

	public function __get($key) 
	{
		return $this->registry->get($key);
	}

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