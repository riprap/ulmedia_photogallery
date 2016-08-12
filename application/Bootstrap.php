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
				$controller = new GalleryController;
				break;
			default:
				header('Location: /gallery/list');
				throw new Exception("Unrecognized request: Invalid Controller name");
		}

		// TODO: add hyphenated actions
		// this will only work for single word actions ...
		$actionString = strtolower(@$explodedRequest[2] ? $explodedRequest[2] : 'list');
		$action = $actionString . "Action";

		if (!method_exists($controller, $action)) {
			header('Location: /gallery/list');
			exit;
			throw new \Exception("Unrecognized request: Action does not exist");
		}

		$controller = new $controller;
		$data = $controller->$action();
		
		$view = new View($data, $controllerString, $actionString);
		echo $view->render();
		die;
	}
}