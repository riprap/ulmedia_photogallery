<?php

namespace Application;

class Data
{
	public static function getJsonFromFile($file)
	{
		return json_decode(file_get_contents(__DIR__ . '/../data/' . $file));
	}
}