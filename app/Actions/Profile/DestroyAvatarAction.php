<?php

namespace App\Actions\Profile;

use App\Actions\Profile\Base\BaseProfileAction;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DestroyAvatarAction extends BaseProfileAction
{
	private string $disk = 'public';

	public function __construct(private readonly User $user)
	{
	}

	public function __invoke()
	{
		if (is_null($this->user->profile_photo_path)) {
			return;
		}

		Storage::disk($this->disk)->delete($this->user->profile_photo_path);

		$this
			->user
			->forceFill([
				'profile_photo_path' => null,
			])
			->save();
		// cache
		$this->flushModuleCache();
	}
}
