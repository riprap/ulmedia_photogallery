<?php

namespace Application;

class Data
{
	public function getDataPath($file)
	{
		return __DIR__ . '/../data/' . $file;
	}

	public static function getJsonFromFile($file)
	{
		return json_decode(file_get_contents(self::getDataPath($file)));
	}

	public static function overwriteDataAsJson($file, $jsonData)
	{
		file_put_contents(self::getDataPath($file), $jsonData);
		return true;
	}
}