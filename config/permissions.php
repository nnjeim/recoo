<?php

/*--------------------------------------------------------------------------
 * Module permissions
 * add here the settings to be seeded
 --------------------------------------------------------------------------*/
return [
	'models' => [
		/**
		 * point to the model classes.
		 */
		'app/Models',
	],
	'defaults' => [
		/**
		 * default model permissions.
		 */
		'view',
		'show',
		'store',
		'update',
		'destroy',
		'restore',
	],
	'presets' => [
		/**
		 * add class full path and permissions array
		 * to override the application of the default permissions.
		 */
		'App\Models\User' => [
			'view',
			'show',
			'store',
			'update',
			'destroy',
			'restore',
			'import',
			'export',
		],
		'App\Models\Role' => [
			'view',
			'show',
			'store',
			'update',
			'destroy',
			'restore',
		],
		'App\Models\Record' => [
			'view',
			'show',
			'store',
			'update',
			'destroy',
			'restore',
			'import',
			'export',
		],
	],
	/*--------------------------------------------------------------------------
	 * default permissions per role
	 --------------------------------------------------------------------------*/
	'roles' => [
		'admin' => [
			/*-----------------------------------
			 * users permissions
			 -----------------------------------*/
			'view_user',
			'show_user',
			'store_user',
			'update_user',
			'destroy_user',
			'restore_user',
			'import_user',
			'export_user',
			/*-----------------------------------
			 * record permissions
			 -----------------------------------*/
			'view_record',
			'show_record',
			'store_record',
			'update_record',
			'destroy_record',
			'restore_record',
			'import_record',
			'export_record',
		],
		'editor' => [
			/*-----------------------------------
			 * users permissions
			 -----------------------------------*/
			'view_record',
			'show_user',
			/*-----------------------------------
			 * record permissions
			 -----------------------------------*/
			'view_record',
			'show_record',
			'store_record',
			'update_record',
			'destroy_record',
			'restore_record',
			'import_record',
			'export_record',
		],
	],
];
