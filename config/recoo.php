<?php

return [
	/*--------------------------------------------------------------------------
	 * Core roles
	 * add here the roles to be seeded
	 * set the default role
	 --------------------------------------------------------------------------*/
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
];
