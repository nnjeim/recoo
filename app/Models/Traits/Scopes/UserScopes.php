<?php

namespace App\Models\Traits\Scopes;

use App\Models\UserLogin;
use Illuminate\Database\Eloquent\Builder;

trait UserScopes
{
	/**
	 * @param  Builder  $builder
	 * @return Builder
	 */
	public function scopeActive(Builder $builder): Builder
	{
		return $builder->where('status', 1);
	}

	/**
	 * @param  Builder  $builder
	 * @return Builder
	 */
	public function scopeWithLastLoginDate(Builder $builder): Builder
	{
		return $builder
			->addSelect([
				'last_login_at' => UserLogin::select('created_at')
					->whereColumn('user_id', 'users.id')
					->latest()
					->take(1),
			])
			->withCasts(['last_login_at' => 'datetime']);
	}
}
