<?php

namespace App\Actions\Profile;

use App\Actions\Profile\Base\BaseProfileAction;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadAvatarAction extends BaseProfileAction
{
	private string $disk = 'public';

	public function __construct(private readonly UploadedFile $photo, private readonly User $user)
	{
	}

	public function __invoke()
	{
		tap($this->user->profile_photo_path, function ($previous) {
			$this
				->user
				->forceFill([
					'profile_photo_path' => $this->photo
						->storePublicly(
							'profile-photos',
							['disk' => $this->disk]
						),
				])
				->save();

			if ($previous) {
				Storage::disk($this->disk)->delete($previous);
			}
		});
		// cache
		$this->flushModuleCache();
	}
}
