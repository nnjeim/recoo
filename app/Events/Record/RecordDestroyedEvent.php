<?php

namespace App\Events\Record;

use App\Models\Record;
use Illuminate\Queue\SerializesModels;

class RecordDestroyedEvent
{
	use SerializesModels;

	public function __construct(public Record $record)
	{
	}
}
