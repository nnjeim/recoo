<?php

namespace App\Actions\Record\Base;

use App\Actions\BaseAction;
use App\Models\Record;

abstract class BaseRecordAction extends BaseAction
{
	protected string $class = Record::class;

	protected string $cacheTag = 'records';

	protected string $attribute = 'record';

	abstract public function execute(array $args = []);
}
