<?php

namespace App\Http\Livewire\Traits;

trait WithToasts
{
	/**
	 * Notify the user of an event.
	 * @param  string  $message
	 * @param  string  $title
	 * @param  string  $type
	 * @return void
	 */
	public function toast(string $message, string $title = 'Congratulations!', string $type = 'success'): void
	{
		$this->dispatchBrowserEvent('toast-ev', ['message' => $message, 'title' => $title, 'type' => $type]);
	}

	/**
	 * @param  bool  $success
	 * @param  string  $message
	 * @return void
	 */
	public function notifyAction(bool $success, string $message): void
	{
		$success
			? $this->toast($message, trans('notifications.success'))
			: $this->toast($message, trans('notifications.warning'), 'warning');
	}
}
