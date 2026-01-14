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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->text('address')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->foreignId('package_id')->constrained()->onDelete('restrict');
            $table->foreignId('router_id')->constrained()->onDelete('restrict');
            $table->enum('status', ['active', 'inactive', 'suspended', 'expired'])->default('inactive');
            $table->date('connection_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->decimal('monthly_fee', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
