<?php

namespace App\Models;

use App\Models\Traits\Relations\LogRelations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Log extends Model
{
	use LogRelations;
	use Prunable;

	protected $fillable = [
		'logable_id',
		'logable_type',
		'user_id',
		'data',
	];

	protected $hidden = [
		'id',
		'logable_id',
		'logable_type',
	];

	protected $casts = [
		'data' => 'array',
	];

	/**
	 * @return MorphTo
	 */
	public function logable(): MorphTo
	{
		return $this->morphTo()->withTrashed();
	}

	/**
	 * Get the prunable model query.
	 *
	 * @return Builder
	 */
	public function prunable(): Builder
	{
		return static::where('created_at', '<=', now()->subDays(config('constants.log.prune_older_than_days')));
	}
}
