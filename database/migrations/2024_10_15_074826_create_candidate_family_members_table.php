<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidate_family_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();

            $table->string('kinship');

            $table->string('full_name');

            $table->string('work_place')->nullable();

            $table->string('address')->nullable();

        });

    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_family_members');
    }
};
