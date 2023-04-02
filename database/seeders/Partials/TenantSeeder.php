<?php

namespace Database\Seeders\Partials;

use App\Models\Role;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if (DB::table('tenants')->count() === 0) {
			$tenant = tap(
					Tenant::create([
					'name' => 'base',
					'status' => 1,
					'token' => generateToken(),
				]),
				function (Tenant $tenant) {
					// role ids
					$roleIds = Role::all()->pluck('id')->toArray();
					// tenant roles relation
					$tenant->roles()->attach($roleIds);
				}
			);
		}
	}
}
