<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('permission_user', function (Blueprint $table) {
			$table->id();
			$table->foreignId('permission_id');
			$table->foreignId('user_id');
			$table->timestamps();

			$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}
};
