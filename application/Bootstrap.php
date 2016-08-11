<?php 

namespace Application;

class Bootstrap
{
	public static function run()
	{

		// depending on the request, send to a controller
		$request = $_SERVER['REQUEST_URI'];
		$explodedRequest = explode("/", $request);

		$controller = strtolower($explodedRequest[0]);

		switch ($controller) {
			case 'user':
				$controller = "UserController";
				break;
			case 'gallery':
			case '':
				$controller = "GalleryController";
				break;
			default:
				throw new Exception("Unrecognized request: Invalid Controller name");
		}

		// TODO: add hyphenated actions
		// this will only work for single word actions ...
		$action = strtolower(@$explodedRequest[1] ? $explodedRequest[1] : 'index');
		$action .= "Action";

		if (!method_exists($controller, $action)) {
			throw new \Exception("Unrecognized request: Action does not exist");
		}

		$controller = new $controller;
		$data = $controller->action();
		
		return;
		// echo new View($data);
		// die;
	}
}