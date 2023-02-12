<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('module_options', function (Blueprint $table) {
			$table->id();
			$table->char('optionable_type', 255);
			$table->json('params')->nullable();
			$table->timestamps();
		});
	}
};
