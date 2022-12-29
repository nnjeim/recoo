<?php

namespace App\Events\Record;

use App\Models\Record;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class RecordUpdatedEvent
{
	use SerializesModels;

	public function __construct(public Record $record)
	{
	}
}
