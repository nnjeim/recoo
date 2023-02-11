<?php

namespace App\Actions\Record\Base;

use App\Actions\BaseAction;
use App\Models\Record;

abstract class BaseRecordAction extends BaseAction
{
	protected string $attribute = 'record';

	protected string $class = Record::class;

	public string $cacheTag = 'records';

	abstract public function execute(array $args = []);
}
