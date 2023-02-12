<?php

namespace Database\Seeders\Partials;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$roleSettings = Arr::get(config('moduleSettings'), Role::class);

		if (DB::table('roles')->count() === 0) {
			foreach ($roleSettings['roles'] as $args) {
				// exists
				$roleBuilder = Role::where('name', '=', $args['name']);

				if (! $roleBuilder->exists()) {
					Role::create(array_only($args, ['name', 'locked']));
				}
			}
		}
	}
}
