<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('country_stats', function (Blueprint $table) {
			$table->id();
			$table->string('country');
			$table->string('code');
			$table->integer('confirmed');
			$table->integer('recovered');
			$table->integer('critical');
			$table->integer('deaths');
			$table->timestamps();

			$table->foreign('code')->references('code')->on('countries');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('country_stats');
	}
};
