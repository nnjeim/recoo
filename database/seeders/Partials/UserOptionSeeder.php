<?php

namespace Database\Seeders\Partials;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserOptionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Artisan::call('userOptions:generate');
	}
}
