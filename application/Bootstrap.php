<?php 

namespace Application;

class Bootstrap
{
	public static function run()
	{
		// depending on the request, send to a controller
		$request = $_SERVER['REQUEST_URI'];
		$explodedRequest = explode("/", $request);

		$controllerString = strtolower($explodedRequest[1]);

		switch ($controllerString) {
			case 'user':
				$controller = new UserController;
				break;
			case 'gallery':
			case '':
				$controller = new GalleryController;
				break;
			default:
				throw new Exception("Unrecognized request: Invalid Controller name");
		}

		// TODO: add hyphenated actions
		// this will only work for single word actions ...
		$actionString = strtolower(@$explodedRequest[2] ? $explodedRequest[2] : 'index');
		$action = $actionString . "Action";

		if (!method_exists($controller, $action)) {
			throw new \Exception("Unrecognized request: Action does not exist");
		}

		$controller = new $controller;
		$data = $controller->$action();
		
		
		$view = new View($data, $controllerString, $actionString);
		echo $view->render();
		die;
	}
}