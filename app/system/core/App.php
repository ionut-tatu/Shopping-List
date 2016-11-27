<?php

/**
 * This is the main class that will handle core application jobs
 * todo: (improve) Create a URL helper and a loader helper
 */

class App 
{

	protected $controller = 'home';
	protected $method = 'index';
	protected $params = [];

	protected $registry;

	
	public function __construct($registry)
	{
		$this->registry = $registry;
	}

	/**
	 * 	Parse URL to detect controller, method and params.
	 *
	 * 	@return void
	 */
	public function execute()
	{
		$url = $this->parseUrl();

		if(file_exists('../app/controllers/' . $url[0] . '.php')) {
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once '../app/controllers/' . $this->controller . '.php';

		$this->controller .= 'Controller';

		$this->controller = new $this->controller($this->registry);

		if(isset($url[1])) {
			if(method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	/**
	 *	Parse URL. Sanitize and explode params.
	 *
	 * 	@return array $url 
	 */
	public function parseUrl()
	{
		if(isset($_GET['route'])) {
			$url = filter_var(rtrim($_GET['route'], '/'), FILTER_SANITIZE_URL);

			$url = explode('/', $url);

			return $url;
		}
	}

}