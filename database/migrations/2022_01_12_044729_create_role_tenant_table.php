<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTenantTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_tenant', function (Blueprint $table) {
			$table->id();
			$table->foreignId('role_id');
			$table->foreignId('tenant_id');
			$table->timestamps();

			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
			$table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('role_tenant');
	}
}
