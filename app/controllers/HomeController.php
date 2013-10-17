<?php

# use Guzzle\Http\Client;

class HomeController extends BaseController {

	public function __construct()
	{
		$this->client = new Guzzle\Http\Client();
	}

	public function index()
	{
		$subslug = 'atheism';
		$term = 'richard';
		$results = $this->doSearch($subslug, $term);

		if(empty($results))
		{
			return 'Nada';
		}

		foreach($results as $result)
		{
			$redditid = $result->data->name;
			$existing = Item::where('name', $redditid)->count();

			if($existing > 0)
			{
				echo 'skipped ' . $redditid . '<br>';
				continue;
			}

			$item = new Item();

			$item->url       = 'http://www.reddit.com' . $result->data->permalink;
			$item->kind      = $result->kind;
			$item->title     = $result->data->title;
			$item->name      = $redditid;
			$item->subreddit = $result->data->subreddit;
			$item->author    = $result->data->author;

			$item->save();
			echo 'created ' . $redditid . '<br>';
		}

		//
	}

	private function doSearch($subslug, $term = '')
	{
		$this->client->setUserAgent('searchbot/0.1 by moarsecode');

		$request  = $this->client->get('http://www.reddit.com/search.json?q=' . urlencode($term));
		$response = $request->send();
		$json     = $response->getBody();
		$data     = json_decode($json);

		$results = $data->data->children;

		return $results;
	}

}