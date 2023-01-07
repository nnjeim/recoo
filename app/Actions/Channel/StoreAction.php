<?php

namespace App\Actions\Channel;

use App\Actions\Channel\Base\BaseChannelAction;
use Illuminate\Database\Eloquent\Model;

class StoreAction extends BaseChannelAction
{
	public function __construct(
		private readonly Model $model,
		private readonly int $user_id,
		private readonly string $action,
		private readonly string $medium,
		private readonly array $params = [])
	{
	}

	public function __invoke(): Model
	{
		return $this
			->model
			->channels()
			->create([
				'user_id' => $this->user_id,
				'action' => $this->action,
				'medium' => $this->medium,
				'params' => $this->params,
				'flag' => 0,
			]);
	}
}
