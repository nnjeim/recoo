<?php

namespace App\Http\Livewire\Profile\Traits\Edit;

use App\Actions\Profile\DestroyAvatarAction;
use App\Actions\Profile\UploadAvatarAction;
use App\Actions\User;
use App\Actions\UserEmail\GenerateVerificationEmailAction;
use App\Exceptions\UnprocessableException;
use Illuminate\Support\Facades\Auth;
use Livewire\Redirector;

trait ActionsTrait
{
	/**
	 * @return void
	 */
	public function showUser(): void
	{
		$action = trigger(User\ShowAction::class, ['id' => Auth::id()]);

		if ($action->success) {
			$this->user = $action->data->toArray();
		}
	}

	/**
	 * Method to update the user.
	 * @return void
	 */
	public function updateUser(): void
	{
		$message = '';

		$validator = $this->validateRecord();

//		$this->setTabsErrors($validator);
//
		$this->displayErrors($validator);

		if ($validator->fails()) {
			return;
		}

		$action = trigger(User\UpdateAction::class, $this->user)->withResponse();

		if ($action->success) {
			$message = $action->message;

			$this->emit('saved');
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		// notification
		$this->notifyAction($action->success, $message);
	}

	/**
	 * @return Redirector|null
	 */
	public function uploadProfilePhoto(): ?Redirector
	{
		try {
			invoke(UploadAvatarAction::class, $this->photo, Auth::user());
		} catch (UnprocessableException $e) {
			$this->addError('upload', $e->getMessage());
			return null;
		}

		return redirect()->route('profile.index');
	}

	/**
	 * Method to delete the user avatar.
	 *
	 * @return Redirector
	 */
	public function deleteProfilePhoto(): Redirector
	{
		invoke(DestroyAvatarAction::class, Auth::user());

		return redirect()->route('profile.index');
	}

	/**
	 * Method to send the user email verification mail.
	 * @return void
	 */
	public function sendEmailVerification(): void
	{
		$message = '';

		$action = trigger(
			GenerateVerificationEmailAction::class,
			['id' => $this->user['id']]
		)->withResponse();

		if ($action->success) {
			$message = $action->message;
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		// notification
		$this->notifyAction($action->success, $message);
	}
}
