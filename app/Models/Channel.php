<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Channel extends Model
{
	protected $fillable = [
		'channelable_id',
		'channelable_type',
		'user_id',
		'action',
		'medium',
		'params',
		'flag',
	];

	protected $hidden = ['channelable_id', 'channelable_type'];

	protected $casts = ['params' => 'array'];

	/**
	 * @return MorphTo
	 */
	public function channelable(): MorphTo
	{
		return $this->morphTo();
	}
}
