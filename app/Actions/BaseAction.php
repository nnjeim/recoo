<?php

namespace App\Actions;

use App\Actions\Traits\ActionHelpersTrait;
use App\Actions\Traits\ActionModelTrait;
use App\Actions\Traits\ActionExceptionsTrait;
use App\Http\Response\ResponseBuilder;

abstract class BaseAction
{
	use ActionModelTrait;
	use ActionHelpersTrait;
	use ActionExceptionsTrait;

	public bool $success = false;

	public string $message = '';

	public array $errors = [];

	public $data;

	abstract public function execute(array $args = []);

	abstract public function withResponse(): ResponseBuilder;
}
