<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('environments', function (Blueprint $table) {
            $table->id();

            $table->decimal('temp_c', 8, 2);
            $table->decimal('temp_f', 8, 2);
            $table->decimal('feelslike_c', 8, 2);
            $table->decimal('feelslike_f', 8, 2);

            $table->string('condition_title');
            $table->string('condition_icon');
            $table->unsignedInteger('condition_code');

            $table->decimal('wind_mph', 8, 2);
            $table->decimal('wind_kph', 8, 2);
            $table->integer('wind_degree');
            $table->string('wind_dir');

            $table->decimal('pressure_mb', 8, 2);
            $table->decimal('pressure_in', 8, 2);

            $table->decimal('precip_mm', 8, 2);
            $table->decimal('precip_in', 8, 2);

            $table->integer('humidity');
            $table->integer('cloud');

            $table->boolean('is_day');

            $table->decimal('uv', 8, 2);

            $table->decimal('gust_mph', 8, 2);
            $table->decimal('gust_kph', 8, 2);

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('environments');
    }
};
