<?php

namespace App\Actions\TenantOption\Base;

use App\Actions\BaseAction;
use App\Models\Tenant;

class BaseTenantOptionAction extends BaseAction
{
	protected string $attribute = 'tenant';

	protected string $class = Tenant::class;

	public string $cacheTag = 'tenants';
}
