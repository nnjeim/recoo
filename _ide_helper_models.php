<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Channel
 *
 * @property int $id
 * @property string $channelable_type
 * @property int $channelable_id
 * @property int|null $user_id
 * @property string $action
 * @property string $medium
 * @property array|null $params
 * @property int $flag
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $channelable
 * @method static \Illuminate\Database\Eloquent\Builder|Channel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereChannelableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereChannelableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereMedium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereUserId($value)
 */
	class Channel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Log
 *
 * @property int $id
 * @property string $logable_type
 * @property int $logable_id
 * @property int $user_id
 * @property array|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $logable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereLogableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereLogableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUserId($value)
 */
	class Log extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ModuleOption
 *
 * @property int $id
 * @property string $optionable_type
 * @property array|null $params
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleOption whereOptionableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleOption whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleOption whereUpdatedAt($value)
 */
	class ModuleOption extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ModuleSetting
 *
 * @property int $id
 * @property string $settable_type
 * @property array|null $params
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleSetting whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleSetting whereSettableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleSetting whereUpdatedAt($value)
 */
	class ModuleSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @property int $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $data
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $model
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Log> $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Record
 *
 * @property int $id
 * @property string $title
 * @property string|null $imdb_id
 * @property array|null $params
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Log> $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Record newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Record newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Record onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Record query()
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Record withoutTrashed()
 */
	class Record extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property bool $locked
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read bool $deleted
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Log> $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutTrashed()
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tenant
 *
 * @property int $id
 * @property string $name
 * @property array|null $params
 * @property int $status
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Log> $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModuleOption> $moduleOptions
 * @property-read int|null $module_options_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModuleSetting> $moduleSettings
 * @property-read int|null $module_settings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant withoutTrashed()
 */
	class Tenant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $profile_photo_path
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Channel> $channels
 * @property-read int|null $channels_count
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserLogin> $logins
 * @property-read int|null $logins_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Log> $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\UserOption|null $options
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User active()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withLastLoginDate()
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\UserLogin
 *
 * @property int $id
 * @property int $user_id
 * @property array|null $params
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLogin whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLogin whereUserId($value)
 */
	class UserLogin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserOption
 *
 * @property int $id
 * @property int $user_id
 * @property array|null $params
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOption whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOption whereUserId($value)
 */
	class UserOption extends \Eloquent {}
}

