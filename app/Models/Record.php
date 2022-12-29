<?php

namespace App\Models;

use App\Models\Traits\Relations\RecordRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
	use SoftDeletes;
	use RecordRelations;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'imdb_id',
		'params',
		'user_id',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'params' => 'array',
	];
}
