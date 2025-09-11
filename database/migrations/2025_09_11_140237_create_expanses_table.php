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
        Schema::create('expanses', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('lease_id')->references('id')->on('leases');
            $table->text('name')->nullable();
            $table->integer('amount');
            $table->boolean('is_private')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->dateTimeTz('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expanses');
    }
};
