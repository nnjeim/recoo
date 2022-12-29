<?php

namespace App\Events\Record;

use App\Models\Record;
use Illuminate\Queue\SerializesModels;

class RecordStoredEvent
{
	use SerializesModels;

	public function __construct(public Record $record)
	{
	}
}
