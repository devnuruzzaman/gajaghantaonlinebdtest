<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->string('zone')->nullable();
            $table->string('sub_zone')->nullable();
            $table->string('problem_type')->nullable();
            $table->string('solved_by')->nullable();
            $table->enum('status', ['open', 'processing', 'solved', 'closed'])->default('open');
            $table->timestamps();

            $table->index(['zone', 'created_at']);
            $table->index(['sub_zone', 'created_at']);
            $table->index(['problem_type', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('problems');
    }
};
