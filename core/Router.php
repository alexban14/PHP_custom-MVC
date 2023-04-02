<?php
/** User: Ban Alexandru */

namespace app\core;

use \app\core\Request;
use \app\core\Response;

/**
 * Class Router
 * 
 * @author Ban Alexandru <alexbanut10@gmail.com>
 * @package app\core
 */

class Router
{
	public Request $request;
	public Response $response;
	public function __construct(Request $request, Response $response)
	{
		$this->request = $request;
		$this->response = $response;
	}

	protected $routes = [];
	public function get($path, $callback) 
	{
		$this->routes['get'][$path] = $callback;
	}

	public function post($path, $callback) 
	{
		$this->routes['post'][$path] = $callback;
	}

	public function resolve()
	{
		$path = $this->request->getPath();
		$method = $this->request->getMethod();
		// we store a closure object (an executable closure function)
		$callback = $this->routes[$method][$path] ?? false; // check if method & path are set
		if($callback === false)
		{
			$this->response->setStatusCode(404);
			$this->renderView("_404");
		}

		if(is_string($callback))
		{
			return $this->renderView($callback);
		}

		if(is_array($callback))
		{
			$callback[0] = new $callback[0];
		}

		return call_user_func($callback);
	}

	public function renderView($view, $params = [])
	{
		$layoutContent = $this->layoutContent();
		$viewContent = $this->renderOnlyView($view, $params);
		return str_replace('{{ content }}', $viewContent, $layoutContent);
	}

	public function renderContent($viewContent)
	{
		$layoutContent = $this->layoutContent();
		return str_replace('{{ content }}', $viewContent, $layoutContent);
	}

	public function layoutContent()
	{
		ob_start(); // starts the output caching (nothing is outputed in the browser)
		include_once Application::$ROOT_DIR . "/views/layouts/main.php";
		return ob_clean(); // return and clear the buffer	
	}
	public function renderOnlyView($view, $params)
	{
		// we iterate over each value of the params array so 
		foreach ($params  as $key => $value) 
		{
			$$key = $value; 
		}

		ob_start(); // starts the output caching (nothing is outputed in the browser)
		include_once Application::$ROOT_DIR . "/views/$view.php";
		return ob_clean(); // return and clear the buffer
	}
}