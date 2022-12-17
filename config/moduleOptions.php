<?php

return [
	'App\Models\User' => [
		'profile' => [
			'avatar' => [
				'thumbnail_size' => '60',
				'file_extensions' => 'jpg,jpeg,png,svg',
				'max_upload_file_size' => '2',
				'storage' => [
					'disk' => 'public',
					'folder' => '/users/avatars',
				],
			],
		],
	],
];
