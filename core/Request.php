<?php
/** User: Ban Alexandru */

namespace app\core;

/**
 * Class Request
 * 
 * @author Ban Alexandru <alexbanut10@gmail.com>
 * @package app\core
 */

 class Request
 {
	public function getPath()
	{
		$path = $_SERVER['REQUEST_URI'] ?? '/';
		$position = strpos($path, '?');
		if($position === false) {
			return $path;
		};
		echo '<pre>';
		var_dump($position);
		echo '</pre>';
		exit;
	}

	public function getMethod()
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}
 }