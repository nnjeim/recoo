<?php

namespace App\Actions\Profile;

use App\Actions\Profile\Base\BaseProfileAction;
use App\Models\User;
use App\Services\File\UploadTrait;
use App\Services\Image\ImageTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class UploadAvatarAction extends BaseProfileAction
{
	use UploadTrait;
	use ImageTrait;

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
		// file name
		$newFileName = $this->generateFileName($originalFileExtension);

		tap($this->user->profile_photo_path, function ($previous) use ($newFileName) {
			$this
				->user
				->forceFill([
					'profile_photo_path' => $this
						->file
						->storePubliclyAs(
							$this->storage['folder'],
							$newFileName,
							['disk' => $this->storage['disk']]
						),
				])
				->save();

			if ($previous) {
				Storage::disk($this->storage['disk'])->delete($previous);
			}
		});
		// mime
		$aggregate_type = $this->getMediaType($originalFileExtension);

		if ($aggregate_type === 'image') {
			// resize image
			$this->resampleImage(
				imagePath: $this->getFilePath($this->storage['disk'], $this->storage['folder']),
				fileName: $newFileName,
				width: (int) $this->thumbnail_size,
				height: (int) $this->thumbnail_size,
				proportions: true,
				crop: true
			);
		}

		// cache
		$this->flushModuleCache();
	}
}
