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
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedInteger('floor')->nullable();
            $table->decimal('size', 8, 2)->nullable()->comment('Size in m²');
            $table->unsignedSmallInteger('rooms')->nullable();
            $table->unsignedSmallInteger('bathrooms')->nullable();
            $table->string('heating')->nullable()->comment('e.g. central, gas, electric, wood, heat pump');
            $table->boolean('furnished')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('elevator')->default(false);
            $table->boolean('balcony')->default(false);
            $table->unsignedSmallInteger('year_built')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'floor',
                'size',
                'rooms',
                'bathrooms',
                'heating',
                'furnished',
                'parking',
                'elevator',
                'balcony',
                'year_built',
                'description',
            ]);
        });
    }
};
