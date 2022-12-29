<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('user_options', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id');
			$table->json('params')->nullable();
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}
};
