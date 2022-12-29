<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('channels', function (Blueprint $table) {
			$table->id();
			$table->morphs('channelable');
			$table->foreignId('user_id')->nullable();
			$table->char('action', 50);
			$table->char('medium', 50);
			$table->json('params')->nullable();
			$table->tinyInteger('flag')->default(0);
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
		});
	}
};
