<?php

namespace App\Actions\Profile;

use App\Actions\Profile\Base\BaseProfileAction;
use App\Models\User;
use App\Services\File\UploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class UploadAvatarAction extends BaseProfileAction
{
	use UploadTrait;

	private array $storage;

	private string $thumbnail_size;

	private string $file_extensions;

	private string $max_upload_file_size;

	private string $orginalFileName = 'photo';

	public function __construct(private readonly UploadedFile $file, private readonly User $user)
	{
		foreach (Arr::get($this->getModuleOptions(), 'profile.avatar') as $prop => $value) {
			$this->{$prop} = $value;
		}
	}

	public function __invoke()
	{
		// file validation
		$this->validateFile($this->file);

		$originalFileExtension = strtolower($this->file->getClientOriginalExtension());

		$originalFileSize = round($this->file->getSize() / 1000000, 2);

		// file type
		$this->validateFileType($originalFileExtension, $this->file_extensions);
		// file size
		$this->validateFileSize((float) $originalFileSize, (float) $this->max_upload_file_size);

		tap($this->user->profile_photo_path, function ($previous) {
			$this
				->user
				->forceFill([
					'profile_photo_path' => $this
						->file
						->storePublicly(
							$this->storage['folder'],
							['disk' => $this->storage['disk']]
						),
				])
				->save();

			if ($previous) {
				Storage::disk($this->storage['disk'])->delete($previous);
			}
		});
		// cache
		$this->flushModuleCache();
	}
}
