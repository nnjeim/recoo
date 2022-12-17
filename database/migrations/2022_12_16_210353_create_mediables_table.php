<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('mediables', function (Blueprint $table) {
			$table->id();
			$table->morphs('mediable');
			$table->foreignId('user_id')->nullable();
			$table->string('title')->nullable();
			$table->string('url');
			$table->json('exif')->nullable();
		});
	}
};
