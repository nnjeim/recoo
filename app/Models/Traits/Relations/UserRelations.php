<?php

namespace App\Models\Traits\Relations;

use App\Models\Channel;
use App\Models\Log;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\UserOption;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait UserRelations
{
	public static function bootUserRelations(): void
	{
		static::deleting(function (User $user) {
			if ($user->forceDeleting) {
				// delete user logins
				$user->logins()->delete();
				// delete logs
				$user->logs()->delete();
				// detach roles
				$user->roles()->detach();
				// delete permissions
				$user->permissions()->delete();
				// delete channels
				$user->channels()->delete();
				// delete notifications
				$user->notifications()->delete();
			}
		});
	}

	/**
	 * @return MorphMany
	 */
	public function logs(): MorphMany
	{
		return $this->morphMany(Log::class, 'logable');
	}

	/**
	 * @return MorphMany
	 */
	public function channels(): MorphMany
	{
		return $this->morphMany(Channel::class, 'channelable');
	}

	/**
	 * @return BelongsToMany
	 */
	public function roles(): BelongsToMany
	{
		return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
	}

	/**
	 * @return HasMany
	 */
	public function logins(): HasMany
	{
		return $this->hasMany(UserLogin::class);
	}

	/**
	 * @return BelongsToMany
	 */
	public function permissions(): BelongsToMany
	{
		return $this->belongsToMany(Permission::class)->withTimestamps();
	}

	/**
	 * @return HasOne
	 */
	public function options(): HasOne
	{
		return $this->hasOne(UserOption::class);
	}
}
