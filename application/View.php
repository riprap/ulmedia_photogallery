<?php

namespace Application; 

class View
{
	public function __construct($data, $controller, $action)
	{
		$this->html = $this->getViewScript($controller, $action);
	}

	public function render()
	{
		return $this->html;
	}

	private function getViewScript($controller, $action)
	{
		$file = __DIR__ . '/views/' . $controller . '/' . $action . '.html';
		return file_get_contents($file);
	}
}