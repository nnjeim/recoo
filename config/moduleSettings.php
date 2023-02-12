<?php

return [
	'App\Models\Role' => [
		'roles' => [
			[
				'name' => 'superadmin',
				'locked' => 1,
				'default' => 0,
			],
			[
				'name' => 'admin',
				'locked' => 1,
				'default' => 0,
			],
			[
				'name' => 'editor',
				'locked' => 1,
				'default' => 1,
			],
		],
	],
	'App\Models\User' => [
		'statuses' => [
			[
				'value' => '0',
				'name' => 'inactive',
			],
			[
				'value' => '1',
				'name' => 'active',
			],
		]
	],
];
