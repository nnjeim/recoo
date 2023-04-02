<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Partials;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call([
			Partials\RoleSeeder::class,
			Partials\TenantSeeder::class,
			Partials\UserSeeder::class,
			Partials\PermissionsSeeder::class,
			Partials\ModuleSettingSeeder::class,
			Partials\ModuleOptionSeeder::class,
			Partials\RolePermissionSeeder::class,
			Partials\UserOptionSeeder::class,
		]);
	}
}
