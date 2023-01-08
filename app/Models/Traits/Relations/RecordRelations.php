<?php

namespace App\Models\Traits\Relations;

use App\Models\Log;
use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait RecordRelations
{
	public static function bootRecordRelations(): void
	{
		static::deleting(function (Record $record) {
			if ($record->forceDeleting) {
				// delete logs
				$record->logs()->delete();
			}
		});
	}

	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this
			->belongsTo(User::class, 'user_id', 'id')
			->withDefault()
			->withTrashed();
	}

	/**
	 * @return MorphMany
	 */
	public function logs(): MorphMany
	{
		return $this->morphMany(Log::class, 'logable');
	}
}
