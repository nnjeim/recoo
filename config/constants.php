<?php

return [
	'app_timezone' => env('APP_TIMEZONE'),
	'imdb_hyperlink' => env('IMDB_HYPERLINK'),
	'omdb_api_url' => env('OMDB_API_URL'),
	'omdb_api_key' => env('OMDB_API_KEY'),
	'log' => [
		'prune_older_than_days' => 30,
		'pagination' => [
			'per_page' => 20,
		],
	],
];
