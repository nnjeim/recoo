<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('records', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('imdb_id')->unique();
			$table->json('params');
			$table->foreignId('user_id')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}
};
