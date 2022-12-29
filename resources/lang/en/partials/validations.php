<?php

return [
	'email' => [
		'unique' => [
			0 => 'The email address already exist in our records!',
			1 => 'The email address is valid.',
		],
		'exist' => [
			0 => 'The email do not exist in our records!',
			'format' => 'The email field is wrongly formatted!',
		],
		'verification' => [
			1 => 'Thank you. Your email was successfully verified.',
			0 => 'We are sorry. Your email couldn\'t be verified!',
			'completed' => 'The contact\'s email was previously verified!',
		],
		'bill_payer' => [
			0 => 'The email is already used!',
		],
	],
	'phone' => [
		'unique' => [
			0 => 'The phone number already exist in our records!',
			1 => 'The phone number is valid.',
		],
		'format' => [
			0 => 'The phone number is wrongly formatted!',
			1 => 'The phone number format is valid.',
		],
	],
	'file' => [
		'invalid' => 'The file is invalid!',
		'invalid_type' => 'The file type is invalid!',
		'invalid_size' => 'The max file size is :attribute MB',
	],
	'tag' => [
		'taggable_type' => [
			'invalid' => 'The taggable type is invalid!',
		],
		'name' => [
			'unique' => [
				0 => 'The name is already used!',
			]
		]
	],
	'role' => [
		'invalid_roles_combination' => 'The admin and judge roles can not be both assigned!'
	],
];
