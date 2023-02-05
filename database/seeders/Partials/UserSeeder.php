<?php

namespace Database\Seeders\Partials;

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
			tap(
				User::create([
					'name' => env('ADMIN_NAME'),
					'email' => env('ADMIN_EMAIL'),
					'password' => Hash::make(env('ADMIN_PASSWORD')),
					'email_verified_at' => now(),
				]), function (User $user) {
					$user
						->roles()
						->attach($user->getRoleId('superadmin'));
				}
			);
		}
	}
}
