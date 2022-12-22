<?php

namespace App\Events\Record;

use App\Models\Record;
use Illuminate\Queue\SerializesModels;

class RecordDestroyedEvent
{
	use SerializesModels;

	public Record $record;

	public function __construct(Record $record)
	{
		$this->record = $record;
	}
}
