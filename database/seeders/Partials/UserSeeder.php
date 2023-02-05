<?php

namespace Database\Seeders\Partials;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if (DB::table('users')->count() === 0) {
			$user = User::create([
				'name' => env('ADMIN_NAME'),
				'email' => env('ADMIN_EMAIL'),
				'password' => Hash::make(env('ADMIN_PASSWORD')),
			]);

			$role = Role::firstWhere('name', 'superadmin');

			if ($role) {
				$user
					->roles()
					->attach($role->id);
			}
		}
	}
}
