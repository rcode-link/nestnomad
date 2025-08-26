<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        -
        Schema::create('user_property', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('property_id')->references('id')->on('properties');
            $table->string('relation'); // owner, renter
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_property');
    }
};
