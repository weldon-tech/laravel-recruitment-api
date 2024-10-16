<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidate_addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();

            $table->foreignId('province_id')->constrained()->restrictOnDelete();

            $table->foreignId('region_id')->constrained()->restrictOnDelete();

            $table->foreignId('village_id')->constrained()->restrictOnDelete();

            $table->string('street');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_addresses');
    }
};
