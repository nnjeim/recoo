<?php

namespace App\Services\Image;

use Intervention\Image\Facades\Image;

trait ImageTrait
{
	/**
	 * @param  string  $imagePath
	 * @param  string  $fileName
	 * @param  int  $width
	 * @param  int  $height
	 * @param  bool  $proportions
	 * @param  bool  $crop
	 * @param  bool  $background
	 * @param  string  $background_color
	 * @return mixed
	 */
	protected function resampleImage(
		string $imagePath,
		string $fileName,
		int $width,
		int $height,
		bool $proportions = true,
		bool $crop = false,
		bool $background = false,
		string $background_color = '#ffffff'
	): mixed {
		$fullImagePath = DIRECTORY_SEPARATOR . trim($imagePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName;
		// Read file
		$image = Image::make($fullImagePath);

		//Resize
		if (! $crop) {
			if ($proportions) {
				if ($image->width() >= $image->height()) {
					$image->resize($width, null, function ($constraint) {
						$constraint->aspectRatio();
					});
				} else {
					$image->resize(null, $height, function ($constraint) {
						$constraint->aspectRatio();
					});
				}
			} else {
				$image->resize($width, $height);
			}
		}

		//Crop Image at center
		if ($crop) {
			$image->fit($width, $height);
		}

		if ($background) {
			$canvas = Image::canvas($width, $height, $background_color);

			$canvas->insert($image, 'center');

			return $canvas->save($fullImagePath);
		}

		//Save Image
		return $image->save($fullImagePath);
	}

	/**
	 * @param  string  $sourcePath
	 * @param  string  $fileName
	 * @param  string  $targetPath
	 * @param  int  $width
	 * @param  int  $height
	 * @param  bool  $proportions
	 * @param  bool  $crop
	 */
	protected function copyImage(
		string $sourcePath,
		string $fileName,
		string $targetPath,
		int $width,
		int $height,
		bool $proportions = true,
		bool $crop = true
	): void {
		// Read file
		$image = Image::make(DIRECTORY_SEPARATOR . trim($sourcePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName);

		//Resize & Crop
		if ($proportions) {
			if ($image->width() >= $image->height()) {
				$image->resize(null, $height, function ($constraint) {
					$constraint->aspectRatio();
				});
			} else {
				$image->resize($width, null, function ($constraint) {
					$constraint->aspectRatio();
				});
			}
		} else {
			$image->resize($width, $height);
		}
		//Crop Image at center
		if ($crop) {
			$image->crop($width, $height);
		}
		//Save Image
		$image->save(DIRECTORY_SEPARATOR . trim($targetPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName);
	}
}
