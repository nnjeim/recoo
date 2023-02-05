<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('role_user', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id');
			$table->foreignId('role_id');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
		});
	}
};
