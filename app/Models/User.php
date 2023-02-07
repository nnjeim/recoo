<?php

namespace App\Models;

use App\Models\Traits\HasPermissions;
use App\Models\Traits\HasProfilePhoto;
use App\Models\Traits\HasRoles;
use App\Models\Traits\Relations\UserRelations;
use App\Models\Traits\Scopes\UserScopes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasFactory;
	use HasPermissions;
	use HasProfilePhoto;
	use HasRoles;
	use Notifiable;
	use SoftDeletes;
	use UserRelations;
	use UserScopes;

	protected $fillable = [
		'name',
		'email',
		'password',
		'profile_photo_path',
		'status',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
		'deleted_at' => 'datetime',
	];

	/*-- Mutators ----------------------------------------------------------------------------------------------------*/
	public function setPasswordAttribute($value): string
	{
		return $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
	}
}
