<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Seed a default tax rate setting if it doesn't exist.
        // We keep this in settings table so admin can change it later.
        if (Schema::hasTable('settings') && Schema::hasColumn('settings', 'group')) {
            DB::table('settings')->updateOrInsert(
                ['key' => 'tax_rate_percent'],
                ['value' => '0', 'type' => 'text', 'group' => 'billing', 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('settings')) {
            DB::table('settings')->where('key', 'tax_rate_percent')->delete();
        }
    }
};
