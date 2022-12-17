<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->text('profile_photo_path')->nullable();
			$table->tinyInteger('status')->default(1);
			$table->softDeletes();
		});
	}
};
