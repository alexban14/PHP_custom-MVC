<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
	public function home()
	{
		$params = [
			'name' => "Ban Alex"
		];
		return $this->render('home', $params);
	}
	public function contact()
	{
		$this->render('contact');
	}
	public function handleContact()
	{
		return 'Handling submitted data';
	}
}