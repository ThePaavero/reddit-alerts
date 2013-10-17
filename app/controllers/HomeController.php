<?php

class HomeController extends BaseController {

	public function index()
	{
		$items = Item::all();

		View::share('data', [
				'page'  => 'pages.home',
				'title' => 'Home',
				'items' => $items
			]);

		return View::make('maintemplate');
	}

}
