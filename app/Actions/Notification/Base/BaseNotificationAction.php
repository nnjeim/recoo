<?php

namespace App\Actions\Notification\Base;

use App\Actions\BaseAction;
use App\Models\Notification;

abstract class BaseNotificationAction extends BaseAction
{
	protected string $attribute = 'notification';

	protected string $class = Notification::class;

	abstract public function execute(array $args = []);
}
