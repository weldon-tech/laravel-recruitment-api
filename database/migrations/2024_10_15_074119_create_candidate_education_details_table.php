<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidate_education_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();

            $table->string('educational_institution');

            $table->string('direction');

            $table->integer('admission_year');

            $table->integer('graduation_year');

            $table->string('field');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_education_details');
    }
};
