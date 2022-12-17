<?php

namespace App\Models;

use App\Models\Traits\Relations\MediableRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Mediables extends Model
{
	use MediableRelations;

	protected $fillable = [
		'mediable_type',
		'mediable_id',
		'user_id',
		'title',
		'url',
		'exif',
	];

	protected $casts = [
		'exif' => 'array',
	];

	protected $hidden = ['mediable_id', 'mediable_type'];

	protected $touches = ['mediable'];

	public $timestamps = false;

	public static function boot()
	{
		parent::boot();

		self::creating(function ($model) {
			$model->user_id = auth()->id();
		});
	}

	/**
	 * @return MorphTo
	 */
	public function mediable(): MorphTo
	{
		return $this->morphTo();
	}
}
