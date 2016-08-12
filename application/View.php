<?php

namespace Application; 

class View
{
	public function __construct($data, $controller, $action)
	{
		$this->viewScript = __DIR__ . '/views/' . $controller . '/' . $action . '.html';
		$this->data = $data;
	}

	public function render()
	{
		ob_start();
		include $this->viewScript;
		return ob_get_clean();
	}
}