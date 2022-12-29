<?php

namespace App\Models\Traits\Relations;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait MediableRelations
{
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
}
