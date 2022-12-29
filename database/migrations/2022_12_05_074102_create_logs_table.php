<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('logs', function (Blueprint $table) {
			$table->id();
			$table->morphs('logable');
			$table->foreignId('user_id');
			$table->json('data')->nullable();
			$table->timestamps();
		});
	}
};
