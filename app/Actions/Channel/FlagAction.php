<?php

namespace App\Actions\Channel;

use App\Models\Channel;

class FlagAction
{
	public function __construct(private readonly Channel $channel)
	{
	}

	public function __invoke(): void
	{
		$this->channel->update([
			'flag' => 1,
		]);
	}
}
