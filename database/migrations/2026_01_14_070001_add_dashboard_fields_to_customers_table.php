<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('pop_id')->nullable()->after('router_id')->constrained('pops')->nullOnDelete();
            $table->boolean('is_waiver')->default(false)->after('status');
            $table->boolean('is_blocked')->default(false)->after('is_waiver');
            $table->boolean('is_online')->default(false)->after('is_blocked');
            $table->date('billing_due_date')->nullable()->after('expiry_date');
            $table->boolean('is_extended')->default(false)->after('billing_due_date');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pop_id');
            $table->dropColumn(['is_waiver', 'is_blocked', 'is_online', 'billing_due_date', 'is_extended']);
        });
    }
};
