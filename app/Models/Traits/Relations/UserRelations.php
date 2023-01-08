<?php

namespace App\Models\Traits\Relations;

use App\Models\Log;
use App\Models\Channel;
use App\Models\User;
use App\Models\UserOption;
use App\Models\UserLogin;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait UserRelations
{
	public static function bootUserRelations(): void
	{
		static::deleting(function (User $user) {
			if ($user->forceDeleting) {
				// delete logs
				$user->logs()->delete();
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
	 * @return HasOne
	 */
	public function options(): HasOne
	{
		return $this->hasOne(UserOption::class);
	}
}
