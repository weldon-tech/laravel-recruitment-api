<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class {
    public function up(): void
    {
        Schema::create('candidate_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_id')->unique()->constrained()->cascadeOnDelete();

            $table->boolean('has_bad_habits')->default(false);

            $table->string('how_bad_habits')->nullable();

            $table->bigInteger('asked_salary')->default(0);

            $table->boolean('chronic_diseases')->default(false);

            $table->boolean('is_pregnant')->default(false);

            $table->string('family_situation')->nullable();

            $table->integer('children')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_details');
    }
};
