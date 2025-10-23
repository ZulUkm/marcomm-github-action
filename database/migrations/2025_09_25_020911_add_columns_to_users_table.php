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
        Schema::table('users', function (Blueprint $table) {
            $table->string('ukmper')->unique()->after('id');
            $table->string('user_type')->default('user')->after('ukmper');
            $table->string('telephone')->nullable()->after('email');
            $table->string('ptj_code')->nullable()->after('telephone');
            $table->string('staff_picture')->nullable()->after('ptj_code');
            $table->boolean('is_active')->default(true)->after('staff_picture');
            $table->string('position_code')->nullable()->after('is_active');
            $table->string('position_name')->nullable()->after('position_code');
            $table->string('last_login_ip')->nullable()->after('position_name');
            $table->timestamp('last_login_at')->nullable()->after('last_login_ip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
