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
        Schema::create('leases', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('property_id')->references('id')->on('properties');
            $table->foreignId('user_id')->nullable();
            $table->date('start_of_lease');
            $table->date('end_of_lease')->nullable();
            $table->longText('contract')->nullable();
            $table->string('tenant_name', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
};
