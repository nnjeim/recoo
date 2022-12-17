<?php

namespace App\Actions\Record;

use App\Models\Record;
use App\Models\Webhook;
use function invoke;

class PullAction
{
	private $record;

	public function __construct(Record $record)
	{
		$this->record = $record;
	}

	public function __invoke()
	{
		// query all the webhook entries by url, branch and status
		$webhookBuilder = Webhook::query()
			->where([
				['url', '=', $this->record->url],
				['branch', '=', $this->record->branch],
				['status', '=', 0],
			]);

		if ($webhookBuilder->count() > 0) {
			invoke(SyncAction::class, $this->record);

			// update the statuses to 1
			$webhookBuilder->update([
				'status' => 1,
			]);
		}
	}
}
