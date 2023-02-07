<?php

namespace App\Models;

use App\Models\Traits\HasPermissions;
use App\Models\Traits\Relations\RecordRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
	use HasPermissions;
	use RecordRelations;
	use SoftDeletes;

	protected $fillable = [
		'title',
		'imdb_id',
		'params',
		'user_id',
	];

	protected $casts = [
		'params' => 'array',
	];
}
