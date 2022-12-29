<?php

namespace App\Models\Traits\Relations;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait LogRelations
{
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class)->withTrashed();
	}
}
