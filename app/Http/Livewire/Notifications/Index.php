<?php

namespace App\Http\Livewire\Notifications;

use App\Actions\Notification;
use App\Http\Livewire\Traits\WithToasts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
	use WithToasts;

	public array $notifications = [];

	public function mount()
	{
		$this->fetchNotifications();
	}

	/**
	 * Method to fetch the authenticated user notifications.
	 *
	 * @return void
	 */
	public function fetchNotifications(): void
	{
		$message = '';

		$action = trigger(Notification\IndexAction::class, []);

		if ($action->success) {
			$this->notifications = $action->data->toArray();
			return;
		}

		if ($action->errors) {
			foreach ($this->errors as $key => $error) {
				$message = $error[0];
			}
		}
		// notification
		$this->notifyAction($action->success, $message);
	}

	/**
	 * Method to mark a notification as read.
	 *
	 * @param  string|null  $id
	 * @param  string|null  $scope
	 * @return void
	 */
	public function markNotificationAsRead(?string $id = null, ?string $scope = null): void
	{
		$message = '';

		$action = trigger(Notification\MarkAsReadAction::class, compact('id', 'scope'));

		if ($action->success) {
			$this->fetchNotifications();
			return;
		}

		if ($action->errors) {
			foreach ($this->errors as $key => $error) {
				$message = $error[0];
			}
		}
		// notification
		$this->notifyAction($action->success, $message);
	}

	/**
	 * Method to delete a notification.
	 *
	 * @param  string  $id
	 * @return void
	 */
	public function destroyNotification(string $id): void
	{
		$message = '';

		$action = trigger(Notification\DestroyAction::class, compact('id'));

		if ($action->success) {
			$this->fetchNotifications();
			return;
		}

		if ($action->errors) {
			foreach ($this->errors as $key => $error) {
				$message = $error[0];
			}
		}
		// notification
		$this->notifyAction($action->success, $message);
	}

	/**
	 * @return Application|Factory|View
	 */
	public function render(): Application|Factory|View
	{
		return view('components.notifications.index');
	}
}
