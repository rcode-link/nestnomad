<?php

use App\Models\Lease;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recurring_charges', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Lease::class);
            $table->enum('interval', ['week', 'month']);
            $table->string("interval_at");
            $table->timeTz('execute_at');
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_charges');
    }
};
