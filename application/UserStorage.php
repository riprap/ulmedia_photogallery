<?php

namespace Application;

class UserStorage
{
	public function __construct()
	{
		session_start();
	}

	private function getUsersData()
	{
		return Data::getJsonFromFile('users.json');
	}

	public function getUserByUsername($username)
	{
		foreach ($this->getUsersData() as $user)
		{
			if ($user->username == $username) {
				return $user;
			}
		}

		return null;
	}

	public function matchLoginDetails($username, $password)
	{
		$this->username = $username;
		
		$user = $this->getUserByUsername($this->username);

		if (!$user) {
			return false;
		}

		return password_verify($password, $user->password);
	}

	public function login()
	{
		$_SESSION['username'] = $this->username;
	}

	public function logout()
	{
		unset($_SESSION['username']);
	}

	public function isLoggedIn()
	{
		return isset($_SESSION['username']);
	}

	public function getUser()
	{
		if (!$this->isLoggedIn())
		{
			return null;
		}

		return $this->getUserByUsername($_SESSION['username']);
	}
}