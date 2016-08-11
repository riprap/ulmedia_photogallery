<?php

namespace Application;

class UserController
{
	public function __construct()
	{

	}

	public function loginAction()
	{
		$userStorage = new UserStorage();
		if ($userStorage->isLoggedIn()) {
			header('Location: /gallery/list');
			exit;
		}

		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			return;
		}


		if (!isset($_POST['username']) || !isset($_POST['password'])) {
			return $data['error'] = "Username and password must be entered to log in";
		}

		$loggedIn = $userStorage->matchLoginDetails($_POST['username'], $_POST['password']);
		if ($loggedIn) {
			$userStorage->login();
			header('Location: /gallery/list');
		}

		return $data['error'] = "Username and password don't match";
	}

	public function logoutAction()
	{
		$userStorage = new UserStorage();
		$userStorage->logout();
		header('Location: /user/login');
		exit;
	}

	private function checkLoginDetails($options)
	{
		
	}
}