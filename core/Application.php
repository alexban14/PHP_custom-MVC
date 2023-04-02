<?php
/** User: Ban Alexandru */

namespace app\core;

use app\core\Request;
use \app\core\Response;

/**
 * Class Application
 * 
 * @author Ban Alexandru <alexbanut10@gmail.com>
 * @package app\core
 */

class Application
{
	public static string $ROOT_DIR;
	public Router $router;
	public Request $request;
	public Response $response;
	public static Application $app;
	public function __construct($rootPath)
	{
		self::$ROOT_DIR = $rootPath;
		self::$app = $this;
		$this->request = new Request();
		$this->response = new Response();
		// passing the request instance as a construct
		$this->router = new Router($this->request, $this->response);
	}

	public function run()
	{
		$this->router->resolve();
	}
}