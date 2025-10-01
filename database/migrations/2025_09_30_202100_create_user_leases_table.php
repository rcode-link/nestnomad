<?php

use App\Models\Lease;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_leases', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->string('tenant_name');
            $table->foreignIdFor(Lease::class);
            $table->timestamps();
        });

        Schema::table('leases', function (Blueprint $table): void {
            $table->dropColumn('tenant_name');
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_leases');

        Schema::table('leases', function (Blueprint $table): void {
            $table->foreignId('user_id')->nullable();
            $table->string('tenant_name', 255);
        });
    }
};
