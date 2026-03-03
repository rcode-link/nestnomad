<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_leases', function (Blueprint $table) {
            $table->string('email')->nullable()->after('tenant_name');
            $table->string('phone')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('user_leases', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone']);
        });
    }
};
